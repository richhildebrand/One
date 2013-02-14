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
            strlen($password) > 5 &&
            !$databaseAccessor->UserExists($username))
        {
            $saltedPassword = create_hash($password);
            $databaseAccessor->RegisterUser($username, $saltedPassword);
        }
        else
        {
            echo "User Already Exists";
        }
        //register
    }
}