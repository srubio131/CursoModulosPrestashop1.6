<?php 

  include_once 'classes/FotoclienteObj.php';

  if (!defined('_PS_VERSION_')) {
    exit;
  }


  class Fotocliente extends Module {

    public function __construct() {
      
      // Nombre interno del módulo
      $this->name = "fotocliente";
      // Nombre que se ve en la info del módulo
      $this->displayName = "Fotos de los clientes";
      // Descripción del módulo
      $this->description = "Permite a los clientes añadir sus propias fotos a los productos";
      // Categoría
      $this->tab = "front_office_features";
      // Autor
      $this->author = "srubio131";
      // Versión
      $this->version = "0.1";
      // Este módulo usa el framework bootstrap
      $this->bootstrap = true;

      // Versiones compatibles donde el módulo funciona
      $this->ps_versions_compliancy = array("min"=>"1.5.2", "max"=>_PS_VERSION_);
      // Dependencias de modulos que se necesitan para que este modulo funcione bien
      $this->dependencies = array();

      parent::__construct();
      
    }

    // Método que te permite configurar el módulo. Se ejecuta cada vez que se lanza el configurar del módulo
    public function getContent() {

      // Al darle al submit del form del .tpl como action está vacio se refescará la pantalla, este método lo
      // detecta y guardamos el input "enable_comment" como variable en la configuración
      if(Tools::isSubmit("fotocliente_form")) {
        $enable_comment = Tools::getValue("enable_comment");
        Configuration::updateValue("FOTOCLIENTE_COMMENTS", $enable_comment);
      }

      // Recuperar de la configuración el valor de enable_comment.
      // La primera vez $enable_comment será vacío y smarty lo tomará como cero (No)
      $enable_comment = Configuration::get("FOTOCLIENTE_COMMENTS");
      $this->context->smarty->assign("enable_comment", $enable_comment);

      // Cargar desde el fichero de la plantilla lo que se quiere mostrar en la configuración del módulo
      return $this->display(__FILE__,"getContent.tpl");
    }

    // Método que se ejecuta al instalar el módulo
    public function install() {
      if(!parent::install()) {
        return false;
      }

      // Inicializar configuración del módulo
      Configuration::updateValue("FOTOCLIENTE_COMMENTS","1");
      // Registrar el módulo dentro del hook displayProductTabContent
      $this->registerHook("displayProductTabContent");
      // Instalar DB
      $result = $this->installDB();

      return $result;
    }

    // Método propio para instalar las tablas necesarias por el módulo
    private function installDB() {
      // Conectar a la Db y crear tablas
      return Db::getInstance()->execute(
        "CREATE TABLE IF NOT EXISTS `"._DB_PREFIX_."fotocliente_item` (
          `id_fotocliente_item` int(11) NOT NULL AUTO_INCREMENT,
          `id_product` int(11) NOT NULL,
          `foto` VARCHAR(255) NOT NULL,
          `comment` text NOT NULL,
          PRIMARY KEY (`id_fotocliente_item`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;"
      );
    }

    // Método que se ejecuta al desinstalar el módulo
    public function uninstall() {
      if(!parent::uninstall()) {
        return false;
      }

      // Eliminar configuración
      Configuration::deleteByName("FOTOCLIENTE_COMMENTS");
      // Eliminar tablas de la Db
      $result = $this->uninstallDB();

      return $result;
    }

    // Método para eliminar el rastro de tablas DB creadas por el módulo
    private function uninstallDB() {
      return Db::getInstance()->execute("DROP TABLE `"._DB_PREFIX_."fotocliente_item`");
    }

    // Uso del hook dentro del módulo. Injecta contenido al hook 
    public function hookDisplayProductTabContent($params) {

      if(Tools::isSubmit("fotocliente_submit_foto")) {
        if(isset($_FILES["foto"])) {
          $foto = $_FILES["foto"];
          if($foto['name'] != "") {
            $allowed = array("image/gif","image/jpeg","image/jpg","image/png","image/ico");
            if(in_array($foto["type"], $allowed)) {
              $path = "./upload/";
              // Modificar el tamaño de la imagen subida
              list($width, $height) = getimagesize($foto["tmp_name"]);
              $proporcion = 400/$width;
              $copy = ImageManager::resize($foto["tmp_name"], $path.$foto["name"], 400, $proporcion*$height, $foto["type"]);
              if(!$copy) {
                 $this->context->smarty->assign("errorForm", "Error moviendo la imagen: ".$path.$foto["name"]);
              } else {
                // Se ha subido una imagen válida
                $id_product = Tools::getValue("id_product");
                $pathfoto = "upload/".$foto["name"];
                $comentario = Tools::getValue("comentario");

                $fotoObj = new FotoclienteObj();
                $fotoObj->id_product = (int)$id_product;
                $fotoObj->foto = $pathfoto;
                $fotoObj->comment = pSQL($comentario);

                $result = $fotoObj->add();
                if($result) {
                  $this->context->smarty->assign("savedForm", "1");
                } else {
                  $this->context->smarty->assign("errorForm", "No se ha podido grabar la foto en la BD");
                }
              }
            } else {
                $this->context->smarty->assign("errorForm", "Formato de imagen no válido");
            }
          }
        }
      }

      // Enviar a la plantilla de smarty los valores de configuración
      $enable_comment = Configuration::get("FOTOCLIENTE_COMMENTS");
      $this->context->smarty->assign("enable_comment", $enable_comment);

      // Cargar desde el fichero de la plantilla el hook
      return $this->display(__FILE__,"displayProductTabContent.tpl");
    }

  }