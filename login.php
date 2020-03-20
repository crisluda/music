<?php
    
    include("includes/classes/Account.php");
    include("includes/classes/Constants.php");
    $account= new Account();
    
    
    include("includes/handlers/register-handler.php");

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
    <title>Welcome to Music App</title>
</head>

<body>
    <div id="inputContainer">
        <form id="loginForm" action="login.php" method="POST">
            <h2>Login to your account</h2>
            <p>
                <label for="loginUsername">Username</label>
                <input id="loginUsername" type="text" name="loginUsername" id="" placeholder="username" required>

            </p>
            <p>
                <label for="loginpassword">Password</label>
                <input id="loginpassword" type="password" name="login password" id="" required>

            </p>
            <button type="submit" name="loginButton">LOG IN</button>
        </form>






        <form id="loginForm" action="login.php" method="POST">
            <h2>Login to your account</h2>
            <p>
                <?php echo $account->getError(Constants::$userNameCharacters);?>
                <label for="username">Username</label>
                <input id="username" type="text" name="username" id="" placeholder="username" value="<?php getInputValue('username'); ?>" required>

            </p>
            <p>
                <?php echo $account->getError(Constants::$firstNameCharacters);?>
                <label for="firstname">firstname</label>
                <input id="firstname" type="text" name="firstname" id="" placeholder="firstname" required value="<?php getInputValue('firstname'); ?>">

            </p>
            <p>
            <?php echo $account->getError(Constants::$lastNameCharacters);?>
                <label for="lastname">lastname</label>
                <input id="lastname" type="text" name="lastname" id="" placeholder="lastname" required value="<?php getInputValue('lastname'); ?>">

            </p>
            <p>
            <?php echo $account->getError(Constants::$emailInvalid);?>
            <?php echo $account->getError(Constants::$emailDoNoMatch);?>
                <label for="email">email</label>
                <input id="email" type="email" name="email" id="" placeholder="email" required value="<?php getInputValue('email'); ?>">

            </p>
            <p>
                <label for="email2"> Confirm email</label>
                <input id="email2" type="text" name="email2" id="" placeholder="Confirm email" required value="<?php getInputValue('email2'); ?>">

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
        </form>
    </div>
</body>

</html>