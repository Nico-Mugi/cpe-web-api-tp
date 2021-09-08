<?php
    class Symptome{
        private $ids;
        private $desc;

        public function __construct(int $id, string $desc) {
            $this->__set("ids", $id);
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