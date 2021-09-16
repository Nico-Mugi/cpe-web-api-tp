<?php
    class Patho{
        private $idp;
        private $mer;
        private $type;
        private $desc;
        public function __construct(int $idp, string $mer ,string $type , string $desc) {
            $this->__set("idp", $idp);
            $this->__set("mer", $mer);
            $this->__set("type", $type);
            $this->__set("desc", $desc);
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
