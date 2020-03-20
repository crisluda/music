<?php
class Account{
    private $errorArray;

    public function __construct ()
    {
        $this->errorArray= array();
    }
    public function register($un,$fn,$ln,$em,$em2,$pw,$pw2)
    {
        $this->validateUsername($un);
        $this->validatefirstname($fn);
        $this->validateLastname($ln);
        $this->validateEmails($em,$em2);
        $this-> validatePasswords($pw,$pw2);
        
        if(empty($this->errorArray)){
            return;
        }else{
            return false;
        }
    }
    public function getError($error)
    {
        if(!in_array($error,$this->errorArray)){
            $error="";
        }
             return "<span class='errorMessage'>$error</span>";
    }
private function validateUsername($un)
{
    if(strlen($un)<6||strlen($un)>25){
        array_push($this->errorArray,Constants::$userNameCharacters);
        return;
    }
}
private function validatefirstname($fn)
{
    if(strlen($fn)<3||strlen($fn)>25){
        array_push($this->errorArray,Constants::$firstNameCharacters);
        return;
    }
}
private function validateLastname($ln)
{
    if(strlen($ln)<3||strlen($ln)>25){
        array_push($this->errorArray,Constants::$lastNameCharacters);
        return;
    }
}
private function validateEmails($em,$em2)
{
    if($em!=$em2){
        array_push($this->errorArray,Constants::$emailDoNoMatch);
        return; 
    }
    if(!filter_var(FILTER_VALIDATE_EMAIL)){
        array_push($this->errorArray,Constants::$emailInvalid);
        return;
    }
}
private function validatePasswords($pw,$pw2)
{
    if($pw!=$pw2){
        array_push($this->errorArray,Constants::$passwordsDoNoMatch);
        return;
    }
    if(preg_match("/[^A-Za-z0-9]/",$pw)){
        array_push($this->errorArray,Constants::$passwordNotAlphanumeric);
        return;
    }
    if(strlen($pw)<8||strlen($pw2)>25){
        array_push($this->errorArray,Constants::$passwordsCharacters);
        return;
    }
}
}






?>