<?php
    class DB {
        private $DB_NAME = getenv('MYSQL_DATABASE');
        private $DB_USER = getenv('MYSQL_USER');
        private $DB_PASS = getenv('MYSQL_PASSWORD');
    }
?>