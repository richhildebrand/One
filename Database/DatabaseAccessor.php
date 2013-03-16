<?php
require_once( "Database.php" );

class DatabaseAccessor
{
    private $_dbConnection;

    public function __construct()
    {
        $this->_dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $this->_dbConnection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->_dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function InsertNewUser($username, $password)
    {
        try
        {
            $preparedStatement = $this->_dbConnection->prepare('INSERT INTO users(username, password)
                                                         VALUES(:username, :password)');
            $preparedStatement->execute(array(':username' => $username,':password' => $password));

            $preparedStatement = $this->_dbConnection->prepare('INSERT INTO customer(email, firstname)
                                                         VALUES(:email, :firstname)');
            $preparedStatement->execute(array(':email' => $username,':firstname' => ""));
            return true;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function UpdateUserPassword($username, $password)
    {
        try
        {
            $preparedStatement = $this->_dbConnection->prepare('UPDATE users SET password = :password WHERE username = :username');
            $preparedStatement->execute(array(':username' => $username,':password' => $password));
            return true;
        }
        catch (PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }
    }

    public function GetUserPasswordHash($username)
    {
        try
        {
            $preparedStatement = $this->_dbConnection->prepare('SELECT password FROM users WHERE username = :username');
            $preparedStatement->execute(array(':username' => $username));

            $result  = $preparedStatement -> fetch();
            return $result['password'];
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
            $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM users WHERE username = :username');
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

    public function GetUserProfile($email)
    {
        $logger = new Logger();
        $logger->write($email);

        $preparedStatement = $this->_dbConnection->prepare('SELECT * FROM customer WHERE email = :email');
        $preparedStatement->execute(array(':email' => $email));
        
        $result = $preparedStatement->fetch();

        $rowsFound = 0;
        foreach ($preparedStatement as $row)
        {
            $rowsFound += 1;
            $logger->write($row);
        }   

        $logger->write($result['email']);
        $logger->write($result['id']);

        return new UserProfile($result);
        
    }
}