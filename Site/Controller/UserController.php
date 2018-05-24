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

        /**
         * Undocumented variable
         * 
         * @brief Check connection state
         */
        private $connected;


        function __construct($controller)
        {
            $this->baseDAO = $controller->baseDAO;
            $this->userDAO = $controller->userDAO;
            $this->projectDAO = $controller->projectDAO;
            $this->versionDAO = $controller->versionDAO;
            $this->forumDAO = $controller->forumDAO;

            if(isset($_SESSION['user_session']))
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

            //verification of authentification entry
            $success = $this->userDAO->GetConnectionData($username,$password);
            
            if($success)
            {
                $userData = $this->userDAO->GetUserData($username);

                $session_data = array('username' => $username, 'userid'=> $userData[0]->pkUser);
                $_SESSION["user_session"] = $session_data;


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
            //if a user exists
            if(isset($_SESSION['user_session']))
            {
                unset($_SESSION['user_session']);
                $this->connected = false;
                require_once "View/HomeView.php";
            }
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
        function Register($name,$lastname,$username,$email,$password,$confirmation,  $FTPHandler)
        {

            try
            {
                //check username Length
                if(strlen($username) < 6 )
                {
                    $username_err = "User name must be longer then 6 characters";
                    throw new Exception( $username_err);
                }

                //Can only use letters and numbers
                if(!preg_match("/^[a-zA-Z0-9_.-]*$/",$username))
                {
                    $username_err = "User name must contain only number or letters, no space are allowed";
                    throw new Exception($username_err);
                }
                
                //basic mail form verification
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $mail_err = "Please enter a valid email address";
                    throw new Exception( $mail_err);
                }

                //check password length
                if(!strlen($password) > 6)
                {
                    $pswd_error = "Password must be longer then 6 characters";
                    throw new Exception( $pswd_error);
                }

                //check if the password confirmation is the same as the one entered
                if($password != $confirmation)
                {
                    $pswd_conf_err = "Passwords do not match";
                    throw new Exception($pswd_conf_err);
                }

                //if every check passed successfully register the user in the database, and connect the user
                if($this->userDAO->Register($name,$lastname,$username,$email,$password))
                {
                    $userData = $this->userDAO->GetUserData($username);         
                    $session_data = array('username' => $username, 'userid'=> $userData[0]->pkUser);
                    $_SESSION["user_session"] = $session_data;

                    $this->connected = true;

                    $FTPHandler->CreateDirectory("/var/www/EJSTPI/data/",$username);

                    require_once "View/HomeView.php";
                }
                else
                {
                    //if registering somehow failed
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
        function ViewProfile($user)
        {
            //Get informations about a project list
            $userData = $this->userDAO->GetUserProjectList($user);

            //Get information about the profile

            //Get information about messages
            $userID = $this->userDAO->GetIDByUserName($user);
            $userMessages = $this->forumDAO->GetUserMessage($userID);
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


        function CreateProjectForm()
        {

            require_once "View/User/UserCreateProjectView.php";
        }


        function UploadVersionForm()
        {
            require_once "View/User/UserUploadVersionView.php";
        }

    }
?>