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

        private $ftp;

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

            $this->ftp = "$this->ftp_user:$this->ftp_userpwd@$this->ftp_domain";
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
            $user = $this->ftp_user;
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


            if(is_dir("ftp://$this->ftp/$rootfolder"))
            {
                $data = scandir("ftp://$this->ftp/$rootfolder");
                return $data;

            }
            else
            {
                return null;
            }
            ftp_close($connection);

        }

        function CreateDirectory($rootfolder)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);

            ftp_mkdir($connection,$rootfolder);

            ftp_close($connection);
        }

        function Upload($file,$destination)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);


            ftp_chdir($connection,$destination);
            ftp_fput($connection,$file['name'],$file['tmp_name'],FTP_BINARY);

            ftp_close($connection);

        }


        function DeleteDirectory($username)
        {
            $connection = $this->Connect($this->ftp_user,$this->ftp_userpwd);

            if(!ftp_rmdir($connection,$username))
            {
                $filelist = ftp_nlist($connection, $username);

                foreach($filelist as $file)
                {
                    if(is_dir("ftp://$this->ftp/$file") )
                    {
                        $filelist = ftp_nlist($connection,$file);
                    }
                }
            }
            ftp_close($connection);

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