<?= $header; ?>

<div class="container mt-2">
  <div class="my-2">
    <h4>Lista de personas</h4>
    <a href="<?= base_url("personas/crear"); ?>" class="btn btn-sm btn-info">Registrar</a>
  </div>

  <?php //print_r($personas); ?>

  <div class="table-resposive">
    <table class="table table-sm table-striped">
      <thead>
        <tr>
          <th>#</th>
          <th>DNI</th>
          <th>Apellidos</th>
          <th>Nombres</th>
          <th>Teléfono</th>
          <th>Ubigeo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($personas as $persona): ?>
          <tr>
            <td><?= $persona['idpersona'] ?></td>
            <td><?= $persona['dni'] ?></td>
            <td><?= $persona['apellidos'] ?></td>
            <td><?= $persona['nombres'] ?></td>
            <td><?= $persona['telefono'] ?></td>
            <td><?= $persona['iddistrito'] ?></td>
            <td>
              <a href="#">Editar</a>
              <a href="#">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    
  })
</script>

<?= $footer; ?>