<?= $header; ?>

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body text-center p-5">
          <i class="bi bi-journal-bookmark-fill display-1 text-primary"></i>
          <h1 class="fw-bold mt-3">Bienvenido a la Biblioteca Virtual</h1>
          <p class="lead text-muted mt-2">
            Accede a libros, editoriales y personas vinculadas al conocimiento en un solo lugar.
          </p>
          <div class="mt-4">
            <a href="<?= base_url('libros'); ?>" class="btn btn-primary btn-lg me-2">
              <i class="bi bi-book"></i> Explorar Libros
            </a>
            <a href="<?= base_url('personas'); ?>" class="btn btn-outline-dark btn-lg">
              <i class="bi bi-person-lines-fill"></i> Personas
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $footer; ?>
