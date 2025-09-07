<?php
namespace App\Controllers\Api;
use App\Controllers\BaseController;
use App\Models\SubcategoriaModel;

class SubcategoriaController extends BaseController {
    public function porCategoria($idcategoria) {
        $model = new SubcategoriaModel();
        return $this->response->setJSON($model->where('idcategoria',$idcategoria)->findAll());
    }
}
