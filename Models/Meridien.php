<?php
class Meridien implements JsonSerializable
{
  private $code;
  private $nom;
  private $element;
  private $yin;

  public function __construct(string $code, string $nom, string $element, string $yin)
  {
    $this->__set("code", $code);
    $this->__set("nom", $nom);
    $this->__set("element", $element);
    $this->__set("yin", $yin);
  }

  public function __get($property)
  {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  public function __set($property, $value)
  {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }

    return $this;
  }

  public function jsonSerialize()
  {
    return [
      'code' => $this->code,
      'nom' => $this->nom,
      'element' => $this->element,
      'yin' => $this->yin,
    ];
  }
}
