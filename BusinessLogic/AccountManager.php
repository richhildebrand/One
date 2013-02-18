<?php

require_once( "../Helpers/SecureHash.php" );
require_once( "../Database/DatabaseAccessor.php" );

class AccountManager
{
    private $MIN_PASSWORD_LENGTH = 5;

    private $_submittedEmail;
    private $_submittedPassword;
    private $_newPassword;
    private $_databaseAccessor;

    public function __construct( $data = array() )
    {
        $this->_databaseAccessor = new DatabaseAccessor;

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
                 $saltedPassword = create_hash($this->_submittedPassword);
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
            return validate_password($this->_submittedPassword, $realUserPassword);
        }
        return false;
    }

    public function ChangePassword()
    {
        if($this->VerifyUserNameAndPassword())
        {
            if ($this->IsValidNewPassword())
            {
                $newSaltedPassword = create_hash($this->_newPassword);
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
                $newPassword = create_hash($newPasswordBase);
                $newSaltedPassword = create_hash($newPassword);

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