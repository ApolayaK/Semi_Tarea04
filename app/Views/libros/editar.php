<?= $header; ?>

<div class="container mt-3">
  <div class="my-3 d-flex justify-content-between align-items-center">
    <h4><i class="bi bi-pencil-square"></i> Edición de Libros</h4>
  </div>

  <form id="form-editar" method="POST" action="<?= base_url('libros/actualizar') ?>" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $libro['id'] ?>">

    <div class="card shadow-sm">
      <div class="card-body">
        <div class="mb-3">
          <label for="nombre" class="form-label fw-semibold">Nombre del libro</label>
          <input type="text" class="form-control w-50" name="nombre" id="nombre" 
                 value="<?= $libro['nombre'] ?>" required autofocus>
        </div>

        <div class="d-flex flex-wrap justify-content-center" id="contenedor-portadas">
          <!-- Portada actual -->
          <div class="text-center me-0" id="portada-actual">
            <p class="fw-semibold">Portada actual</p>
            <div class="position-relative d-inline-block" style="cursor:pointer;">
              <img src="<?= base_url("uploads/") . $libro['imagen'] ?>" 
                   alt="Portada actual" 
                   class="img-thumbnail shadow" 
                   style="width: 200px; height: 300px; object-fit: cover;">
              <!-- Overlay con ícono de lápiz -->
              <div id="overlay" 
                   class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold"
                   style="background: rgba(0,0,0,0.5); opacity:0; transition:.3s;">
                <span><i class="bi bi-pencil-fill"></i> Editar</span>
              </div>
            </div>
          </div>

          <!-- Nueva portada (oculta al inicio) -->
          <div id="nueva-portada-col" class="text-center ms-4 d-none animate__animated animate__fadeIn">
            <p class="fw-semibold">Nueva portada</p>
            <div id="drop-area" 
                 class="border border-2 rounded d-flex align-items-center justify-content-center position-relative mx-auto"
                 style="cursor: pointer; width: 200px; height: 300px; border-style: dashed;">

              <div id="drop-text" class="text-muted text-center small">
                <i class="bi bi-cloud-arrow-up fs-2"></i>
                <p class="m-0">Arrastra o selecciona</p>
              </div>

              <input type="file" name="imagen" id="imagen" accept="image/*" class="d-none">

              <img id="preview-img" src="" alt="Vista previa" 
                   class="d-none position-absolute top-0 start-0 w-100 h-100 rounded"
                   style="object-fit: cover;">
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer text-end">
        <a href="<?= base_url('libros') ?>" class="btn btn-sm btn-outline-secondary">
          <i class="bi bi-x-circle"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-sm btn-primary">
          <i class="bi bi-save"></i> Actualizar</button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const overlay = document.getElementById("overlay");
  const nuevaPortadaCol = document.getElementById("nueva-portada-col");
  const dropArea = document.getElementById("drop-area");
  const inputImagen = document.getElementById("imagen");
  const previewImg = document.getElementById("preview-img");
  const dropText = document.getElementById("drop-text");
  const form = document.getElementById("form-editar");

  // Hover efecto en portada actual
  overlay.parentElement.addEventListener("mouseenter", () => overlay.style.opacity = "1");
  overlay.parentElement.addEventListener("mouseleave", () => overlay.style.opacity = "0");

  // Click en portada actual => aparece el bloque de nueva portada
  overlay.parentElement.addEventListener("click", () => {
    nuevaPortadaCol.classList.remove("d-none");
    inputImagen.click();
  });

  // Input y drag&drop
  dropArea.addEventListener("click", () => inputImagen.click());
  inputImagen.addEventListener("change", handleFile);

  dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropArea.classList.add("bg-light");
  });
  dropArea.addEventListener("dragleave", () => dropArea.classList.remove("bg-light"));
  dropArea.addEventListener("drop", (e) => {
    e.preventDefault();
    dropArea.classList.remove("bg-light");
    const file = e.dataTransfer.files[0];
    if (file) {
      inputImagen.files = e.dataTransfer.files;
      mostrarPreview(file);
    }
  });

  function handleFile(e) {
    const file = e.target.files[0];
    if (file) mostrarPreview(file);
  }

  function mostrarPreview(file) {
    if (file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = (event) => {
        previewImg.src = event.target.result;
        previewImg.classList.remove("d-none");
        dropText.classList.add("d-none");
      };
      reader.readAsDataURL(file);
    }
  }

  // Confirmación antes de actualizar
  form.addEventListener("submit", function(e) {
    e.preventDefault();
    Swal.fire({
      title: "¿Confirmar actualización?",
      text: "Se guardarán los cambios del libro.",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Sí, actualizar",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Libro actualizado correctamente",
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
