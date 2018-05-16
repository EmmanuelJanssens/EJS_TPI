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
         * @return void
         * @brief Some brief description.
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
         * @return Description of returned value.
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

                $query = $conn->prepare("INSERT INTO user(name,lastName,userName,email,password,fkType) VALUES(:name,:lastName,:userName,:email,:password,:fkType)");
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
         * Get the username by ID
         *
         * @param [type] $id
         *
         * @return void
         * @brief Some brief description.
         * @param [in|out] type parameter_name Parameter description.
         * @param [in|out] type parameter_name Parameter description.
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

        function GetConnectionData($user,$password)
        {
            try
            {
                $conn = $this->connect();

                $query = $conn->prepare("SELECT username,password FROM user where username = :username ");
                $query->bindParam(":username",$user,PDO::PARAM_STR);
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
                $error = $e->getMessage();
                    return false;
            }
        }
    }
    
?>