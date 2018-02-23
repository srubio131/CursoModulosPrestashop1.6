<?php

class FotoclienteObj extends ObjectModel {
  public $id_fotocliente_item;
  public $id_product;
  public $foto;
  public $comment;

  /**
  * @see ObjectModel::$definition
  */
  public static $definition = array(
    "table" => "fotocliente_item",
    "primary" => "id_fotocliente_item",
    "multilang" => false,
    "fields" => array(
      "id_product" => array("type" => self::TYPE_INT, "validate" => "isUnsignedId", "required" => true),
      "foto" => array("type" => self::TYPE_STRING, "required" => true),
      "comment" => array("type" => self::TYPE_HTML, "validate" => "isCleanHtml")
    )
  );

  public static function getProductFotos($id_product) {
    $fotos = Db::getInstance()->executeS(
      "SELECT * FROM `"._DB_PREFIX_."fotocliente_item`
       WHERE `id_product` = ".(int)$id_product."
       ORDER BY `id_fotocliente_item` DESC"
    );

    return $fotos;
  }

  public static function existsFoto($id_product, $pathFoto) {
    $fotos = FotoclienteObj::getProductFotos($id_product);
    foreach($fotos as $f) {
      if(strstr($f["foto"], $pathFoto) ? true : false) {
        // Ya existe
        return true;
      }
    }

    return false;
  }

  public static function getAll() {
    $fotos = Db::getInstance()->executeS(
      "SELECT * FROM `"._DB_PREFIX_."fotocliente_item`
       ORDER BY `id_fotocliente_item` DESC"
    );

    return $fotos;
  }

}