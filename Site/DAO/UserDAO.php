<?php
    require_once "BaseDAO.php";

    class UserDAO extends DAO
    {
        private $username;
        private $pseudonym;
        private $userlastname;
        private $useremail;
        private $userpassword;
        
        public $error;


        /**
         * Insert userdata into the database
         *
         * @param [type] $name
         * @param [type] $lastname
         * @param [type] $pseudo
         * @param [type] $email
         * @param [type] $pwd
         *

         * @return true if registered correctly
         * @return false if an error occured
         */
        function Register($name,$lastname,$pseudo,$email,$pwd)
        {
             $this->username = $name;
             $this->pseudonym = $pseudo;
             $this->userlastname = $lastname;
             $this->useremail = $email;

             $pwd = password_hash($pwd,PASSWORD_DEFAULT);

             $this->userpassword = $pwd;

             try{          
                $conn = $this->connect();

                $query = $conn->prepare("INSERT INTO User(name,lastName,userName,email,password,fkType) VALUES(:name,:lastName,:userName,:email,:password,:fkType)");
                $num = 2;
          
                //check if the fields are not empty, even if the fields are required
                if(empty($this->username)|| empty($this->userlastname) || empty($this->useremail) || empty($this->userpassword) || empty($this->pseudonym))
                {
                    throw new Exception("Empty fields");
                }
                $query->bindParam(":name",$this->username, PDO::PARAM_STR);
                $query->bindParam(":lastName",$this->userlastname, PDO::PARAM_STR);
                $query->bindParam(":userName",$this->pseudonym, PDO::PARAM_STR);
                $query->bindParam(":email",$this->useremail, PDO::PARAM_STR);
                $query->bindParam(":password",$this->userpassword, PDO::PARAM_STR);
                $query->bindParam(":fkType",$num, PDO::PARAM_INT);

                $query->execute();

                return true;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return false;
            }
        }

        /**
         * @brief Get the username by ID
         *
         * @param [int] $id
         * @return Description of returned value.
         */
        function GetUserNameByID($id)
        {
            try
            {
 
                return $query;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return null;
            }
        }

        function GetIDByUserName($username)
        {
            try
            {

            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
            }
        }
        /**
         * GetUserData
         *
         * @param [string] $user
         *
         * @brief Get all the columns data from the database
         * @return Array the request result
         */
        function GetUserData($user)
        {
            try
            {
                $conn = $this->connect();

                $query = $conn->prepare("SELECT pkUser,username,name,lastname,email FROM User where username = :username ");
                $query->bindParam(":username",$user,PDO::PARAM_STR);
                $query->execute();

                $result = array();
                
                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }
                return $result;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return false;
            }          
        }

        /**
         * @brief Check password of the user
         *
         * @param [string] $username
         * @param [string] $password
         *
         * @return true if the entered password is correct
         * @return false if the entered password was incorrect
         * */
        function GetConnectionData($username,$password)
        {
            try
            {
                $conn = $this->connect();

                $query = $conn->prepare("SELECT username,password FROM User where username = :username ");
                $query->bindParam(":username",$username,PDO::PARAM_STR);
                $query->execute();

                $count = $query->rowCount();
                if($query->rowCount() == 1)
                {
                    $values = $query->fetch(PDO::FETCH_OBJ);
                    if(password_verify($password,$values->password))
                    {
                        return true;
                    }
                    else
                    {
                        throw new Exception("bad password");
                    }
                }
                else
                {
                    throw new Exception("bad fields");
                }

            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return false;
            }
        }

        /**
         * @brief Get the data of the project from the user
         *
         * @param [string] $user
         *

         * @return array  of the use's project
         */
        function GetUserProjectList($user)
        {
            try
            {
                $conn = $this->connect();

                $query = $conn->prepare("SELECT pkProject,name FROM Project  WHERE :userID = fkUser");
                $query->bindParam(":userID",$user,PDO::PARAM_INT);
                $query->execute();
                
                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }

                return $result;
            }
            catch(Exception$e)
            {
                $this->error = $e->getMessage();
                return null;
            }
        }


        
    }
    
?>