<?php
class Account{
    private $con;
    private $errorArray;

    public function __construct ($con)
    {
        $this->con=$con;
        $this->errorArray= array();
    }
    public function login($un,$pw)
    {
        $pw=md5($pw);
        $query=mysqli_query($this->con,"SELECT * FROM users WHERE username='$un' AND password='$pw'");
        if(mysqli_num_rows($query) == 1){
            // echo "work";
            return true;
        }else{
            // echo "not work";
            array_push($this->errorArray,Constants::$loginFailed);
            return false;
        }
    }
    public function register($un,$fn,$ln,$em,$em2,$pw,$pw2)
    {
        $this->validateUsername($un);
        $this->validatefirstname($fn);
        $this->validateLastname($ln);
        $this->validateEmails($em,$em2);
        $this-> validatePasswords($pw,$pw2);
        
        if(empty($this->errorArray)){
            return $this->insertUserDetails($un,$fn,$ln,$em,$pw); 
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
    private function insertUserDetails($un,$fn,$ln,$em,$pw)
    {
      $encryptedPw=md5($pw);
      $profilePic="assets/images/profile-pics/cris.JPG";
      $date=date("Y-m-d");
        // $result=mysqli_query($this->con,"INSERT INTO users(username, firstName, lastName, email,`password`, `signUpDate`,profilePic ) VALUES ('','$un','$fn','$ln','$em','$encryptedPw','$date','$profilePic')");
        // return $result;
      $sql="INSERT INTO users (username, firstName, lastName, email,`password`, `signUpDate`,profilePic ) VALUE ('$un','$fn','$ln','$em','$encryptedPw','$date','$profilePic')";
      $result=mysqli_query($this->con,$sql);
      return $result;

    //   if($query){
    //        return 1;
    //   }
    //   else{
    //     return 0;
    //   }
    }
private function validateUsername($un)
{
    if(strlen($un)<5||strlen($un)>25){
        array_push($this->errorArray,Constants::$userNameCharacters);
        return;
    }
    $checkUsernameQuery=mysqli_query($this->con,"SELECT username FROM users WHERE username='$un'");
    if(mysqli_num_rows($checkUsernameQuery) !=0){
        array_push($this->errorArray,Constants::$usernameTaken);
        return;
    }
}
private function validatefirstname($fn)
{
    if(strlen($fn)<2||strlen($fn)>25){
        array_push($this->errorArray,Constants::$firstNameCharacters);
        return;
    }
}
private function validateLastname($ln)
{
    if(strlen($ln)<2||strlen($ln)>25){
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
    if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
        array_push($this->errorArray,Constants::$emailInvalid);
        return;
    }
    $checkEmailQuery=mysqli_query($this->con,"SELECT email FROM users WHERE email='$em'");
    if(mysqli_num_rows($checkEmailQuery) !==0){
        array_push($this->errorArray,Constants::$emailTaken);
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
    if(strlen($pw)<7||strlen($pw2)>25){
        array_push($this->errorArray,Constants::$passwordsCharacters);
        return;
    }
    
}
}






?>