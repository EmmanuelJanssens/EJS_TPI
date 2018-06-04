<?php

    /**
     * @brief basic data acces mainly used to connect to the database
    **/
    class DAO 
    {

        /**
         * @brief error status of the control that was wanted to be done
        **/
        public $error;

        /**
         * Connects the website to the database
        **/
        function connect()
        {
                $conn = new PDO('mysql:host=192.168.154.132;dbname=emmanue4_TPI;charset=utf8','emmanuel','Pa$$w0rd');

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
            return $conn;

        }    
        
    
    }
?>