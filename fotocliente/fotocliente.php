<?php 

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
      $this->ps_versions_compliancy = array("min"=>"1.5.2", "max"=>"1.6.1.18");
      // Dependencias de modulos que se necesitan para que este modulo funcione bien
      $this->dependencies = array("blockbanner");

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
      return true;
    }

    // Método que se ejecuta al desinstalar el módulo
    public function uninstall() {
      if(!parent::uninstall()) {
        return false;
      }
      return true;
    }

  }