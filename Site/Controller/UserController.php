<?php

    require_once "Controller.php";


    /**
     * UserController
     *
     * @brief Contains all the function linked to user control such as login, view profile, create project, ... .
     * @param [in|out] type parameter_name Parameter description.
     * @param [in|out] type parameter_name Parameter description.
     * @return Description of returned value.
     */
    class UserController extends Controller
    {
        private $userDAO;

        /**
         * Undocumented variable
         * 
         * @brief Check connection state
         */
        private $connected;

        function __construct($dao)
        {

            $this->userDAO = $dao;
            if(isset($_SESSION['user']))
            {
                $this->connected = true;
            }
            else
            {
                $this->connected = false;
            }
        }
        /**
         * Login
         *
         * @brief Connects the user, if login successfull, set @connected to true
         */
        function Login($username,$password)
        {
            $data = $this->userDAO->GetConnectionData($username,$password);

            if($data)
            {
                $_SESSION['user'] = $username;
                $this->connected = true;

                require_once "View/HomeView.php";
            }
            else
            {
                $error = $this->userDAO->error;
                require_once "View/User/UserLoginView.php";
            }
            
        }

        /**
         * Logout
         * 
         * @brief Terminates the user session
         */
        function Logout()
        {
            unset($_SESSION['user']);
            $this->connected = false;
            require_once "View/HomeView.php";
        }

        /**
         * ViewLogin
         *
         * @brief Displays the login page for the user when no connected
         */
        function ViewLogin()
        {
            require_once "View/User/UserLoginView.php";
        }

        /**
         * ViewRegister
         *
         * @brief displays the register page 
         */
        function ViewRegister()
        {
            require_once "View/User/UserRegisterView.php";
        }

        /**
         * Register
         *
         * @param [string] $name
         * @param [string] $lastname
         * @param [string] $email
         * @param [string] $password
         *
         * @brief Inserts the data of the register form into the database

         */
        function Register($name,$lastname,$username,$email,$password,$confirmation)
        {

            try
            {
                if(!strlen($username) > 6 )
                {
                    throw new Exception("There are some errors in the form");
                }

                if(!preg_match("/^[a-zA-Z0-9_.-]*$/",$username))
                {
                    throw new Exception("");
                }

                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    throw new Exception("Email is not valid");
                }

                if(!strlen($password) > 6)
                {
                    throw new Exception("Password must be longer then 6 characters");
                }

                if($password != $confirmation)
                {
                    throw new Exception("There is a mis match between passwords");
                }


                if($this->userDAO->Register($name,$lastname,$username,$email,$password))
                {
                    $_SESSION['user'] = $username;
                    $this->connected = true;
                    require_once "View/HomeView.php";
                }
                else
                {
                    throw new Exception($this->userDAO->error);
                }
            }
            catch(Exception $e)
            {
                $this->connected = false;
                $error = $e->getMessage();
                require_once "View/User/UserRegisterView.php";    
            }

        }
        /**
         * ViewProfile
         *
         * @brief Only if the user is logged in he will be able to display his profile
         */
        function ViewProfile()
        {
            require_once "View/User/UserProfileView.php";
        }

        /**
         * isConnected
         *
         * @brief Check if the user is connected.
         */
        function isConnected()
        {
            return $this->connected;
        }


        function ViewUserProject($projectID)
        {
            require_once "View/User/UserProjectView.php";
        }

        function ViewUserVersion($projectid,$Version)
        {
            require_once "View/User/UserVersionView.php";
        }
    }
?>