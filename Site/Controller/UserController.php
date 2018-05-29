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

                    $FTPHandler->CreateDirectory($username);

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

        function GetUserType($username)
        {
            return $this->userDAO->GetUserType($username);
        }

        /**
         * @brief get the user's category ID
         *
         * @return int ID of the user's category
        **/
        function GetUserTypeID($type)
        {
            return $this->userDAO->GetUserTypeID($type);
        }

        /**
         * @brief displays a list of all the users administrator only
        **/
        function DisplayAllUsers()
        {

            $users = $this->userDAO->GetAllUsers();
            $types = $this->userDAO->GetAllUserTypes();

            require_once "View/User/AdminViewUser.php";
        }

        /**
         * @brief Saves the use when updated Administrator only
         *
         * @param [int] $userID user's ID
         * @param [string] $name user's name
         * @param [string] $lastName user's last name
         * @param [string] $userName user's user name
         * @param [string] $email user's email
         * @param [string] $userType user's category
        **/
        function SaveUpdatedUser($userID,$name,$lastName,$userName,$email,$password,$userType)
        {
            $this->userDAO->SaveUpdatedUser($userID,$name,$lastName,$userName,$email,$password,$userType);

            $users = $this->userDAO->GetAllUsers();
            require_once "View/User/AdminViewUser.php";
        }

        /**
         * @brief Delete the user only for administrator
         *
         * @param [string] $username user to be deleted
        **/
        function DeleteUser($userName)
        {
            $this->userDAO->DeleteUser($userName);
            $users = $this->userDAO->GetAllUsers();
            require_once "View/User/AdminViewUser.php";
        }

        /**
         * @brief displays the new password form
        **/
        function DisplayNewPasswordForm()
        {

            require_once "View/User/NewPasswordView.php";
        }

        /**
         * @brief generates a order of letters
        **/
        function getRandomWord($len = 10)
        {
            $word = array_merge(range('a', 'z'), range('A', 'Z'));
            shuffle($word);
            return substr(implode($word), 0, $len);
        }

        /**
         * @brief Send an email to the user with a new password
         *
         * @param [string] $username username corresponding to the email to be sent
         * @param [string] $email mail destination
        **/
        function SendNewPassword($username,$email)
        {

            $userdata = $this->userDAO->GetUserMailAndUserName($username);

            try
            {

                $to = $userdata->email;
                $subject = "New password";
                $header = 'From: filewupload@admin.com'."\r\n" .
                'X-Mailer: PHP/'.phpversion();

                if($userdata->username == $username && $userdata->email == $email)
                {

                    //Get a random order of letters
                    $pwd = $this->getRandomWord(6);

                    $message = "here is your new password ".$pwd." please change it as soon as possible";

                    $pwd = password_hash($pwd,PASSWORD_DEFAULT);

                    //Update
                    $this->userDAO->UpdatePassword($username,$pwd);

                    //Send
                    mail($to,$subject,$message,$header);

                    $message = "A new Password has been sent";
                    require_once "View/User/UserLoginView.php";
                }
                else
                {
                    throw new Exception($this->userDAO->error);
                }
            }
            catch(Exception $e)
            {
                $message = $e->getMessage();
                require_once "View/User/NewPasswordView.php";
            }

        }

        function DisplayUpdatePasswordForm()
        {
            require_once "View/User/UserUpdatePasswordView.php";
        }

        /**
         * @brief Updates the user's password
         *
         * @param [string] $user user to be updated
         * @param [string] $password password that was entered
         * @param [string] $confirmation confirmation of $password
        **/
        function UpdateUserPassword($user,$password,$confirmation)
        {

            if($password == $confirmation)
            {
                $pwd = password_hash($password,PASSWORD_DEFAULT);
                $this->userDAO->UpdatePassword($user,$pwd);
                $this->ViewProfile($user);
            }
            else
            {
                $error = "passwords do not match";
                require_once "View/User/UserUpdatePasswordView.php";

            }

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

        /**
         * @brief displays the project creation form
        **/
        function CreateProjectForm()
        {
            require_once "View/User/UserCreateProjectView.php";
        }

        /**
         * @brief displays the upload version form
        **/
        function UploadVersionForm()
        {

            require_once "View/User/UserUploadVersionView.php";
        }

    }
?>