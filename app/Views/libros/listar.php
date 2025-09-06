<?= $header; ?>

<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold text-primary">
      <i class="bi bi-book-half"></i> Lista de Libros
    </h2>
    <div class="d-flex gap-2">
      <a href="<?= base_url("libros/crear"); ?>" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Registrar
      </a>
      <a href="<?= base_url("libros/buscar"); ?>" class="btn btn-outline-primary">
        <i class="bi bi-search"></i> Buscar
      </a>
    </div>
  </div>

  <div class="card shadow-sm border-0">
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <colgroup>
            <col width="10%">
            <col width="40%">
            <col width="30%">
            <col width="20%">
          </colgroup>
          <thead class="table-light">
            <tr>
              <th><i class="bi bi-hash"></i> ID</th>
              <th><i class="bi bi-book"></i> Libro</th>
              <th><i class="bi bi-image"></i> Imagen</th>
              <th class="text-center"><i class="bi bi-gear"></i> Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php if(count($libros) == 0): ?>
              <tr>
                <td class="text-center text-muted" colspan="4">
                  <i class="bi bi-emoji-frown"></i> No se encontraron registros
                </td>
              </tr>
            <?php endif; ?>

            <?php foreach($libros as $libro): ?>
              <tr>
                <td><?= $libro['id'] ?></td>
                <td class="fw-semibold"><?= $libro['nombre'] ?></td>
                <td>
                  <img src="<?= base_url("uploads/") . $libro['imagen'] ?>" 
                       alt="Portada" 
                       class="img-thumbnail shadow-sm" 
                       style="width: 100px;">
                </td>
                <td class="text-center">
                  <a href="<?= base_url('libros/editar/' . $libro['id']) ?>" 
                     class="btn btn-sm btn-outline-info me-1">
                    <i class="bi bi-pencil-square"></i> Editar
                  </a>
                  <a href="<?= base_url('libros/borrar/' . $libro['id']) ?>" 
                     class="btn btn-sm btn-outline-danger delete">
                    <i class="bi bi-trash"></i> Eliminar
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Confirmación antes de eliminar
    document.querySelectorAll(".delete").forEach(btn => {
      btn.addEventListener("click", (e) => {
        e.preventDefault();
        const url = e.currentTarget.getAttribute("href");

        Swal.fire({
          title: "¿Estás seguro?",
          text: "Esta acción no se puede deshacer",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#d33",
          cancelButtonColor: "#6c757d",
          confirmButtonText: "Sí, eliminar",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.isConfirmed) {
            // Mostrar toast de éxito
            Swal.fire({
              toast: true,
              position: "top-end", // lado derecho superior
              icon: "success",
              title: "Eliminado con éxito",
              showConfirmButton: false,
              timer: 2000, // 2 segundos
              timerProgressBar: true
            });

            // Redirigir después de 2 segundos
            setTimeout(() => {
              window.location.href = url;
            }, 2000);
          }
        });
      });
    });
  })
</script>


<?= $footer; ?>
