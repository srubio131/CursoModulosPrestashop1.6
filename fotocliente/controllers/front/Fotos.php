<?php

class FotoclienteFotosModuleFrontController extends ModuleFrontController {
  
  public function init() {
    // No mostrar los hooks de columnas derecha e izquierda
    $this->display_column_left = false;
    $this->display_column_right = false;

    parent::init();
  }

  protected function initListaFotos() {

    $fotos = FotoclienteObj::getAll();
    $this->context->smarty->assign("fotos", $fotos);
    $enable_comment = Configuration::get("FOTOCLI_COMMENTS");
    $this->context->smarty->assign("enable_comment", $enable_comment);

    $this->setTemplate("listaFotos.tpl");
  }

  public function initContent() {
    parent::initContent();

    $module_action = Tools::getValue("module_action");
    $actions_list = array("listafotos" => "initListafotos");
    if (isset($actions_list[$module_action])) {
      $funcion = $actions_list[$module_action];
      $this->$funcion();
    }
  }

}