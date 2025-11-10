<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro de Empleados</title>
<link rel="stylesheet" href="/view/employe_view.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h2>Registro de Empleados</h2>

<!-- FORMULARIO CREAR -->
<form id="formEmpleado">  <input type="hidden" name="id" id="idEmpleado">
  <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" required>
  <input type="email" name="email" id="email" placeholder="Correo electrónico" required>
  <input type="text" name="cargo" id="cargo" placeholder="Cargo" required>
  <input type="number" name="salario" id="salario" placeholder="Salario" required>
  <button type="submit" id="btnGuardar">Registrar</button>
  <button type="button" id="cancelarEdicion" style="display:none;">Cancelar</button>
</form>


<div id="mensaje" style="margin-top:10px;"></div>

<h3>Lista de Empleados</h3>
<div id="tablaEmpleados"></div>

<script>
$(document).ready(function(){

  cargarEmpleados();

  // 🔹 Guardar (insertar o actualizar)
  $("#formEmpleado").submit(function(e){
    e.preventDefault();
    const id = $("#idEmpleado").val();
    const url = id ? "../CRUD/update.php" : "../CRUD/create.php";
    const accion = id ? "actualizado" : "registrado";

    $.ajax({
      url,
      type: "POST",
      data: $(this).serialize(),
      success: function(res){
        $("#mensaje").html("✅ Empleado " + accion + " correctamente");
        $("#formEmpleado")[0].reset();
        $("#idEmpleado").val("");
        $("#btnGuardar").text("Registrar");
        $("#cancelarEdicion").hide();
        cargarEmpleados();
      }
    });
  });

  // 🔹 Cargar empleados
  function cargarEmpleados(){
    $.ajax({
      url: "../CRUD/list.php",
      type: "GET",
      success: function(data){
        $("#tablaEmpleados").html(data);
      }
    });
  }

  // 🔹 Editar
  $(document).on("click", ".editar", function(){
    $("#idEmpleado").val($(this).data("id"));
    $("#nombre").val($(this).data("nombre"));
    $("#email").val($(this).data("email"));
    $("#cargo").val($(this).data("cargo"));
    $("#salario").val($(this).data("salario"));
    $("#btnGuardar").text("Actualizar");
    $("#cancelarEdicion").show();
    $("html, body").animate({ scrollTop: $("#formEmpleado").offset().top }, 500);
  });

  // 🔹 Cancelar edición
  $("#cancelarEdicion").click(function(){
    $("#formEmpleado")[0].reset();
    $("#idEmpleado").val("");
    $("#btnGuardar").text("Registrar");
    $(this).hide();
  });

  // 🔹 Eliminar
  $(document).on("click", ".eliminar", function(){
    const id = $(this).data("id");
    if(confirm("¿Seguro que deseas eliminar este empleado?")){
      $.ajax({
        url: "../CRUD/delete.php",
        type: "POST",
        data: { id },
        success: function(res){
          $("#mensaje").html(res);
          cargarEmpleados();
        }
      });
    }
  });
});

</script>
</body>
</html>
