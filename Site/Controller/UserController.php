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


        function __construct()
        {
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
        function Login()
        {
            $_SESSION['user'] = 'emmanuel';
            $this->connected = true;
            require_once "View/HomeView.php";
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
        function ViewRegister()
        {
            require_once "View/User/UserRegisterView.php";
        }

        function Register()
        {
            $_SESSION['user'] = 'emmanuel';
            $this->connected = true;
            require_once "View/HomeView.php";           
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
    }
?>