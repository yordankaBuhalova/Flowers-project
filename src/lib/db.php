<?php
    class DB {
        private $DB_SERVER;
        private $DB_NAME;
        private $DB_USER;
        private $DB_PASS;
        private $conn;
        private $LOGGER;

        function __construct() {
            // Взимане на променливи от средата
            $this->DB_SERVER = getenv('MYSQL_SERVER');
            $this->DB_NAME = getenv('MYSQL_DATABASE');
            $this->DB_USER = getenv('MYSQL_USER');
            $this->DB_PASS = getenv('MYSQL_PASSWORD');

            // Създаване на връзката
            $this->conn = new mysqli($this->DB_SERVER, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);

            // Проверка на връзката
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }

        function get($sql) {
            // метод за извличане на информация от базата
            $this->conn->real_escape_string($sql);

            $res = $this->conn->query($sql);

            if($res->num_rows > 0) {
                // резултатите се вкарват в масив (ако има такива)
                $result = array();
                while($row = $res->fetch_assoc()) {
                    array_push($result, $row);
                }
                return $result;
            }
            else {
                return null;
            }
        }

        function exec($sql) {
            // метод за изпълняване на заявки без връщане на резултат - insert, update, delete
            $this->conn->real_escape_string($sql);

            // връщаме дали заявката е завършила успешно
            return ($this->conn->query($sql) === TRUE);
        }

        function __destruct() {
            $this->conn->close();
        }
    }
?>