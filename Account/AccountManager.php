<?php

require_once( "../Security/SecureHash.php" );
require_once( "../Database/DatabaseAccessor.php" );

class AccountManager
{
    private $_submittedEmail;
    private $_submittedPassword;

    public function __construct( $data = array() )
    {
        $this->_submittedEmail = $data['email'];
        $this->_submittedPassword = $data['password'];
    }


    public function RegisterUser()
    {
        if($this->IsValidUserSubmission())
        {
            $databaseAccessor = new DatabaseAccessor;

            if(!$databaseAccessor->UserExists($this->_submittedEmail))
            {
                 $saltedPassword = create_hash($this->_submittedPassword);
                 return $databaseAccessor->InsertNewUser($this->_submittedEmail, $saltedPassword);
            }
        }
        return false;
    }

    public function VerifyUserNameAndPassword()
    {
        if($this->IsValidUserSubmission())
        {
            $databaseAccessor = new DatabaseAccessor;
            $realUserPassword = $databaseAccessor->GetUserPasswordHash($this->_submittedEmail);
            return validate_password($this->_submittedPassword, $realUserPassword);
        }
        return false;
    }

    public function IsValidUserSubmission() {
        return strlen($this->_submittedEmail) > 0 && strlen($this->_submittedPassword) > 5;
    }
}