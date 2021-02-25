<?php defined('BASE_PATH') OR die("permission is denied");

function checkUsername($username, &$errors){
    if (strlen($username)<=4) {
        array_push($errors,"username should be at least 6 chars!" );
        return $errors;
    }
}

function checkPassword($pwd, &$errors) {

    if (strlen($pwd) < 8) {
        array_push($errors,"Password too short!" );
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        array_push($errors,"Password must include at least one number!" );
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        array_push($errors,"Password must include at least one letter!" );
    }

    return $errors;
}

function checkEmail($email, &$errors){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors,"Invalid email format");
        return $errors;
    }
}

function getUserByEmail($email){
    global $connection;
    $sql="select * from users where email=:email";
    $stm= $connection->prepare($sql);
    $stm->execute([":email"=>$email]);
    $records=$stm->fetchAll(PDO::FETCH_OBJ);
    return $records[0]? $records[0]: null;
}

function logout(){
    unset($_SESSION['login']);

    }

function login($email,$password){
    $user= getuserByEmail($email);
    if (is_null($user)){
        return false;
    }
    if (password_verify($password, $user->password)){
        $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->email ) ) );
        $user->profileImage= $grav_url;
        $_SESSION['login']=$user;
        return true;
    }
    return  false;
}

function signup($userName,$email,$password){
    global $connection;
    $errors=[];
    $passwordHashed=password_hash($password, PASSWORD_BCRYPT);
    checkUsername($userName, $errors);
    checkPassword($password, $errors);
    checkEmail( $email, $errors);
    if (sizeof($errors)>0) {
        foreach ($errors as $error) {
            message($error,'failure');
        }
    }
    else{
        $sql="insert into users (username,email,password) values (:username,:email,:password)";
        $stm= $connection->prepare($sql);
        $stm->execute([":username"=> $userName, ":email"=>$email, ":password"=>$passwordHashed]);
        return $stm->rowCount() ? true : false;
    }


}

function isLoggedIn()
{
    return isset($_SESSION['login']) ? true: false;
}

function getLoggedInUser(){
    if (isLoggedIn()){
        return ($_SESSION['login'] ?? null);
    }

}
