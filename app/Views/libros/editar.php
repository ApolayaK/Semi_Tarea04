<?= $header; ?>

<?php //print_r($libro); ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Edición de Libros</h4>
    <a href="<?= base_url("libros"); ?>">Volver</a>
  </div>

  <form method="POST" action="<?= base_url('libros/actualizar') ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $libro['id'] ?>">
    <div class="card">
      <div class="card-body">
        <div class="mb-3">
          <label for="nombre">Nombre del libro</label>
          <input type="text" class="form-control" name="nombre" id="nombre" value="<?= $libro['nombre'] ?>" autofocus required>
        </div>
        <div class="mb-3">
          <img src="<?= base_url("uploads/") ?><?=$libro['imagen'] ?>" id="imagen" alt="Portada" class="img-thumbnail" style="width: 120px;" >
        </div>
        <div>
          <label for="imagen">Adjuntar imagen de portada</label>
          <input type="file" class="form-control" name="imagen" id="imagen">
        </div>
      </div>
      <div class="card-footer text-end">
        <a href="<?= base_url('libros') ?>" class="btn btn-sm btn-outline-secondary">Cancelar</a>
        <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
      </div>
    </div>
  </form>

</div>

<?= $footer; ?>