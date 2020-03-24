<?php
    include("includes/config.php");
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
    $account= new Account($con);
    
    
    include("includes/handlers/register-handler.php");
    include("includes/handlers/login-handler.php");


    function getInputValue($name)
    {
        if(isset($_POST[$name])){;
        echo $_POST[$name];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
    <title>Welcome to Music App</title>
</head>

<body>
    <?php
    if(isset($_POST["registerButton"])){
    echo'<script>
   $(document).ready(function () {
        $("#loginForm").hide();
        $("#registerForm").show ();
});     
    </script>';
    }else{
            echo'<script>
           $(document).ready(function () {
                $("#loginForm").show();
                $("#registerForm").hide();
        });     
            </script>';
            }
    
?>
    <div id="background">
        <div id="loginContainer">
            <div id="inputContainer">
                <form id="loginForm" action="login.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$loginFailed);?>
                        <label for="loginUsername">Username</label>
                        <input id="loginUsername" type="text" name="loginUsername" id="" placeholder="username"
                            value="<?php getInputValue('loginUsername'); ?>" required>

                    </p>
                    <p>
                        <label for="loginpassword">Password</label>
                        <input id="loginpassword" type="password" name="loginPassword" id="" required>

                    </p>
                    <button type="submit" name="loginButton">LOG IN</button>
                    <div class="hasAccountText">
                        <span id="hideLogin">don't have account yet? Signup here.</span>
                    </div>
                </form>






                <form id="registerForm" action="login.php" method="POST">
                    <h2>Login to your account</h2>
                    <p>
                        <?php echo $account->getError(Constants::$userNameCharacters);?>
                        <?php echo $account->getError(Constants::$usernameTaken);?>
                        <label for="username">Username</label>
                        <input id="username" type="text" name="username" id="" placeholder="username"
                            value="<?php getInputValue('username'); ?>" required>

                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$firstNameCharacters);?>
                        <label for="firstname">firstname</label>
                        <input id="firstname" type="text" name="firstname" id="" placeholder="firstname" required
                            value="<?php getInputValue('firstname'); ?>">

                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$lastNameCharacters);?>
                        <label for="lastname">lastname</label>
                        <input id="lastname" type="text" name="lastname" id="" placeholder="lastname" required
                            value="<?php getInputValue('lastname'); ?>">

                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$emailInvalid);?>
                        <?php echo $account->getError(Constants::$emailDoNoMatch);?>
                        <?php echo $account->getError(Constants::$emailTaken);?>
                        <label for="email">email</label>
                        <input id="email" type="email" name="email" id="" placeholder="email" required
                            value="<?php getInputValue('email'); ?>">

                    </p>
                    <p>
                        <label for="email2"> Confirm email</label>
                        <input id="email2" type="text" name="email2" id="" placeholder="Confirm email" required
                            value="<?php getInputValue('email2'); ?>">

                    </p>
                    <p>
                        <?php echo $account->getError(Constants::$passwordsDoNoMatch);?>
                        <?php echo $account->getError(Constants::$passwordNotAlphanumeric);?>
                        <?php echo $account->getError(Constants::$passwordsCharacters);?>
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" id="" required>

                    </p>
                    <p>
                        <label for="password2">Confirm Password</label>
                        <input id="password2" type="password" name="password2" id="" required>

                    </p>
                    <button type="submit" name="registerButton">SIGN UP</button>
                    <!-- <button type="submit" name="loginButton">LOG IN</button> -->
                    <div class="hasAccountText">
                        <span id="hideRegister">already have account? login here.</span>
                    </div>
                </form>
            </div>
            <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free</h2>
                <ul>
                    <li><img src="https://img.icons8.com/officexs/20/000000/checkmark.png" /> Discover music you fall in
                        love with</li>
                    <li><img src="https://img.icons8.com/officexs/20/000000/checkmark.png" /> Create your own playlists
                    </li>
                    <li><img src="https://img.icons8.com/officexs/20/000000/checkmark.png" /> follow your artists and
                        keep up to date</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>