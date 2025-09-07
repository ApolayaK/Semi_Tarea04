<?php

namespace App\Controllers\Api;
use App\Controllers\BaseController;
use App\Models\SubcategoriaModel;

class SubcategoriaController extends BaseController
{
    public function porCategoria($idcategoria)
    {
        $subcatModel = new SubcategoriaModel();

        $subcategorias = $subcatModel
            ->where('idcategoria', $idcategoria)
            ->findAll();

        return $this->response->setJSON($subcategorias);
    }
}
