<?php
require_once( "../Configs/Database.config" );

class DatabaseAccessor
{
    private function GetDBConnection()
    {
        $dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }

    public function RegisterUser($username, $password)
    {
        try
        {
            $dbConnection = $this->GetDBConnection();            
            $preparedStatement = $dbConnection->prepare('INSERT INTO users(username, userpassword)
                                                         VALUES(:username, :password)');
            $preparedStatement->execute(array(':username' => $username,':password' => $password));
            return true;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function UserExists($username)
    {
        try
        {
            $dbConnection = $this->GetDBConnection();            
            $preparedStatement = $dbConnection->prepare('SELECT * FROM users WHERE username = :username');
            $preparedStatement->execute(array(':username' => $username));

            //sizeof($preparedStatement) is one with zero or more results
            $rowsFound = 0;
            foreach ($preparedStatement as $row)
            {
                $rowsFound += 1;
            }              

            return $rowsFound > 0;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            return true;
        }
    }
}