<?= $header; ?>

<div class="container mt-3">
  <div class="my-3 d-flex justify-content-between align-items-center">
    <h4><i class="bi bi-journal-plus text-primary"></i> Registro de Libros</h4>
  </div>

  <form id="form-libro" method="POST" action="<?= base_url('libros/guardar') ?>" enctype="multipart/form-data">
    <div class="card shadow-sm">
      <div class="card-body row g-4 align-items-center">
        <!-- Columna izquierda -->
        <div class="col-md-5">
          <div class="mb-3">
            <label for="nombre" class="form-label fw-semibold">Nombre del libro</label>
            <input type="text" class="form-control" name="nombre" id="nombre" 
                   value="<?= old('nombre') ?>" placeholder="Ej: El Quijote" autofocus required>
          </div>
        </div>

        <!-- Columna derecha: portada -->
        <div class="col-md-7 d-flex justify-content-center">
          <div class="position-relative">
            <label class="form-label fw-semibold d-block text-center mb-2">
              <i class="bi bi-image"></i> Portada del libro
            </label>

            <!-- Zona drag & drop -->
            <div id="drop-area" 
                 class="border border-3 border-primary rounded bg-light d-flex align-items-center justify-content-center position-relative shadow-sm"
                 style="cursor: pointer; width: 280px; height: 380px; margin: auto; border-style: dashed; transition: transform .2s;">

              <!-- Texto inicial -->
              <div id="drop-text" class="text-muted text-center">
                <i class="bi bi-cloud-arrow-up fs-1 text-primary"></i>
                <p class="m-0 small">Arrastra o selecciona<br>tu portada</p>
              </div>

              <input type="file" name="imagen" id="imagen" accept="image/*" class="d-none">

              <!-- Vista previa -->
              <img id="preview-img" src="" alt="Vista previa" 
                   class="d-none position-absolute top-0 start-0 w-100 h-100 rounded shadow"
                   style="object-fit: cover;">

              <!-- Overlay con ícono de lápiz -->
              <div id="overlay" 
                   class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center text-white fw-bold d-none"
                   style="background: rgba(0,0,0,0.5); cursor:pointer; transition:.3s;">
                <span><i class="bi bi-pencil-fill"></i> Cambiar</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card-footer text-end">
        <button type="button" id="btn-cancelar" class="btn btn-sm btn-outline-secondary">
          <i class="bi bi-x-circle"></i> Cancelar
        </button>
        <button type="submit" class="btn btn-sm btn-primary">
          <i class="bi bi-save"></i> Guardar
        </button>
      </div>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("form-libro");
    const inputNombre = document.getElementById("nombre");
    const inputImagen = document.getElementById("imagen");
    const previewImg = document.getElementById("preview-img");
    const dropText = document.getElementById("drop-text");
    const dropArea = document.getElementById("drop-area");
    const overlay = document.getElementById("overlay");
    const btnCancelarForm = document.getElementById("btn-cancelar");

    // Preview imagen
    dropArea.addEventListener("click", () => inputImagen.click());
    inputImagen.addEventListener("change", handleFile);

    dropArea.addEventListener("dragover", (e) => {
      e.preventDefault();
      dropArea.classList.add("bg-primary", "text-white");
    });

    dropArea.addEventListener("dragleave", () => {
      dropArea.classList.remove("bg-primary", "text-white");
    });

    dropArea.addEventListener("drop", (e) => {
      e.preventDefault();
      dropArea.classList.remove("bg-primary", "text-white");
      const file = e.dataTransfer.files[0];
      if (file) {
        inputImagen.files = e.dataTransfer.files;
        mostrarPreview(file);
      }
    });

    function handleFile(e) {
      const file = e.target.files[0];
      if (file) {
        mostrarPreview(file);
      }
    }

    function mostrarPreview(file) {
      if (file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = (event) => {
          previewImg.src = event.target.result;
          previewImg.classList.remove("d-none");
          dropText.classList.add("d-none");
          overlay.classList.remove("d-none");
        };
        reader.readAsDataURL(file);
      }
    }

    // Lápiz para cambiar portada
    overlay.addEventListener("click", () => {
      inputImagen.value = "";
      previewImg.src = "";
      previewImg.classList.add("d-none");
      dropText.classList.remove("d-none");
      overlay.classList.add("d-none");
    });

    // Confirmación antes de guardar
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      Swal.fire({
        title: "¿Guardar libro?",
        text: "Se registrará en el sistema.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "Libro creado con éxito",
            showConfirmButton: false,
            timer: 2000,
            toast: true
          });
          setTimeout(() => form.submit(), 1200);
        }
      });
    });

    // Cancelar limpia todo y regresa al listado
    btnCancelarForm.addEventListener("click", () => {
      inputNombre.value = "";
      inputImagen.value = "";
      previewImg.src = "";
      previewImg.classList.add("d-none");
      dropText.classList.remove("d-none");
      overlay.classList.add("d-none");
      window.location.href = "<?= base_url('libros') ?>";
    });
  });
</script>

<?= $footer; ?>
