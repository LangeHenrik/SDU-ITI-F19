<?php

/* $username = $password = $confirm_password = $firstname = $lastname = $zipcode = $city = $email = $phonenumber = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $zipcode_err = $city_err = $email_err = $phonenumber_err = ""; */

require 'C:\Users\goope\Documents\GitHub\SDU-ITI-F19\jschr17\mvc\app\controllers\SignupController.php';

    class Signup extends User{
        protected $username = '';
        protected $password = '';
        protected $confirm_password = '';
        protected $firstname = '';
        protected $lastname = '';
        protected $zipcode = '';
        protected $city = '';
        protected $email = '';
        protected $phonenumber = '';
        protected $username_err = '';
        protected $password_err = '';
        protected $confirm_password_err = '';
        protected $firstname_err = '';
        protected $lastname_err = '';
        protected $zipcode_err = '';
        protected $city_err = '';
        protected $email_err = '';
        protected $phonenumber_err = '';


    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getConfirmPassword()
    {
        return $this->confirm_password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

    /**
     * @return string
     */
    public function getUsernameErr()
    {
        return $this->username_err;
    }

    /**
     * @return string
     */
    public function getPasswordErr()
    {
        return $this->password_err;
    }

    /**
     * @return string
     */
    public function getConfirmPasswordErr()
    {
        return $this->confirm_password_err;
    }

    /**
     * @return string
     */
    public function getFirstnameErr()
    {
        return $this->firstname_err;
    }

    /**
     * @return string
     */
    public function getLastnameErr()
    {
        return $this->lastname_err;
    }

    /**
     * @return string
     */
    public function getZipcodeErr()
    {
        return $this->zipcode_err;
    }

    /**
     * @return string
     */
    public function getCityErr()
    {
        return $this->city_err;
    }

    /**
     * @return string
     */
    public function getEmailErr()
    {
        return $this->email_err;
    }

    /**
     * @return string
     */
    public function getPhonenumberErr()
    {
        return $this->phonenumber_err;
    }

    function formCheck(){
        if(isset($_POST['submit']) && !empty($_POST['submit'])){
            parent::checkInput();
        }
    }

    }

$signup = new SignupController();

$signupView = new signup();


?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
        form {display: inline-block}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form name="registerForm" action="<?php /*echo htmlspecialchars($_SERVER["PHP_SELF"]);*/ ?>" method="post" onsubmit="return <?php $signupView->formCheck(); ?>">
            <div class="form-group <?php echo (!empty($signup->getUsernameErr())) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php /*echo $username;*/ $signup->getUsername(); ?>">
                <span class="help-block"><?php $signup->getUsernameErr(); ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($signup->getPasswordErr())) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php /*echo $password;*/ $signup->getPassword(); ?>">
                <span class="help-block"><?php $signup->getPasswordErr(); ?></span>
            </div>
            <div class="form-group <?php echo (!empty($signup->getConfirmPasswordErr())) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php $signup->getConfirmPassword(); ?>">
                <span class="help-block"><?php $signup->getConfirmPasswordErr(); ?></span>
            </div>
            <div class="form-group <?php echo (!empty($signup->getFirstnameErr())) ? 'has-error' : ''; ?>">
                <label>First name</label>
                <input type="text" name="firstname" class="form-control" value="<?php $signup->getFirstname(); ?>">
                <span class="help-block"><?php $signup->getFirstnameErr(); ?></span>
            </div> 	
            <div class="form-group <?php echo (!empty($signup->getLastnameErr())) ? 'has-error' : ''; ?>">
                <label>Last name</label>
                <input type="text" name="lastname" class="form-control" value="<?php $signup->getLastname(); ?>">
                <span class="help-block"><?php $signup->getLastnameErr(); ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($signup->getZipcodeErr())) ? 'has-error' : ''; ?>">
                <label>Zip code</label>
                <input type="text" name="zipcode" class="form-control" value="<?php $signup->getZipcode(); ?>">
                <span class="help-block"><?php $signup->getZipcodeErr(); ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($signup->getCityErr())) ? 'has-error' : ''; ?>">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="<?php $signup->getCity(); ?>">
                <span class="help-block"><?php $signup->getCityErr(); ?></span>
            </div> 		
            <div class="form-group <?php echo (!empty($signup->getEmailErr())) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php $signup->getEmail(); ?>">
                <span class="help-block"><?php $signup->getEmailErr(); ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($signup->getPhonenumberErr())) ? 'has-error' : ''; ?>">
                <label>Phonenumber</label>
                <input type="text" name="phonenumber" class="form-control" value="<?php $signup->getPhonenumber(); ?>">
                <span class="help-block"><?php $signup->getPhonenumberErr(); ?></span>
            </div> 			
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="other">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>