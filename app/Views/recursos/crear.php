<?= $header; ?>

<div class="container mt-4">
  <h3><i class="bi bi-journal-plus"></i> Registrar Recurso</h3>
  <hr>

  <form action="<?= base_url('recursos/guardar'); ?>" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="row g-3">

      <!-- Categoría -->
      <div class="col-md-6">
        <label for="idcategoria" class="form-label">Categoría</label>
        <select id="idcategoria" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php foreach($categorias as $cat): ?>
            <option value="<?= $cat['idcategoria']; ?>"><?= $cat['categoria']; ?></option>
          <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Seleccione una categoría.</div>
      </div>

      <!-- Subcategoría (relleno dinámico con JS) -->
      <div class="col-md-6">
        <label for="idsubcategoria" class="form-label">Subcategoría</label>
        <select name="idsubcategoria" id="idsubcategoria" class="form-select" required>
          <option value="">Seleccione una categoría primero</option>
        </select>
        <div class="invalid-feedback">Seleccione una subcategoría.</div>
      </div>

      <!-- Editorial -->
      <div class="col-md-6">
        <label for="ideditorial" class="form-label">Editorial</label>
        <select name="ideditorial" id="ideditorial" class="form-select" required>
          <option value="">Seleccione...</option>
          <?php foreach($editoriales as $edi): ?>
            <option value="<?= $edi['ideditorial']; ?>"><?= $edi['editorial']; ?> (<?= $edi['nacionalidad']; ?>)</option>
          <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Seleccione una editorial.</div>
      </div>

      <!-- Tipo -->
      <div class="col-md-6">
        <label for="tipo" class="form-label">Tipo</label>
        <select name="tipo" id="tipo" class="form-select" required>
          <option value="">Seleccione...</option>
          <option value="FISICO">Físico</option>
          <option value="DIGITAL">Digital</option>
        </select>
        <div class="invalid-feedback">Seleccione un tipo.</div>
      </div>

      <!-- Título -->
      <div class="col-md-12">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" name="titulo" id="titulo" class="form-control" required>
        <div class="invalid-feedback">Ingrese un título.</div>
      </div>

      <!-- Año publicación -->
      <div class="col-md-4">
        <label for="apublicacion" class="form-label">Año de publicación</label>
        <input type="number" name="apublicacion" id="apublicacion" class="form-control" min="1900" max="<?= date('Y'); ?>" required>
        <div class="invalid-feedback">Ingrese un año válido.</div>
      </div>

      <!-- ISBN -->
      <div class="col-md-4">
        <label for="isbn" class="form-label">ISBN</label>
        <input type="text" name="isbn" id="isbn" class="form-control">
      </div>

      <!-- Nº páginas -->
      <div class="col-md-4">
        <label for="numpaginas" class="form-label">Nº Páginas</label>
        <input type="number" name="numpaginas" id="numpaginas" class="form-control" min="1">
      </div>

      <!-- Estado -->
      <div class="col-md-6">
        <label for="estado" class="form-label">Estado</label>
        <select name="estado" id="estado" class="form-select" required>
          <option value="BUENO">Bueno</option>
          <option value="REGULAR">Regular</option>
          <option value="MALO">Malo</option>
        </select>
      </div>

      <!-- Portada -->
      <div class="col-md-6">
        <label for="rutaportada" class="form-label">Portada (imagen)</label>
        <input type="file" name="rutaportada" id="rutaportada" class="form-control" accept="image/*">
      </div>

      <!-- Archivo recurso -->
      <div class="col-md-12">
        <label for="rutarecurso" class="form-label">Archivo recurso (PDF si es digital)</label>
        <input type="file" name="rutarecurso" id="rutarecurso" class="form-control" accept="application/pdf">
      </div>

    </div>

    <!-- Botón -->
    <div class="mt-4">
      <button type="submit" class="btn btn-success">
        <i class="bi bi-save"></i> Guardar
      </button>
      <a href="<?= base_url('recursos'); ?>" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
    </div>
  </form>
</div>

<script>
  // Bootstrap validation
  (() => {
    'use strict';
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  })();

  // Subcategorías dinámicas (AJAX simulado)
  document.getElementById('idcategoria').addEventListener('change', function () {
    const idcategoria = this.value;
    const subcatSelect = document.getElementById('idsubcategoria');
    subcatSelect.innerHTML = '<option value="">Cargando...</option>';

    fetch("<?= base_url('api/subcategorias'); ?>/" + idcategoria)
      .then(res => res.json())
      .then(data => {
        let options = '<option value="">Seleccione...</option>';
        data.forEach(sc => {
          options += `<option value="${sc.idsubcategoria}">${sc.subcategoria}</option>`;
        });
        subcatSelect.innerHTML = options;
      });
  });
</script>

<?= $footer; ?>
