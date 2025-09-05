<?php

namespace App\Models;
use CodeIgniter\Model;

class Persona extends Model
{
  protected $table = 'personas';
  protected $primaryKey = "idpersona";
  protected $allowedFields = ["dni", "apellidos", "nombres", "telefono", "iddistrito", "direccion"];

}