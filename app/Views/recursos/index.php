<?= $header; ?>

<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold text-primary">
      <i class="bi bi-journal-bookmark"></i> Lista de Recursos
    </h2>
    <a href="<?= base_url("recursos/crear"); ?>" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Registrar
    </a>
  </div>

  <?php if(session()->getFlashdata('success')): ?>
    <script>
      Swal.fire({
        position: "top-end",
        icon: "success",
        title: "<?= session()->getFlashdata('success') ?>",
        showConfirmButton: false,
        timer: 2000,
        toast: true
      });
    </script>
  <?php endif; ?>

  <div class="table-responsive">
    <table class="table table-hover align-middle shadow-sm">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Título</th>
          <th>Categoría</th>
          <th>Subcategoría</th>
          <th>Editorial</th>
          <th>Tipo</th>
          <th>Año</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($recursos as $rec): ?>
          <tr>
            <td><?= $rec['idrecurso'] ?></td>
            <td><?= esc($rec['titulo']) ?></td>
            <td><?= esc($rec['categoria']) ?></td>
            <td><?= esc($rec['subcategoria']) ?></td>
            <td><?= esc($rec['editorial']) ?></td>
            <td><?= esc($rec['tipo']) ?></td>
            <td><?= esc($rec['apublicacion']) ?></td>
            <td><?= esc($rec['estado']) ?></td>
            <td>
              <a href="<?= base_url('recursos/editar/'.$rec['idrecurso']) ?>" 
                 class="btn btn-sm btn-warning me-1">
                <i class="bi bi-pencil-square"></i> Editar
              </a>
              <a href="<?= base_url('recursos/borrar/'.$rec['idrecurso']) ?>" 
                 class="btn btn-sm btn-danger btn-eliminar" 
                 data-id="<?= $rec['idrecurso'] ?>">
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
  document.querySelectorAll(".btn-eliminar").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      const url = btn.getAttribute("href");

      Swal.fire({
        title: "¿Eliminar recurso?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = url;
        }
      });
    });
  });
});
</script>

<?= $footer; ?>
