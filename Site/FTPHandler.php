<?php

/**
 * @briefHandles all connecion of to upload and downoad files
 */
    class FTPHandler
    {
        private $host;

        public $error;
        /**
         * @brief Initialises the FTP Handler
         *
         * @param [string] $host
         * @param [string] $username
         * @param [string] $password

         */
        function __construct($host)
        {
            $this->host = $host;
        }

        /**
         * @brief connects to the FTP Server with SFTP via a created username
         *
         * @param [string] $username
         * 
         * is called when a user is connected on the project page
         */
        function Connect($username,$password)
        {

            $connectionID = ssh2_connect($this->host);
            $connectionResult = ssh2_auth_password ($connectionID, 'FTP', 'Pa$$w0rd');
            if(!$connectionResult)
            {
               
                $this->error = 'could not connect to ' . $this->host;
            }
            else
            {
                $this->error = "connected";
            }

            return $connectionID;
        }


        /**
         * @brief Undocumented function
         *
         * @param [string] $rootFolder
         * 
         * is called when someone wants to visualise a specific version
         * @return null
         */
        function GetFileList($rootFolder,$username,$password)
        {
            $connection = $this->Connect($username,$password);

            $sftp = ssh2_sftp($connection);


            $data = scandir("ssh2.sftp://$sftp/$rootFolder");

            return $data;
        }

        function OpenDirectory()
        {

        }

        /**
         * @brief Create the user
         *
         * @param [string] $username
         *
         * is called when a new user is registered
         */
        function CreateUser($username)
        {   

            exec("adduser -c 'FTP USER Tom' -m tom");
        }

        
    }
?>