<?= $header; ?>

<div class="container mt-3">
  <div class="my-3 d-flex justify-content-between align-items-center">
    <h4><i class="bi bi-pencil-square"></i> Edición de Personas</h4>
  </div>

  <form id="form-editar-persona" method="POST" action="<?= base_url('personas/actualizar') ?>">
    <input type="hidden" name="idpersona" value="<?= $persona['idpersona'] ?>">

    <div class="card shadow-sm">
      <div class="card-body">

        <!-- DNI -->
        <div class="mb-3">
          <label for="dni" class="form-label fw-semibold">
            <i class="bi bi-credit-card-2-front"></i> DNI
          </label>
          <input type="text" class="form-control w-50" id="dni" name="dni" 
                 maxlength="8" minlength="8"
                 value="<?= $persona['dni'] ?>" required>
        </div>

        <!-- Apellidos y Nombres -->
        <div class="row g-3">
          <div class="col-md-6">
            <label for="apellidos" class="form-label fw-semibold">
              <i class="bi bi-person-badge"></i> Apellidos
            </label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" 
                   value="<?= $persona['apellidos'] ?>" required>
          </div>
          <div class="col-md-6">
            <label for="nombres" class="form-label fw-semibold">
              <i class="bi bi-person"></i> Nombres
            </label>
            <input type="text" class="form-control" id="nombres" name="nombres" 
                   value="<?= $persona['nombres'] ?>" required>
          </div>
        </div>

        <!-- Teléfono y Dirección -->
        <div class="row g-3 mt-1">
          <div class="col-md-4">
            <label for="telefono" class="form-label fw-semibold">
              <i class="bi bi-telephone"></i> Teléfono
            </label>
            <input type="text" class="form-control" id="telefono" name="telefono" 
                   maxlength="9" pattern="9[0-9]{8}" 
                   title="El teléfono debe comenzar con 9 y tener 9 dígitos"
                   value="<?= $persona['telefono'] ?>">
          </div>
          <div class="col-md-8">
            <label for="direccion" class="form-label fw-semibold">
              <i class="bi bi-house"></i> Dirección
            </label>
            <input type="text" class="form-control" id="direccion" name="direccion" 
                   value="<?= $persona['direccion'] ?>">
          </div>
        </div>

        <!-- Ubigeo -->
        <div class="row g-3 mt-1">
          <div class="col-md-4">
            <label for="departamentos" class="form-label fw-semibold">
              <i class="bi bi-building"></i> Departamento
            </label>
            <select name="departamentos" id="departamentos" class="form-select" required>
              <option value="">Seleccione</option>
              <?php foreach($departamentos as $dep): ?>
                <option value="<?= $dep['iddepartamento'] ?>" 
                  <?= ($dep['iddepartamento'] == $departamentoSeleccionado ? 'selected' : '') ?>>
                  <?= esc($dep['departamento']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="provincias" class="form-label fw-semibold">
              <i class="bi bi-map"></i> Provincia
            </label>
            <select name="provincias" id="provincias" class="form-select" required>
              <option value="<?= $provinciaSeleccionada ?>"><?= esc($nombreProvincia) ?></option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="distritos" class="form-label fw-semibold">
              <i class="bi bi-geo-alt"></i> Distrito
            </label>
            <select name="distritos" id="distritos" class="form-select" required>
              <option value="<?= $persona['iddistrito'] ?>"><?= esc($nombreDistrito) ?></option>
            </select>
          </div>
        </div>

      </div>
      <div class="card-footer text-end">
        <a href="<?= base_url('personas') ?>" class="btn btn-sm btn-outline-secondary">
          <i class="bi bi-x-circle"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-sm btn-primary">
          <i class="bi bi-save"></i> Actualizar
        </button>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("form-editar-persona");
  const telefono = document.getElementById("telefono");

  // Validación Teléfono 
  telefono.addEventListener("input", () => {
    telefono.value = telefono.value.replace(/\D/g, "");
  });

  // Confirmación actualización
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    Swal.fire({
      title: "¿Confirmar actualización?",
      text: "Se guardarán los cambios de la persona.",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: "Sí, actualizar",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Persona actualizada correctamente",
          showConfirmButton: false,
          timer: 2500,
          toast: true
        });
        setTimeout(() => form.submit(), 1200);
      }
    });
  });

  // Dependencias de Ubigeo
  const departamentos = document.getElementById("departamentos");
  const provincias = document.getElementById("provincias");
  const distritos = document.getElementById("distritos");

  departamentos.addEventListener("change", () => {
    fetch("<?= base_url('api/ubigeo/provincias') ?>/" + departamentos.value)
      .then(res => res.json())
      .then(data => {
        provincias.innerHTML = "<option value=''>Seleccione</option>";
        distritos.innerHTML = "<option value=''>Seleccione</option>";
        data.forEach(p => {
          provincias.innerHTML += `<option value="${p.idprovincia}">${p.provincia}</option>`;
        });
      });
  });

  provincias.addEventListener("change", () => {
    fetch("<?= base_url('api/ubigeo/distritos') ?>/" + provincias.value)
      .then(res => res.json())
      .then(data => {
        distritos.innerHTML = "<option value=''>Seleccione</option>";
        data.forEach(d => {
          distritos.innerHTML += `<option value="${d.iddistrito}">${d.distrito}</option>`;
        });
      });
  });
});
</script>

<?= $footer; ?>
