<?php
require_once( "../Security/SecureHash.php" );
require_once( "../Database/DatabaseAccessor.php" );

class AccountController
{
    

    public function RegisterUser( $data = array() )
    {
        $username = $data['email'];
        $password = $data['password'];

        $databaseAccessor = new DatabaseAccessor;
        if (strlen($username) > 0 && 
            strlen($password) > 5 ) &&
            !$databaseAccessor->UserExists)
        {
            $saltedPassword = create_hash($password);
            echo $salt;

            $databaseAccessor->RegisterUser($username, $saltedPassword);
        }
        else
        {
            echo "User Already Exists";
        }
        //register
    }
}