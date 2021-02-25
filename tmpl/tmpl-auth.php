<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>login-signup</title>
    <link rel="stylesheet" href="<?= site_url('assets/css/authStyle.css')?>">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="background">
    <div id="panel-box">
        <div class="panel">
            <div class="auth-form on" id="login">
                <div id="form-title">Log In</div>
<!--                not using ajax-->
                <form action="<?= site_url('auth.php?action=login') ?>" method="POST">
                    <input name="email" type="text" required="required" placeholder="email"/>
                    <input name="password" type="password" required="required" placeholder="password"/>
                    <button type="submit">Log In</button>
                </form>
            </div>
            <div class="auth-form" id="signup" >
                <div id="form-title">Register</div>
                <form action="<?= site_url('auth.php?action=signup') ?>" method="POST">
                    <input name="username" type="text" required="required" placeholder="username"/>
                    <input name="password" type="password" required="required" placeholder="password"/>
                    <input name="email" type="text" required="required" placeholder="email"/>

                    <button type="submit">Sign Up</button>
                </form>
            </div>
        </div>
        <div class="panel">
            <div id="switch">Sign Up</div>
            <div id="image-overlay"></div>
            <div id="image-side"></div>
        </div>
    </div>
</div>
<!-- partial -->
<script src='https://code.jquery.com/jquery-3.3.1.min.js'></script><script  src=<?= site_url('assets/js/authScript.js')?>></script>

</body>
</html>
