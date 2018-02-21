<?php 

  class FotoCliente extends Module {

    public function __construct() {
      // Nombre interno del módulo
      $this->name = "fotocliente";
      // Nombre que se ve en la info del módulo
      $this->displayName = "Fotos de los clientes";
      // Descripción del módulo
      $this->description = "Permite a los clientes añadir sus propias fotos a los productos";
      // Categoría
      $this->tab = "front_office_features"
      // Autor
      $this->author = "srubio131"
      // Versión
      $this->version = "0.1"
      // Este módulo usa el framework bootstrap
      $this->bootstrap = true;

      parent::__construct();
    }

    // Método que te permite configurar el módulo
    public function getContent() {
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