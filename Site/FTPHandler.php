<?php

/**
 * @briefHandles all connecion of to upload and downoad files
 */
    class FTPHandler
    {
        private $host;

        private $ftp_user;
        private $ftp_userpwd;

        public $status;
        /**
         * @brief Initialises the FTP Handler
         *
         * @param [string] $host
         * @param [string] $username
         * @param [string] $password

         */
        function __construct($host, $ftp_user,$ftp_userpwd)
        {
            $this->host = $host;
            $this->ftp_user = $ftp_user;
            $this->ftp_userpwd = $ftp_userpwd;
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
            $connectionResult = ssh2_auth_password ($connectionID, $username, $password);
            if(!$connectionResult)
            {
               
                $this->status = 'could not connect to ' . $this->host;
            }
            else
            {
                $this->status = "connected";
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
        function GetFileList($rootfolder,$username)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);

            $sftp = ssh2_sftp($connection);


            $data = scandir("ssh2.sftp://$sftp/$rootfolder/$username");

            return $data;
        }

        function CreateDirectory($rootfolder,$username)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);
            $sftp = ssh2_sftp($connection);

            $folder = "$rootfolder/$username";
            ssh2_sftp_mkdir($sftp,$folder,0777,true);
        }

        /**
         * @brief Create the user
         *
         * @param [string] $username
         *
         * is called when a new user is registered
         *
         * @return true
         * @return false
         */
        function CreateUser($username,$password)
        {
            $command = 'useradd -d /data/'.$username.' '.$username;

            exec($command);

            return true;
        }

        
    }
?>