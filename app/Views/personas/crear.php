<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Registro de personas</h4>
    <a href="<?= base_url("personas"); ?>">Listar</a>
  </div>

  <form action="<?= base_url('personas/guardar') ?>" method="POST" autocomplete="off">
    <div class="card">
      <div class="card-body">
        <div class="mb-2">
          <label for="">Buscador por DNI</label>
          <small class="d-none" id="searching"> - Por favor espere...</small>
          <div class="input-group">
            <input type="text" class="form-control" id="dni" name="dni" maxlength="8" minlength="8" required autofocus>
            <button class="btn btn-outline-success" type="button" id="buscar-dni">Buscar</button>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-6 mb-2">
            <label for="apellidos">Apellidos</label>
            <input type="text" class="form-control" name="apellidos" id="apellidos" required>
          </div>
          <div class="col-md-6 mb-2">
            <label for="nombres">Nombres</label>
            <input type="text" class="form-control" name="nombres" id="nombres" required>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="telefono">Teléfono</label>
            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="9" pattern="[0-9]*" title="Solo se permiten números">
          </div>
          <div class="col-md-8 mb-2">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion">
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for="departamentos">Departamentos</label>
            <select name="departamentos" id="departamentos" class="form-select">
              <option value="">Seleccione</option>
              <?php foreach($departamentos as $departamento): ?>
                <option value="<?= $departamento['iddepartamento'] ?>"><?= $departamento['departamento'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="provincias">Provincias</label>
            <select name="provincias" id="provincias" class="form-select">
              <option value="">Seleccione</option>
            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="distritos">Distritos</label>
            <select name="distritos" id="distritos" class="form-select" required>
              <option value="">Seleccione</option>
            </select>
          </div>
        </div>

      </div>
      <div class="card-footer text-end">
        <button class="btn btn-sm btn-outline-secondary" type="reset">Cancelar</button>
        <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
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

    const departamentos = document.querySelector("#departamentos")
    const provincias = document.querySelector("#provincias")
    const distritos = document.querySelector("#distritos")

    async function buscarPorDni() {
      const dniValor = dni.value.trim()
      if (dniValor.length !== 8) {
        alert('Ingrese un DNI válido de 8 dígitos')
        return
      }

      try {
        buscando.classList.remove('d-none')
        const response = await fetch(`<?= base_url() ?>api/personas/buscardni/${dniValor}`, {
          method: 'GET',
          headers: { 'Content-type': 'application/json' }
        })

        if (!response.ok) {
          throw new Error('Error en la solicitud')
        }

        const data = await response.json()
        buscando.classList.add('d-none')

        if (data.success) {
          apellidos.value = `${data.apepaterno} ${data.apematerno}`
          nombres.value = data.nombres
        } else {
          apellidos.value = ''
          nombres.value = ''
          alert('No se encontraron datos para este DNI')
        }
      } catch (error) {
        buscando.classList.add('d-none')
        console.log(error)
        alert('Ocurrió un error al buscar el DNI')
      }
    }


    botonBusqueda.addEventListener('click', buscarPorDni)

    // Buscqueda de DNI por enter
    dni.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        event.preventDefault()
        buscarPorDni()
      }
    })

    // Carga de provincias al cambiar departamento
    departamentos.addEventListener('change', async () => {
      const iddepartamento = departamentos.value

      provincias.innerHTML = '<option value="">Seleccione</option>'
      distritos.innerHTML = '<option value="">Seleccione</option>'

      if (!iddepartamento) return

      try {
        const response = await fetch(`http://biblioteca.test/api/ubigeo/provincias/${iddepartamento}`, {
          method: 'GET',
          headers: { 'Content-type': 'application/json' }
        })

        if (!response.ok) {
          throw new Error('Error en la solicitud al servidor')
        }

        const data = await response.json()
        if (data.length) {
          data.forEach(element => {
            provincias.innerHTML += `<option value="${element.idprovincia}">${element.provincia}</option>`
          })
        }
      } catch (error) {
        console.error(error)
      }
    })
  })

  // Carga de distritos al cambiar provincia
  provincias.addEventListener('change', async () => {
    const idprovincia = provincias.value
    distritos.innerHTML = '<option value="">Seleccione</option>'

    if (!idprovincia) return

    try {
      const response = await fetch(`http://biblioteca.test/api/ubigeo/distritos/${idprovincia}`, {
        method: 'GET',
        headers: { 'Content-type': 'application/json' }
      })

      if (!response.ok) {
        throw new Error('Error en la solicitud al servidor')
      }

      const data = await response.json()
      if (data.length) {
        data.forEach(element => {
          distritos.innerHTML += `<option value="${element.iddistrito}">${element.distrito}</option>`
        })
      }
    } catch (error) {
      console.error(error)
    }
  })



  // Confirmar antes de enviar el formulario
  const formulario = document.querySelector("form");

formulario.addEventListener("submit", function (event) {
  event.preventDefault(); 

  Swal.fire({
    title: "¡Guardado con éxito!",
    icon: "success",
    timer: 3000, 
    timerProgressBar: true,
    showConfirmButton: false,
    didOpen: () => {
      
      setTimeout(() => {
        formulario.submit();
      }, 3000); 
    }
  });
});


</script>

<?= $footer; ?>
