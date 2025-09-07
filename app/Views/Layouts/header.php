<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
  <!-- Sección 1: Cabecera -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="<?= base_url(); ?>">
        <i class="bi bi-book-half"></i> Biblioteca
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= base_url(); ?>">
              <i class="bi bi-house-door"></i> Inicio
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url("libros"); ?>">
              <i class="bi bi-journal-text"></i> Libros
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('editoriales'); ?>">
              <i class="bi bi-building"></i> Editoriales
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('personas'); ?>">
              <i class="bi bi-people"></i> Personas
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('recursos'); ?>">
              <i class="bi bi-collection"></i> Recursos
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Fin sección 1 -->

  <!-- Sección 2 -->
  <main>
