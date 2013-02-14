<?php
require_once(../Configs/Database.config);

class DatabaseAccessor
{
    private function GetDBConnection()
    {
        $dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }

    // verify username does not exist before calling
    public function RegisterUser($username, $password, $salt)
    {
        try
        {
            $dbConnection = $this->GetDBConnection();            
            $preparedStatement = $dbConnection->prepare('INSERT INTO users(username, userpassword, usersalt)
                                                         VALUES(:username, :password, :salt)');
            $preparedStatement->execute(array(':username' => $username,
                                              ':password' => $userpassword,
                                              ':salt' => $usersalt));
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function UserExists($username)
    {
        try
        {
            $dbConnection = $this->GetDBConnection();            
            $preparedStatement = $dbConnection->prepare('SELECT * FROM employees WHERE username = :username');
            $preparedStatement->execute(array(':username' => $username));
            return $preparedStatement.length > 0;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            return true;
        }
    }
}