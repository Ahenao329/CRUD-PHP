<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Registro de Empleados</title>
  <link rel="stylesheet" href="view/employe_view.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="view/employe_view.js"></script>
  <script src="employe_view_js" defer></script> <!-- opcional si usas archivo externo -->
</head>
<body>
  <h2>Registro de Empleados</h2>

  <!-- FORMULARIO (UN SOLO FORM) -->
  <form id="formEmpleado" autocomplete="off">
    <input type="hidden" name="id" id="idEmpleado">
    <label>
      <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>
    </label>
    <label>
      <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
    </label>
    <label>
      <input type="text" name="cargo" id="cargo" placeholder="Cargo" required>
    </label>
    <label>
      <input type="number" name="salario" id="salario" placeholder="Salario" required>
    </label>
    <button type="submit" id="btnGuardar">Registrar</button>
    <button type="button" id="cancelarEdicion" style="display:none;">Cancelar</button>
  </form>

  <div id="mensaje" style="margin-top:10px;"></div>

  <h3>Lista de Empleados</h3>
  <div id="tablaEmpleados"></div>

<script>

</script>
</body>
</html>
