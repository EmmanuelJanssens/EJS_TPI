<?php
    require_once "BaseDAO.php";

    /**
     * @brief access data for the user controller
    **/
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
         * @param [type] $name name of the user
         * @param [type] $lastname last name of the user
         * @param [type] $pseudo username of the user
         * @param [type] $email mail adress of the user
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
         * @brief updates an entry in the user table
         *
         * @param [string] $username username whose password will be updated
         * @param [string] $pwd hashed password that was updated
        **/
        function UpdatePassword($username,$pwd)
        {
            try
            {
                $conn = $this->connect();

                $qs = "UPDATE User SET password=:pwd WHERE username= :userName";

                $query =$conn->prepare($qs);
                $query->bindParam(":userName",$username);
                $query->bindParam(":pwd",$pwd);

                $query->execute();

            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
            }
        }
        /**
         * @brief get the type of the user
         *
         * @param [string] $username to be checked
         *
         * @return string  type of the user
         **/
        function GetUserType($username)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT type FROM Type INNER JOIN User ON User.fkType = Type.pkType WHERE User.userName = :userName";

                $query =$conn->prepare($qs);
                $query->bindParam(":userName",$username);

                $query->execute();

                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }
                return $result[0]->type;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
            }
        }

        /**
         * @brief get the user's type
         *
         * @param [string] $userName userme to get the type ID
         *
         * @return string type of the user
        **/
        function GetUserTypeID($userName)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT type FROM Type INNER JOIN User ON User.fkType = Type.pkType WHERE User.userName = :userName";

                $query =$conn->prepare($qs);
                $query->bindParam(":userName",$userName);

                $query->execute();

                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }
                return $result[0]->type;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
            }
        }
        /**
         * @brief get the user's type ID
         *
         * @param [string] $userName username to get the type ID
         *
         * @return string type of the user
         **/
        function GetTypeID($type)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT pkType FROM Type WHERE type = :type";

                $query =$conn->prepare($qs);
                $query->bindParam(":type",$type);

                $query->execute();

                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }
                return $result[0]->pkType;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
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

        /**
         * @brief get the user's username and mail address
         * @param [string] $username the user's user name
         *
         * @return array first and single entry of the user name if one exists
        **/
        function GetUserMailAndUserName($username)
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT username,email FROM User where username = :username";

                $query = $conn->prepare($qs);
                $query->bindParam(":username",$username);
                $query->execute();

                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }

                if(count($result) <= 0)
                    throw new Exception("Username does not match with mail address");

                return $result[0];
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return null;
            }
        }
        /**
         * @brief Returns the ID of the specified Username
         *
         * @param [int] $zsername username to be passed
         *
         * @return returns the first ID found must be limited to ine
        **/
        function GetIDByUserName($username)
        {
            try
            {
                $conn = $this->connect();


                $query = $conn->prepare("SELECT pkUser,username FROM User where username = :username ");
                $query->bindParam(":username",$username,PDO::PARAM_STR);
                $query->execute();

                $result = array();

                while($row = $query->fetchObject())
                {
                    array_push($result,$row);
                }

                if($result  <= 0)
                    throw new Exception("Such user name does not exist");

                return $result[0]->pkUser;
            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
                return null;
            }
        }

        function GetCurrentUser()
        {

            if(isset($_SESSION['user_session']))
            {
                $user = $_SESSION['user_session']['username'];
                return $user;
            }

            return null;
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
                //$q = "SELECT Project.pkProject, Project.description, Project.creationDate, Project.root, Project.topic, Project.name, User.username FROM Project INNER  JOIN User ON Project.fkUser = User.pkUser WHERE User.Username = :username";

                $q = "SELECT Project.pkProject, Project.name, Project.description, User.username, User.pkUser FROM Project INNER JOIN User ON Project.fkUser = User.pkUser WHERE User.username = :username";
                $query = $conn->prepare( $q);
                $query->bindParam(":username",$user,PDO::PARAM_INT);
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

        /**
         * @brief get a list of all the user in the database
         *
         * @return array of entries from the database
        **/
        function GetAllUsers()
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT * FROM User";

                $query =$conn->prepare($qs);

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
            }
        }

        /**
         * @brief get a list of all user types from database
         *
         * @return array of user types
        **/
        function GetAllUserTypes()
        {
            try
            {
                $conn = $this->connect();

                $qs = "SELECT * FROM Type";

                $query =$conn->prepare($qs);

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
            }
        }


        /**
         * Updates userData into the database
         *
         * @param [inz] $userID id of the user to be updated
         * @param [string] $name name of the user
         * @param [string] $lastName last name of the user
         * @param [string] $pseudo username of the user
         * @param [string] $email mail adress of the user
         * @param [string] $pwd password of the user
         * @param [int] $userType ID of the type
         */
        function SaveUpdatedUser($userID,$name,$lastName,$userName,$email,$password,$userType)
        {
            try
            {

                $type = $this->GetTypeID($userType);
                $conn = $this->connect();

                $qs = "UPDATE User SET name = :name, lastName = :lastName, userName = :userName,email = :email,password = :password,fkType = :type WHERE pkUser = :userID";

                $query = $conn->prepare($qs);

                $query->bindParam(":name",$name);
                $query->bindParam(":lastName",$lastName);
                $query->bindParam("userName",$userName);
                $query->bindParam(":email",$email);
                $query->bindParam(":password",$password);
                $query->bindParam(":userID",$userID);
                $query->bindParam(":type",$type);

                $query->execute();

            }
            catch(Exception $e)
            {
                $this->error = $e->getMessage();
            }
        }

        /**
         *
         * @brief Deletes a user from the database
         *
         * @param [string] $usernName
        **/
        function DeleteUser($userName)
        {
            try
            {
                $conn = $this->connect();

                $userProject = $this->GetUserProjectList($userName);

                foreach($userProject as $project)
                {
                    $qs = "DELETE FROM Version where fkProject = :project";
                    $query = $conn->prepare($qs);
                    $query->bindParam(":project",$project->pkProject);
                    $query->execute();

                    //delete messages from the projects
                    $qs = "DELETE FROM Message where fkProject = :project";
                    $query = $conn->prepare($qs);
                    $query->bindParam(":project",$project->pkProject);
                    $query->execute();

                }

                //delete the messagfes from the user
                $id = $this->GetIDByUserName($userName);

                $qs = "DELETE FROM Message where fkUser = :userID";
                $query = $conn->prepare($qs);
                $query->bindParam(":userID",$id);
                $query->execute();



                $qs = "DELETE FROM Project where fkUser = :userID";
                $query = $conn->prepare($qs);
                $query->bindParam(":userID",$id);
                $query->execute();

                $qs = "DELETE FROM User where userName = :userName";
                $query = $conn->prepare($qs);
                $query->bindParam(":userName",$userName);
                $query->execute();

            }
            catch (Exception $e)
            {
                $this->error = $e->getMessage();
            }

        }

        
    }
    
?>