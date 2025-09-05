<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Persona;

class PersonaController extends BaseController{

  public function index(){
    $persona = new Persona();

    $datos['personas'] = $persona->orderBy('idpersona', 'DESC')->findAll();
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('personas/index', $datos);
  }

  public function crear(){
    $datos['header'] = view('Layouts/header');
    $datos['footer'] = view('Layouts/footer');

    return view('personas/crear', $datos);
  }

  public function searchByDNI($dni = ""){
    
    //Parámetros sensibles API
    $api_endpoint = "https://api.decolecta.com/v1/reniec/dni?numero=" . $dni;
    $api_token = "sk_5727.JpUJ0x03NnNnNqOgnoe0fQ8uZq1VJgY2";
    $content_type = "application/json";

    //Configuración de cURL para realización petición
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Respuesta
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type:' . $content_type,
      'Authorization: Bearer ' . $api_token
    ]);

    //Ejecutar la petición
    $api_response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    //Error en el servicio
    if ($api_response === false){
      return $this->response->setJSON([
        'success'   => false,
        'message'   => 'No se pudo realizar la consulta'
      ]);
    }

    //Decodificar la respuesta
    $decoded_response = json_decode($api_response, true);

    if ($http_code === 404){
      return $this->response->setJSON([
        'success'   => false,
        'message'   => 'No encontramos la persona'
      ]);
    }

    //Persona encontrada por el API
    return $this->response->setJSON([
      'success'     => true,
      'apepaterno'  => $decoded_response['first_last_name'],
      'apematerno'  => $decoded_response['second_last_name'],
      'nombres'     => $decoded_response['first_name']
    ]);

  } //searchByDNI

  public function guardar(){
    //Instancia del modelo
    $persona = new Persona();

    //Array asociativo con los datos a guardar
    $registro = [
      "dni"         => $this->request->getVar('dni'),
      "apellidos"   => $this->request->getVar('apellidos'),
      "nombres"     => $this->request->getVar('nombres'),
      "telefono"    => $this->request->getVar('telefono'),
      "iddistrito"  => $this->request->getVar('distritos'),
      "direccion"   => $this->request->getVar('direccion')
    ];

    $persona->insert($registro);
    return $this->response->redirect(base_url('personas'));
  }

}