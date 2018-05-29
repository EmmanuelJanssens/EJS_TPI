<?php

/**
 * @briefHandles all connecion of to upload and downoad files
 */
    class FTPHandler
    {
        private $host;

        private $ftp_user;
        private $ftp_domain;
        private $ftp_userpwd;

        public $status;
        /**
         * @brief Initialises the FTP Handler
         *
         * @param [string] $host
         * @param [string] $username
         * @param [string] $password

         */
        function __construct($host, $ftp_user,$ftp_domain,$ftp_userpwd)
        {
            $this->host = $host;
            $this->ftp_user = $ftp_user;
            $this->ftp_userpwd = $ftp_userpwd;
            $this->ftp_domain = $ftp_domain;
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
            $connectionID = ftp_connect($this->host);
            $user = $this->ftp_user.'@'.$this->ftp_domain;
            $connectionResult = ftp_login($connectionID, $user, $password);
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
        function GetFileList($rootfolder)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);

            $ftp = "$this->ftp_user:$this->ftp_userpwd@$this->ftp_domain";

            if(is_dir("ftp://$ftp/$rootfolder"))
            {
                $data = scandir("ftp://$ftp/$rootfolder");
                return $data;

            }
            else
            {
                return null;
            }

        }

        function CreateDirectory($rootfolder)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);

            ftp_mkdir($connection,$rootfolder);
        }

        function Upload($file, $destination)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);
            $sftp = ssh2_sftp($connection);
            ssh2_scp_send($connection, '/local/filename', '/remote/filename', 0644);

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