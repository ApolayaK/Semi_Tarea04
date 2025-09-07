<?= $header; ?>

<div class="container my-4">
  <h2 class="fw-bold text-primary">
    <i class="bi bi-pencil-square"></i> Editar Recurso
  </h2>
  <hr>

  <form id="formEditarRecurso" action="<?= base_url('recursos/actualizar/'.$recurso['idrecurso']); ?>" method="POST" enctype="multipart/form-data" novalidate>
    <div class="row g-3">

      <!-- Subcategoría -->
      <div class="col-md-6">
        <label for="idsubcategoria" class="form-label">Subcategoría</label>
        <input type="number" name="idsubcategoria" id="idsubcategoria" class="form-control" 
               value="<?= $recurso['idsubcategoria']; ?>" required>
      </div>

      <!-- Editorial -->
      <div class="col-md-6">
        <label for="ideditorial" class="form-label">Editorial</label>
        <select name="ideditorial" class="form-select" required>
          <?php foreach($editoriales as $edi): ?>
            <option value="<?= $edi['ideditorial']; ?>" 
              <?= $edi['ideditorial']==$recurso['ideditorial']?'selected':''; ?>>
              <?= $edi['editorial']; ?> (<?= $edi['nacionalidad']; ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <!-- Tipo -->
      <div class="col-md-6">
        <label for="tipo" class="form-label">Tipo</label>
        <select name="tipo" class="form-select" required>
          <option value="FISICO" <?= $recurso['tipo']=='FISICO'?'selected':''; ?>>Físico</option>
          <option value="DIGITAL" <?= $recurso['tipo']=='DIGITAL'?'selected':''; ?>>Digital</option>
        </select>
      </div>

      <!-- Título -->
      <div class="col-md-12">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" 
               value="<?= esc($recurso['titulo']); ?>" required>
      </div>

      <!-- Año -->
      <div class="col-md-4">
        <label for="apublicacion" class="form-label">Año de publicación</label>
        <input type="number" name="apublicacion" class="form-control" 
               value="<?= $recurso['apublicacion']; ?>" required>
      </div>

      <!-- ISBN -->
      <div class="col-md-4">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" name="isbn" class="form-control" value="<?= esc($recurso['isbn']); ?>">
      </div>

      <!-- Nº páginas -->
      <div class="col-md-4">
        <label for="numpaginas" class="form-label">Nº Páginas</label>
        <input type="number" name="numpaginas" class="form-control" 
               value="<?= $recurso['numpaginas']; ?>">
      </div>

      <!-- Estado -->
      <div class="col-md-6">
        <label for="estado" class="form-label">Estado</label>
        <select name="estado" class="form-select" required>
          <option value="BUENO" <?= $recurso['estado']=='BUENO'?'selected':''; ?>>Bueno</option>
          <option value="REGULAR" <?= $recurso['estado']=='REGULAR'?'selected':''; ?>>Regular</option>
          <option value="MALO" <?= $recurso['estado']=='MALO'?'selected':''; ?>>Malo</option>
        </select>
      </div>

      <!-- Portada -->
      <div class="col-md-6">
        <label for="rutaportada" class="form-label">Portada</label>
        <input type="file" name="rutaportada" class="form-control">
        <?php if($recurso['rutaportada']): ?>
          <img src="<?= base_url($recurso['rutaportada']); ?>" class="img-thumbnail mt-2" width="100">
        <?php endif; ?>
      </div>

      <!-- Recurso -->
      <div class="col-md-12">
        <label for="rutarecurso" class="form-label">Archivo recurso (PDF)</label>
        <input type="file" name="rutarecurso" class="form-control">
      </div>

    </div>

    <div class="mt-4 text-end">
      <a href="<?= base_url('recursos'); ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-x-circle"></i> Cancelar
      </a>
      <button type="submit" class="btn btn-sm btn-primary">
        <i class="bi bi-save"></i> Actualizar
      </button>
    </div>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("formEditarRecurso");

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    Swal.fire({
      title: "¿Confirmar actualización?",
      text: "Se guardarán los cambios del recurso.",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Sí, actualizar",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Recurso actualizado correctamente",
          showConfirmButton: false,
          timer: 2500,
          toast: true
        });
        setTimeout(() => form.submit(), 1200);
      }
    });
  });
});
</script>

<?= $footer; ?>
