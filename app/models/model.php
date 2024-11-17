<?php
abstract class Model {
        protected $db;

        //constructor
        public function __construct() {
            $this->db = new PDO(
                "mysql:host=".MYSQL_HOST .
                ";dbname=".MYSQL_DB
                .";charset=utf8", 
                MYSQL_USER, 
                MYSQL_PASS
                );

            $this->_deploy();
        }
    abstract protected function _deploy();

}