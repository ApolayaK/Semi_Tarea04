<?= $header; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
  <div class="card shadow-sm p-3" style="width: 380px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="card-title mb-0"><i class="bi bi-search"></i> Buscador de Libros</h5>
      <a href="<?= base_url('libros'); ?>" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Volver
      </a>
    </div>

    <form id="form-buscar" autocomplete="off">
      <!-- Campo ID -->
      <div class="mb-2">
        <label for="id" class="form-label">ID del libro</label>
        <input type="text" class="form-control form-control-sm" name="id" id="id" autofocus>
      </div>

      <!-- Botón Buscar -->
      <div class="d-grid mb-2">
        <button type="button" id="buscar" class="btn btn-success btn-sm">
          <i class="bi bi-search"></i> Buscar
        </button>
      </div>

      <!-- Campo Nombre (solo si se encuentra) -->
      <div class="mb-2">
        <label for="nombre" class="form-label">Nombre del libro</label>
        <input type="text" class="form-control form-control-sm" name="nombre" id="nombre" readonly>
      </div>

      <!-- Portada (solo si se encuentra) -->
      <div class="text-center d-none" id="contenedor-portada">
        <img src="" alt="Portada" id="portada" class="img-thumbnail shadow" 
             style="max-width: 200px; height: auto; object-fit: cover;">
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const id = document.querySelector("#id");
  const nombre = document.querySelector("#nombre");
  const buscar = document.querySelector("#buscar");
  const portada = document.querySelector("#portada");
  const contenedorPortada = document.querySelector("#contenedor-portada");
  const form = document.querySelector("#form-buscar");

  async function buscarLibro() {
    if (!id.value) {
      id.focus();
      return;
    }

    try {
      const response = await fetch('http://biblioteca.test/public/api/buscarlibro', {
        method: 'POST',
        headers: { 'Content-type': 'application/json' },
        body: JSON.stringify({id: id.value})
      });

      if (!response.ok) throw new Error('Error en la comunicación con el servidor');

      const data = await response.json();

      if (data.success){
        nombre.value = data.nombre;
        portada.setAttribute('src', `http://biblioteca.test/uploads/${data.imagen}`);
        contenedorPortada.classList.remove('d-none');
      } else {
        nombre.value = '';
        contenedorPortada.classList.add('d-none');

        // Toast SweetAlert2 con mismo diseño que tus alertas de lista de libros
        Swal.fire({
          toast: true,
          position: 'top-end',
          icon: 'error',
          title: `El libro con el ID ${id.value} no existe`,
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true
        });
      }

    } catch (error) {
      console.error('Error: ', error);
      Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'error',
        title: 'Ocurrió un error en la búsqueda',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
      });
    }
  }

  buscar.addEventListener("click", buscarLibro);

  // Permitir buscar con Enter
  form.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      e.preventDefault();
      buscarLibro();
    }
  });
});
</script>

<?= $footer; ?>
