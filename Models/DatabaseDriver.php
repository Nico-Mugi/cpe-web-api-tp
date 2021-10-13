<?php
    include 'Symptome.php';
    include 'Patho.php';
    include 'Meridien.php';

    define('HOST', 'localhost');
    define('USERNAME', 'postgres');
    define('PASSWORD', 'postgres');
    define('PORT', '5432');
    define('DBNAME', 'postgres');

    class DatabaseDriver{
  
        // specify your own database credentials
        private $host = HOST;
        private $db_name = DBNAME;
        private $username = USERNAME;
        private $port = PORT;
        private $password = PASSWORD;
        public $conn;
        

        
        public function __construct() {
            $this->conn = null;
            try{
                $this->conn = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
                #$this->conn = new PDO('pgsql:host=192.168.56.101;port=5432;dbname=postgres', 'loi', 'loiloi');
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                error_log("Connection error: " . $exception->getMessage());
            }
        }

        public function getMeridienByCode($codeMer){
            $requete = "SELECT m.* FROM meridien m
            WHERE m.code = :codeMer";
            $resultats = $this->conn->prepare($requete);
            $resultats->bindValue(":codeMer", $codeMer);
            $resultats->execute();
            $line = $resultats->fetch(PDO::FETCH_ASSOC);
            return new Meridien($line["code"], $line["nom"], $line["element"], $line["yin"]);
        }

        public function getAllSymptomesByIdPatho($idPatho){
            $requete = "SELECT s.* FROM symptome s
            INNER JOIN symptpatho sp ON (sp.ids = s.ids)
            WHERE sp.idp = :idPatho";
            $resultats = $this->conn->prepare($requete);
            $resultats->bindValue(":idPatho", $idPatho);
            $resultats->execute();
            $lines = $resultats->fetchAll(PDO::FETCH_ASSOC);
            $symptomes = [];
            foreach($lines as $line){
                array_push($symptomes, new Symptome($line["ids"], $line["desc"]));
            }
            return $symptomes;
        }

        public function getAllPatho(){
            $requete = "SELECT * FROM patho";
            $resultats = $this->conn->prepare($requete);
            $resultats->execute();
            $lines = $resultats->fetchAll(PDO::FETCH_ASSOC);
            $pathos = [];
            foreach($lines as $line){
                array_push($pathos, new Patho($line["idp"], $this->getMeridienByCode($line["mer"]),$line["type"], $line["desc"], $this->getAllSymptomesByIdPatho($line["idp"])));
            }
            return $pathos;
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

        public function getAllMeridien(){
            $requete = "SELECT * FROM meridien ";
            $resultats = $this->conn->prepare($requete);
            $resultats->execute();
            $lines = $resultats->fetchAll(PDO::FETCH_ASSOC);
            $meridiens = [];
            foreach($lines as $line){
                array_push($meridiens, new Meridien($line["code"],$line["nom"],$line["element"], $line["yin"]));
            }
            return $meridiens;
        }

        public function getPathosByKeyWord(String $keyword){
            $requete = "SELECT * FROM keywords 
            INNER JOIN keysympt ON (keywords.idk = keysympt.idk) 
            INNER JOIN symptpatho ON (keysympt.ids = symptpatho.ids)
            INNER JOIN patho ON (symptpatho.idp = patho.idp) 
			WHERE name = :keyword";
            $resultats = $this->conn->prepare($requete);
            $resultats->bindValue(":keyword", $keyword);
            $resultats->execute();
            $lines = $resultats->fetchAll(PDO::FETCH_ASSOC);
            $pathos = [];
            foreach($lines as $line){
                array_push($pathos, new Patho($line["idp"], $this->getMeridienByCode($line["mer"]),$line["type"], $line["desc"], $this->getAllSymptomesByIdPatho($line["idp"])));
            }
            return $pathos;

        }

        public function insertUser(String $username,String $password ,String $mail){
            $requete = "INSERT INTO public.user VALUES (:user,:pass,:mail);";
            $resultats = $this->conn->prepare($requete);
            $resultats->bindValue(":user", $username);
            $resultats->bindValue(":pass", $password);
            $resultats->bindValue(":mail", $mail);
            try {
                $resultats->execute();
                return 0;
            } catch (\Throwable $th) {
                echo $th;
                error_log('Failed to insert user');
                error_log($th);
                return -1;
            }
        }

        public function getUserPassword(String $username){
            $requete = "SELECT * FROM public.user where username =:user ";
            $resultats = $this->conn->prepare($requete);
            $resultats->bindValue(":user", $username);
            $resultats->execute();
            $password = $resultats->fetchAll(PDO::FETCH_ASSOC);
            return $password ;
        }

    }
?>
