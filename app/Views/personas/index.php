<?= $header; ?>

<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold text-primary">
      <i class="bi bi-people-fill"></i> Lista de Personas
    </h2>
    <a href="<?= base_url("personas/crear"); ?>" class="btn btn-success">
      <i class="bi bi-person-plus-fill"></i> Registrar
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover align-middle shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th><i class="bi bi-credit-card-2-front"></i> DNI</th>
          <th><i class="bi bi-person-badge"></i> Apellidos</th>
          <th><i class="bi bi-person"></i> Nombres</th>
          <th><i class="bi bi-telephone"></i> Teléfono</th>
          <th><i class="bi bi-geo-alt"></i> Ubigeo</th>
          <th><i class="bi bi-gear"></i> Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($personas as $persona): ?>
          <tr>
            <td><?= $persona['idpersona'] ?></td>
            <td><?= $persona['dni'] ?></td>
            <td><?= $persona['apellidos'] ?></td>
            <td><?= $persona['nombres'] ?></td>
            <td><?= $persona['telefono'] ?></td>
            <td><?= $persona['iddistrito'] ?></td>
            <td>
              <a href="#" class="btn btn-sm btn-warning me-1">
                <i class="bi bi-pencil-square"></i> Editar
              </a>
              <a href="#" class="btn btn-sm btn-danger">
                <i class="bi bi-trash3"></i> Eliminar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<?= $footer; ?>
