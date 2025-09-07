<?php
namespace App\Models;

use CodeIgniter\Model;

class Persona extends Model {
    protected $table      = 'personas';
    protected $primaryKey = 'idpersona';
    protected $allowedFields = [
        'dni', 'apellidos', 'nombres', 'telefono',
        'direccion', 'iddistrito'
    ];

    /**
     * Obtener todas las personas con su ubigeo (departamento, provincia, distrito)
     */
    public function getPersonasConUbigeo(){
        return $this->select('
                personas.idpersona,
                personas.dni,
                personas.apellidos,
                personas.nombres,
                personas.telefono,
                personas.direccion,
                distritos.iddistrito,
                distritos.distrito,
                provincias.idprovincia,
                provincias.provincia,
                departamentos.iddepartamento,
                departamentos.departamento
            ')
            ->join('distritos', 'distritos.iddistrito = personas.iddistrito')
            ->join('provincias', 'provincias.idprovincia = distritos.idprovincia')
            ->join('departamentos', 'departamentos.iddepartamento = provincias.iddepartamento')
            ->orderBy('personas.idpersona', 'DESC')
            ->findAll();
    }

    /**
     * Obtener una persona con su ubigeo (para editar o detalle)
     */
    public function getPersonaConUbigeo($id){
        return $this->select('
                personas.*,
                distritos.iddistrito,
                distritos.distrito,
                provincias.idprovincia,
                provincias.provincia,
                departamentos.iddepartamento,
                departamentos.departamento
            ')
            ->join('distritos', 'distritos.iddistrito = personas.iddistrito')
            ->join('provincias', 'provincias.idprovincia = distritos.idprovincia')
            ->join('departamentos', 'departamentos.iddepartamento = provincias.iddepartamento')
            ->where('personas.idpersona', $id)
            ->first();
    }
}
