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
        array_push($this->errorArray,"your username must be between 6 and 25");
        return;
    }
}
private function validatefirstname($fn)
{
    if(strlen($fn)<3||strlen($fn)>25){
        array_push($this->errorArray,"your firstname must be between 3 and 25");
        return;
    }
}
private function validateLastname($ln)
{
    if(strlen($ln)<3||strlen($ln)>25){

        $errorData="<div id='lastname'>your your username must be between 3 and 25 </div>";
        return $errorData;

        array_push($this->errorArray,"your username must be between 3 and 25");
        return;
    }
}
private function validateEmails($em,$em2)
{
    if($em!=$em2){
        array_push($this->errorArray,"email do not match");
        return; 
    }
    if(!filter_var(FILTER_VALIDATE_EMAIL)){
        array_push($this->errorArray,"email is invalid");
        return;
    }
}
private function validatePasswords($pw,$pw2)
{
    if($pw!=$pw2){
        array_push($this->errorArray,"passwors do not match");
        return;
    }
    if(preg_match("/[^A-Za-z0-9]/",$pw)){
        array_push($this->errorArray,("password can only contain numbers and letters"));
        return;
    }
    if(strlen($pw)<8||strlen($pw2)>25){
        array_push($this->errorArray,"your password must be between 6 and 25 characters");
        return;
    }
}
}






?>