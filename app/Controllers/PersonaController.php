<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Persona;
use App\Models\Departamento;

class PersonaController extends BaseController
{
    public function index()
    {
        $persona = new Persona();

        $datos = [
            // Ahora usamos el método con JOIN
            'personas' => $persona->getPersonasConUbigeo(),
            'header'   => view('Layouts/header'),
            'footer'   => view('Layouts/footer')
        ];

        return view('personas/index', $datos);
    }

    public function crear()
    {
        $departamento = new Departamento();

        $datos = [
            'departamentos' => $departamento->orderBy('departamento', 'ASC')->findAll(),
            'header'        => view('Layouts/header'),
            'footer'        => view('Layouts/footer')
        ];

        return view('personas/crear', $datos);
    }

    public function searchByDNI($dni = "")
    {
        if (empty($dni)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Debe ingresar un DNI'
            ]);
        }

        $api_endpoint  = "https://api.decolecta.com/v1/reniec/dni?numero=" . $dni;
        $api_token     = "sk_10074.VaxNtkLGxpITcvhX4e0KYBA1o7HM4PF9";

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $api_endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $api_token
            ]
        ]);

        $api_response = curl_exec($ch);
        $http_code    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($api_response === false) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No se pudo realizar la consulta'
            ]);
        }

        $decoded_response = json_decode($api_response, true);

        if ($http_code === 404 || empty($decoded_response)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No encontramos la persona'
            ]);
        }

        return $this->response->setJSON([
            'success'    => true,
            'apepaterno' => $decoded_response['first_last_name'] ?? '',
            'apematerno' => $decoded_response['second_last_name'] ?? '',
            'nombres'    => $decoded_response['first_name'] ?? ''
        ]);
    }

    public function guardar()
    {
        $persona = new Persona();

        $registro = [
            "dni"        => $this->request->getVar('dni'),
            "apellidos"  => $this->request->getVar('apellidos'),
            "nombres"    => $this->request->getVar('nombres'),
            "telefono"   => $this->request->getVar('telefono'),
            "iddistrito" => $this->request->getVar('distritos'),
            "direccion"  => $this->request->getVar('direccion')
        ];

        $persona->insert($registro);

        return redirect()->to(base_url('personas'));
    }

    public function editar($id = null)
    {
        $personaModel  = new Persona();
        $departamento  = new Departamento();

        $persona = $personaModel->getPersonaConUbigeo($id);

        $datos = [
            'persona'                  => $persona,
            'departamentos'            => $departamento->orderBy('departamento', 'ASC')->findAll(),
            'departamentoSeleccionado' => $persona['iddepartamento'] ?? '',
            'provinciaSeleccionada'    => $persona['idprovincia'] ?? '',
            'nombreProvincia'          => $persona['provincia'] ?? '',
            'nombreDistrito'           => $persona['distrito'] ?? '',
            'header'                   => view('Layouts/header'),
            'footer'                   => view('Layouts/footer')
        ];

        return view('personas/editar', $datos);
    }

    public function actualizar()
    {
        $persona = new Persona();
        $id      = $this->request->getVar('idpersona');

        $registro = [
            "dni"        => $this->request->getVar('dni'),
            "apellidos"  => $this->request->getVar('apellidos'),
            "nombres"    => $this->request->getVar('nombres'),
            "telefono"   => $this->request->getVar('telefono'),
            "iddistrito" => $this->request->getVar('distritos'),
            "direccion"  => $this->request->getVar('direccion')
        ];

        $persona->update($id, $registro);

        return redirect()->to(base_url('personas'));
    }

    public function borrar($id = null)
    {
        $persona = new Persona();
        $persona->delete($id);

        return redirect()->to(base_url('personas'));
    }
}
