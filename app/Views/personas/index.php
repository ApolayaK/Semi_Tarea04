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
            <td><?= esc($persona['idpersona']) ?></td>
            <td><?= esc($persona['dni']) ?></td>
            <td><?= esc($persona['apellidos']) ?></td>
            <td><?= esc($persona['nombres']) ?></td>
            <td><?= esc($persona['telefono']) ?></td>
            <td>
              <?= esc($persona['departamento']) ?>, 
              <?= esc($persona['provincia']) ?>, 
              <?= esc($persona['distrito']) ?>
            </td>
            <td>

              <a href="<?= base_url('personas/editar/' . $persona['idpersona']) ?>" 
                 class="btn btn-sm btn-warning me-1">
                <i class="bi bi-pencil-square"></i> Editar
              </a>

              <a href="<?= base_url('personas/borrar/' . $persona['idpersona']) ?>" 
                 class="btn btn-sm btn-danger btn-eliminar" 
                 data-id="<?= $persona['idpersona'] ?>">
                <i class="bi bi-trash3"></i> Eliminar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const botonesEliminar = document.querySelectorAll(".btn-eliminar");

  botonesEliminar.forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const id = btn.getAttribute("data-id");

      Swal.fire({
        title: "¿Eliminar persona?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Persona eliminada correctamente",
            showConfirmButton: false,
            timer: 2000,
            toast: true
          });

          setTimeout(() => {
            window.location.href = "<?= base_url('personas/borrar/'); ?>" + id;
          }, 2000);
        }
      });
    });
  });
});
</script>

<?= $footer; ?>
