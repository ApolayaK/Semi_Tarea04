<?= $header; ?>

<div class="container my-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="fw-bold text-primary">
      <i class="bi bi-person-plus-fill"></i> Registro de Personas
    </h2>
  </div>

  <form action="<?= base_url('personas/guardar') ?>" method="POST" autocomplete="off">
    <div class="card shadow-sm border-0">
      <div class="card-body">

        <!-- Buscador por DNI -->
        <div class="mb-3">
          <label class="form-label fw-semibold">
            <i class="bi bi-credit-card-2-front"></i> Buscador por DNI
          </label>
          <small class="d-none text-muted" id="searching"> - Por favor espere...</small>
          <div class="input-group">
            <input type="text" class="form-control" id="dni" name="dni" maxlength="8" minlength="8" required autofocus placeholder="Ingrese DNI">
            <button class="btn btn-outline-success" type="button" id="buscar-dni">
              <i class="bi bi-search"></i> Buscar
            </button>
          </div>
        </div>

        <!-- Datos personales -->
        <div class="row g-3">
          <div class="col-md-6">
            <label for="apellidos" class="form-label fw-semibold">
              <i class="bi bi-person-badge"></i> Apellidos
            </label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" required>
          </div>
          <div class="col-md-6">
            <label for="nombres" class="form-label fw-semibold">
              <i class="bi bi-person"></i> Nombres
            </label>
            <input type="text" class="form-control" name="nombres" id="nombres" required>
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-md-4">
            <label for="telefono" class="form-label fw-semibold">
              <i class="bi bi-telephone"></i> Teléfono
            </label>
            <input 
              type="text" 
              class="form-control" 
              name="telefono" 
              id="telefono" 
              maxlength="9" 
              required
              placeholder="Ej: 987654321" 
              title="Debe empezar con 9 y tener 9 dígitos">
          </div>
          <div class="col-md-8">
            <label for="direccion" class="form-label fw-semibold">
              <i class="bi bi-house"></i> Dirección
            </label>
            <input 
              type="text" 
              class="form-control" 
              name="direccion" 
              id="direccion" 
              required>
          </div>
        </div>

        <!-- Ubigeo -->
        <div class="row g-3 mt-1">
          <div class="col-md-4">
            <label for="departamentos" class="form-label fw-semibold">
              <i class="bi bi-building"></i> Departamentos
            </label>
            <select name="departamentos" id="departamentos" class="form-select">
              <option value="">Seleccione</option>
              <?php foreach($departamentos as $departamento): ?>
                <option value="<?= $departamento['iddepartamento'] ?>"><?= $departamento['departamento'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="provincias" class="form-label fw-semibold" required>
              <i class="bi bi-map"></i> Provincias
            </label>
            <select name="provincias" id="provincias" class="form-select" required>
              <option value="">Seleccione</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="distritos" class="form-label fw-semibold">
              <i class="bi bi-geo-alt"></i> Distritos
            </label>
            <select name="distritos" id="distritos" class="form-select" required>
              <option value="">Seleccione</option>
            </select>
          </div>
        </div>

      </div>

      <!-- Footer de la tarjeta -->
      <div class="card-footer d-flex justify-content-end gap-2">
        <a href="<?= base_url("personas"); ?>" class="btn btn-outline-secondary">
          <i class="bi bi-x-circle"></i> Cancelar
        </a>
        <button class="btn btn-primary" type="submit">
          <i class="bi bi-save"></i> Guardar
        </button>
      </div>
    </div>
  </form>
</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const botonBusqueda = document.querySelector("#buscar-dni")
    const apellidos = document.querySelector("#apellidos")
    const nombres = document.querySelector("#nombres")
    const dni = document.querySelector("#dni")
    const buscando = document.querySelector("#searching")

    const telefono = document.querySelector("#telefono")
    const departamentos = document.querySelector("#departamentos")
    const provincias = document.querySelector("#provincias")
    const distritos = document.querySelector("#distritos")

    // Solo números en teléfono
    telefono.addEventListener("input", () => {
      telefono.value = telefono.value.replace(/\D/g, "").slice(0, 9)
    })
    // Validar teléfono para que empiece con 9 y tenga 9 dígitos
    function validarTelefono(valor) {
      return /^9\d{8}$/.test(valor) 
    }

    async function buscarPorDni() {
      const dniValor = dni.value.trim()
      if (dniValor.length !== 8) {
        Swal.fire({
          icon: "warning",
          title: "DNI inválido",
          text: "Debe ingresar 8 dígitos numéricos",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000
        })
        return
      }

      try {
        buscando.classList.remove('d-none')
        const response = await fetch(`<?= base_url() ?>api/personas/buscardni/${dniValor}`)
        if (!response.ok) throw new Error('Error en la solicitud')

        const data = await response.json()
        buscando.classList.add('d-none')

        if (data.success) {
          apellidos.value = `${data.apepaterno} ${data.apematerno}`
          nombres.value = data.nombres
        } else {
          apellidos.value = ''
          nombres.value = ''
          Swal.fire({
            icon: "info",
            title: "Sin resultados",
            text: "No se encontraron datos para este DNI",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000
          })
        }
      } catch (error) {
        buscando.classList.add('d-none')
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Ocurrió un error al buscar el DNI",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000
        })
      }
    }

    botonBusqueda.addEventListener('click', buscarPorDni)

    dni.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        event.preventDefault()
        buscarPorDni()
      }
    })

    // Provincias
    departamentos.addEventListener('change', async () => {
      const iddepartamento = departamentos.value
      provincias.innerHTML = '<option value="">Seleccione</option>'
      distritos.innerHTML = '<option value="">Seleccione</option>'
      if (!iddepartamento) return

      try {
        const response = await fetch(`http://biblioteca.test/api/ubigeo/provincias/${iddepartamento}`)
        if (!response.ok) throw new Error('Error en la solicitud')
        const data = await response.json()
        data.forEach(element => {
          provincias.innerHTML += `<option value="${element.idprovincia}">${element.provincia}</option>`
        })
      } catch (error) {
        console.error(error)
      }
    })

    // Distritos
    provincias.addEventListener('change', async () => {
      const idprovincia = provincias.value
      distritos.innerHTML = '<option value="">Seleccione</option>'
      if (!idprovincia) return

      try {
        const response = await fetch(`http://biblioteca.test/api/ubigeo/distritos/${idprovincia}`)
        if (!response.ok) throw new Error('Error en la solicitud')
        const data = await response.json()
        data.forEach(element => {
          distritos.innerHTML += `<option value="${element.iddistrito}">${element.distrito}</option>`
        })
      } catch (error) {
        console.error(error)
      }
    })

    // Confirmación antes de guardar
    const formulario = document.querySelector("form")
    formulario.addEventListener("submit", function (event) {
      event.preventDefault()

      if (!validarTelefono(telefono.value)) {
        Swal.fire({
          icon: "error",
          title: "Teléfono inválido",
          text: "El número es invalido.",
          toast: true,
          position: "top-end",
          showConfirmButton: false,
          timer: 3000
        })
        return
      }

      Swal.fire({
        title: "¿Deseas guardar los datos?",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí, guardar",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            icon: "success",
            title: "¡Guardado con éxito!",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
          })
          setTimeout(() => {
            formulario.submit()
          }, 1000)
        }
      })
    })
  })
</script>

<?= $footer; ?>
