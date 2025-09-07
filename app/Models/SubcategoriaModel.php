<?php
namespace App\Models;
use CodeIgniter\Model;

class SubcategoriaModel extends Model {
    protected $table = 'subcategorias';
    protected $primaryKey = 'idsubcategoria';
    protected $allowedFields = ['idcategoria', 'subcategoria'];
}
