<?php
    class Patho{
        private $idp;
        private $mer;
        private $type;
        private $desc;
        private $symptomes;
        public function __construct(int $idp, Meridien $mer ,string $type , string $desc, array $symptomes) {
            $this->__set("idp", $idp);
            $this->__set("mer", $mer);
            $this->__set("type", $type);
            $this->__set("desc", $desc);
            $this->symptomes = array();
            foreach($symptomes as $symptome) {
              $this->symptomes[] = new Symptome($symptome->__get("ids"), $symptome->__get("desc"));
            }
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
              return $this->$property;
            }
          }
        
          public function __set($property, $value) {
            if (property_exists($this, $property)) {
              $this->$property = $value;
            }
        
            return $this;
          }
    }
?>
