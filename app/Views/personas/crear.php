<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Registro de personas</h4>
    <a href="<?= base_url("personas"); ?>" >Listar</a>
  </div>

  <form action="<?= base_url('personas/guardar') ?>" method="POST" autocomplete="off">
    <div class="card">
      <div class="card-body">
        <div class="mb-2">
          <label for="">Buscador por DNI</label>
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
            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="9" pattern="[0-9]*"
              title="Solo se permiten números" required>
          </div>
          <div class="col-md-8 mb-2">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" name="direccion" id="direccion">
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-4 mb-2">
            <label for=departamentos">Departamentos</label>
            <select name="departamentos" id="departamentos" class="form-select">

            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="provincias">Provincias</label>
            <select name="provincias" id="provincias" class="form-select">

            </select>
          </div>
          <div class="col-md-4 mb-2">
            <label for="distritos">Distritos</label>
            <select name="distritos" id="distritos" class="form-select" required>
              <option value="1006">Grocio Prado</option>
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
    const dni = document.querySelector("#dni")

    botonBusqueda.addEventListener('click', async () => {
      
      if (!dni.value){
        alert('Escriba el DNI')
        return
      }

      try{
        const response = await fetch(`<?= base_url() ?>api/personas/buscardni/${dni.value}`, {
          method: 'GET',
          headers: {'Content-type': 'application/json'}
        })

        if (!response.ok){
          throw new Error('Error en la solicitud')
        }

        const data = await response.json()
        console.log(data)
      }
      catch (error){
        console.log(error)
      }

    })
  })
</script>

<?= $footer; ?>