<?php

/**
 * @brief Handles all connecion of to upload and downoad files
 */
    class FTPHandler
    {
        /**
         * @brief remote host to connect
        **/
        private $host;

        /**
         * @brief ftp username
        **/
        private $ftp_user;

        /**
         * @brief if used is the domain on wich the user is appended
        **/
        private $ftp_domain;

        /**
         * @brief the ftp user password
        **/
        private $ftp_userpwd;

        /**
         * @brief connection state of the ftp handler
        **/
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
         * @return int the connection ID
         */
        function Connect($username,$password)
        {
            $connectionID = ssh2_connect($this->host,22);
            $user = $this->ftp_user;
            $connectionResult = ssh2_auth_password($connectionID, $user, $password);
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
            $ftp = ssh2_sftp($connection);

            if(is_dir("ssh2.sftp://$ftp/home/Users/$rootfolder"))
            {
                $data = scandir("ssh2.sftp://$ftp/home/Users/$rootfolder");
                return $data;
            }
            else
            {
                return null;
            }

        }

        /**
         * @brief creates a directory in the home folder from linux
         *
         * @param []
        **/
        function CreateDirectory($rootfolder)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);
            $ftp = ssh2_sftp($connection);

            mkdir("ssh2.sftp://$ftp/home/Users/$rootfolder");
        }

        function Download($file)
        {

        }
        function Upload($file,$destination)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);
            $ftp = ssh2_sftp($connection);

            move_uploaded_file($file['tmp_name'],"ssh2.sftp://$ftp/home/Users/$destination/".$file['name']."");

        }


        function DeleteDirectory($username)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);
            $ftp = ssh2_sftp($connection);

            rmdir("ssh2.sftp://$ftp/home/Users/$username");

        }

    }
?>