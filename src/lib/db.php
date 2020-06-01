<?php
    class DB {
        private $DB_SERVER;
        private $DB_NAME;
        private $DB_USER;
        private $DB_PASS;
        private $conn;

        function __construct() {
            // Get values from env
            $this->DB_SERVER = getenv('MYSQL_SERVER');
            $this->DB_NAME = getenv('MYSQL_DATABASE');
            $this->DB_USER = getenv('MYSQL_USER');
            $this->DB_PASS = getenv('MYSQL_PASSWORD');

            // Create connection
            $this->conn = new mysqli($this->DB_SERVER, $this->DB_USER, $this->DB_PASS, $this->DB_NAME);

            // Check connection
            if (!$this->conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
        }

        function get($sql) {
            $this->conn->real_escape_string($sql);

            $res = $this->conn->query($sql);

            if($res->num_rows > 0) {
                $result = array();
                while($row = $res->fetch_assoc())
                {
                    array_push($result, $row);
                }
                return $result;
            } else {
                return null;
            }
        }

        function insert($sql) {
            $this->conn->real_escape_string($sql);

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
        }

        function update($sql) {
            $this->conn->real_escape_string($sql);

            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
              } else {
                echo "Error updating record: " . $conn->error;
              }

        }

        function delete($sql) {
            $this->conn->real_escape_string($sql);

            if ($this->conn->query($sql) === TRUE) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        }

        function __destruct() {
            $this->conn->close();
        }
    }
?>