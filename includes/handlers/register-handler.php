<?php




function sanitizFormUsername($inputText)
{
    // $inputText=$_POST["username"];
    $inputText=strip_tags($inputText);
    $inputText=str_replace(" ","",$inputText);
    return $inputText;
}
function sanitizFormString($inputText)
{
    $inputText=strip_tags($inputText);
    $inputText=str_replace(" ","",$inputText);
    $inputText=ucfirst(strtolower($inputText));
    return $inputText;
}
function sanitizFormPassword($inputText)
{
    $inputText=strip_tags($inputText);
    return $inputText;
}

if (isset($_POST["registerButton"])) {
    // registerButton ws pressed
    // sanitiz Form
    $username=sanitizFormUsername($_POST["username"]);
    $firstname=sanitizFormString($_POST["firstname"]);
    $lastname=sanitizFormString($_POST["lastname"]);
    $email=sanitizFormString($_POST["email"]);
    $email2=sanitizFormString($_POST["email2"]);
    $password=sanitizFormPassword($_POST["password"]);
    $password2=sanitizFormPassword($_POST["password2"]);

     $wasSuccessful=$account->register($username,$firstname,$lastname,$email,$email2,$password,$password2);

    if($wasSuccessful){
        $_SESSION["userLoginedIn"]=$username;
    header("Location:index.php");
    }
    

}



?>