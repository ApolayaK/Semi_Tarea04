<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\RecursoModel;
use App\Models\CategoriaModel;
use App\Models\SubcategoriaModel;
use App\Models\EditorialModel;

class RecursoController extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $recursos = $db->query("SELECT * FROM v_listar_recursos")->getResultArray();

        $datos['recursos'] = $recursos;
        $datos['header']   = view('Layouts/header');
        $datos['footer']   = view('Layouts/footer');

        return view('recursos/index', $datos);
    }

    public function crear()
    {
        $categoriaModel = new CategoriaModel();
        $editorialModel = new EditorialModel();

        $datos['categorias']  = $categoriaModel->findAll();
        $datos['editoriales'] = $editorialModel->findAll();

        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        return view('recursos/crear', $datos);
    }

    public function guardar()
    {
        $recursoModel = new RecursoModel();

        $data = [
            'idsubcategoria' => $this->request->getPost('idsubcategoria'),
            'ideditorial'    => $this->request->getPost('ideditorial'),
            'tipo'           => $this->request->getPost('tipo'),
            'titulo'         => $this->request->getPost('titulo'),
            'apublicacion'   => $this->request->getPost('apublicacion'),
            'isbn'           => $this->request->getPost('isbn'),
            'numpaginas'     => $this->request->getPost('numpaginas'),
            'estado'         => $this->request->getPost('estado'),
        ];

        // Portada
        $portada = $this->request->getFile('rutaportada');
        if ($portada && $portada->isValid() && !$portada->hasMoved()) {
            $newName = $portada->getRandomName();
            $portada->move('uploads/portadas', $newName);
            $data['rutaportada'] = 'uploads/portadas/' . $newName;
        }

        // Recurso PDF
        $archivo = $this->request->getFile('rutarecurso');
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $newName = $archivo->getRandomName();
            $archivo->move('uploads/recursos', $newName);
            $data['rutarecurso'] = 'uploads/recursos/' . $newName;
        }

        $recursoModel->insert($data);
        session()->setFlashdata('success', 'Recurso registrado correctamente');
        return redirect()->to(base_url('recursos'));
    }

    public function editar($id)
    {
        $recursoModel   = new RecursoModel();
        $categoriaModel = new CategoriaModel();
        $editorialModel = new EditorialModel();

        $datos['recurso']     = $recursoModel->find($id);
        $datos['categorias']  = $categoriaModel->findAll();
        $datos['editoriales'] = $editorialModel->findAll();

        $datos['header'] = view('Layouts/header');
        $datos['footer'] = view('Layouts/footer');

        return view('recursos/editar', $datos);
    }

    public function actualizar($id)
    {
        $recursoModel = new RecursoModel();

        $data = [
            'idsubcategoria' => $this->request->getPost('idsubcategoria'),
            'ideditorial'    => $this->request->getPost('ideditorial'),
            'tipo'           => $this->request->getPost('tipo'),
            'titulo'         => $this->request->getPost('titulo'),
            'apublicacion'   => $this->request->getPost('apublicacion'),
            'isbn'           => $this->request->getPost('isbn'),
            'numpaginas'     => $this->request->getPost('numpaginas'),
            'estado'         => $this->request->getPost('estado'),
        ];

        // Portada
        $portada = $this->request->getFile('rutaportada');
        if ($portada && $portada->isValid() && !$portada->hasMoved()) {
            $newName = $portada->getRandomName();
            $portada->move('uploads/portadas', $newName);
            $data['rutaportada'] = 'uploads/portadas/' . $newName;
        }

        // Recurso PDF
        $archivo = $this->request->getFile('rutarecurso');
        if ($archivo && $archivo->isValid() && !$archivo->hasMoved()) {
            $newName = $archivo->getRandomName();
            $archivo->move('uploads/recursos', $newName);
            $data['rutarecurso'] = 'uploads/recursos/' . $newName;
        }

        $recursoModel->update($id, $data);
        session()->setFlashdata('success', 'Recurso actualizado correctamente');
        return redirect()->to(base_url('recursos'));
    }

    public function borrar($id)
    {
        $recursoModel = new RecursoModel();
        $recursoModel->delete($id);

        session()->setFlashdata('success', 'Recurso eliminado correctamente');
        return redirect()->to(base_url('recursos'));
    }
}
