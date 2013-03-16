<?php

require_once( "SecureHasher.php" );
require_once( "../Database/DatabaseAccessor.php" );

class AccountManager
{
    private $MIN_PASSWORD_LENGTH = 5;

    public $_submittedEmail;
    private $_submittedPassword;
    private $_newPassword;
    private $_databaseAccessor;
    private $_secureHasher;

    public function __construct( $data = array() )
    {
        $this->_databaseAccessor = new DatabaseAccessor;
        $this->_secureHasher = new SecureHasher;

        $this->_submittedEmail = isset($data['email']) ? $data['email'] : "";
        $this->_submittedPassword = isset($data['password']) ? $data['password'] : "";
        $this->_newPassword = isset($data['new-password']) ? $data['new-password'] : "";
    }


    public function RegisterUser()
    {
        if($this->IsValidUserSubmission())
        {
            if(!$this->_databaseAccessor->UserExists($this->_submittedEmail))
            {
                 $saltedPassword = $this->_secureHasher->create_hash($this->_submittedPassword);
                 return $this->_databaseAccessor->InsertNewUser($this->_submittedEmail, $saltedPassword);
            }
        }
        return false;
    }

    public function VerifyUserNameAndPassword()
    {
        if ($this->IsValidUserSubmission())
        {
            $realUserPassword = $this->_databaseAccessor->GetUserPasswordHash($this->_submittedEmail);
            return $this->_secureHasher->validate_password($this->_submittedPassword, $realUserPassword);
        }
        return false;
    }

    public function ChangePassword()
    {
        if($this->VerifyUserNameAndPassword())
        {
            if ($this->IsValidNewPassword())
            {
                $newSaltedPassword = $this->_secureHasher->create_hash($this->_newPassword);
                return ($this->_databaseAccessor->UpdateUserPassword($this->_submittedEmail, $newSaltedPassword));
            }
            
        }
        return false;
    }

    public function ResetPassword()
    {
        if($this->IsValidUserName())
        {
            if($this->_databaseAccessor->UserExists($this->_submittedEmail))
            {
                $newPasswordBase = uniqid('newPasswordBase', true);
                $newPassword = $this->_secureHasher->create_hash($newPasswordBase);
                $newSaltedPassword = $this->_secureHasher->create_hash($newPassword);

                if (mail($this->_submittedEmail, 
                        "Your new password is " . $newPassword . " and you should change it asap.",
                         "Cc: "))
                {
                    return ($this->_databaseAccessor->UpdateUserPassword($this->_submittedEmail, $newSaltedPassword));
                }
            }
        }
        return false;
    }

    private function IsValidUserName() {
        return strlen($this->_submittedEmail) > 0;
    }

    private function IsValidUserSubmission() {
        return $this->IsValidUserName() && strlen($this->_submittedPassword) >= $this->MIN_PASSWORD_LENGTH;
    }

    private function IsValidNewPassword() {
        return strlen($this->_newPassword) >= $this->MIN_PASSWORD_LENGTH;
    }
}