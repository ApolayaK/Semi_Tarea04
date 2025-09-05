<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Provincia;

class ProvinciaController extends BaseController{
    
  public function getProvinciasByDepartamento($iddepartamento = ""){
     $this->response->setContentType('application/json');
     $provincia = new Provincia();

     $listaProvincias = $provincia->where('iddepartamento', $iddepartamento)->findAll();
     return $this->response->setJSON($listaProvincias);
  }
}