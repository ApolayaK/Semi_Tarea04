<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Distrito;

class DistritoController extends BaseController{
    
  public function getDistritosByProvincia($idprovincia = ""){
     $this->response->setContentType('application/json');
     $distrito = new Distrito();

     $listaDistritos = $distrito->where('idprovincia', $idprovincia)->findAll();
     return $this->response->setJSON($listaDistritos);
  }
}