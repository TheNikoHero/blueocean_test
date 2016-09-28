<?php

class user {

    private $dbCon;
    
    function __construct($dbCon) {
        $this->dbCon = $dbCon;
    }

    public function register($username, $password, $email) {
        try {

            $stmt = $this->dbCon->prepare("INSERT INTO users(username,password, email) 
                                                       VALUES(:username, :password, :email)");
            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":password", $password);
            $stmt->bindparam(":email", $email);
            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function loginUser($username, $password) {
        try {
            $statement = $this->dbCon->prepare("SELECT * FROM users WHERE username= :username");
            $statement->execute(array(':username' => $username));
            $dbRow = $statement->fetch(PDO::FETCH_ASSOC);
            echo "\nPDO::errorInfo():\n";


            if ($statement->rowCount() > 0) {     //if theres more than 0 rows in database table
                if ($password === $dbRow['password']) {
                    $_SESSION['userSession'] = $dbRow['id']; // the session is = the user id, which is only called 'id' in the database
                    $_SESSION['username'] = $dbRow['username'];

                    return true;
                } else {
                    return false;
                }
            }
        } catch (PDOException $example) {
            echo $example->getMessage();
        }
    }

    //**************************************************************************
    //**************************************************************************
    //                  HERE ENDS THE PUBLIC FUNCTION 'LOGINUSER'
    //**************************************************************************
    //**************************************************************************

    public function isLoggedIn() {
        if (isset($_SESSION['userSession'])) {
            return true;
        }
    }

    public function redirect($url) {
        header("Location: $url");
    }

    public function logout() {
        session_destroy();
        unset($_SESSION['userSession']);
        return true;
    }
    


}

?>