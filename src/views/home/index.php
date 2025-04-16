<?php include __DIR__ . '/../layout/header.php'; ?>

<style>
  /* Aplica fondo a todo el body */
  body {
    background: url('../imagenes/furgoneta.jpg') no-repeat center center fixed;
    background-size: cover;
  }

  /* Si el texto no se lee bien, puedes usar un color de texto claro */
  .fondo-blanco {
    background-color: rgba(255, 255, 255, 0.8);
    padding: 2rem;
    border-radius: 5px;
  }
</style>

<div class="container py-5">
  <div class="fondo-blanco">
    <h1>Bienvenido a Isla-Transfers</h1>
    <p class="lead">
 Grupo OPTIPHP
<br>
<br>
 Sentiros libres de poner lo que querais aqui!!
    </p>
  </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
