<?php
    include 'Symptome.php';
    class DatabaseDriver{
  
        // specify your own database credentials
        private $host = "localhost";
        private $db_name = "postgres";
        private $username = "postgres";
        private $port = "5432";
        private $password = "admin";
        public $conn;

        
        public function __construct() {
            $this->conn = null;
            try{
                $this->conn = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }
        }
        
        public function getAllSymptomes(){
            $requete = "SELECT * FROM symptome WHERE ids > :mon_marqueur_1";
            $resultats = $this->conn->prepare($requete);
            $resultats->bindValue(":mon_marqueur_1", 5);
            $resultats->execute();
            $lines = $resultats->fetchAll(PDO::FETCH_ASSOC);
            $symptomes = [];
            foreach($lines as $line){
                array_push($symptomes, new Symptome($line["ids"], $line["desc"]));
            }
            return $symptomes;
        }
    }
?>