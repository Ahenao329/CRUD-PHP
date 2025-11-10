$(function() {
    const controller = "../controllers/EmployeeController.php";

    cargarEmpleados();

    $("#formEmpleado").on("submit", function(e) {
        e.preventDefault();
        const id = $("#idEmpleado").val().trim();
        const action = id ? "update" : "create";
        const url = `${controller}?action=${action}`;

        $.ajax({
            url,
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(res) {
                if(res.status === 'success'){
                    $("#mensaje").html(`<div style="color:green">✅ ${res.message}</div>`);
                    resetForm();
                    cargarEmpleados();
                } else {
                    $("#mensaje").html(`<div style="color:red">❌ ${res.message}</div>`);
                }
            },
            error: function(xhr) {
                $("#mensaje").html(`<div style="color:red">❌ Error: ${xhr.responseText || xhr.statusText}</div>`);
            }
        });
    });

    $("#cancelarEdicion").on("click", resetForm);

    function cargarEmpleados() {
        $.ajax({
            url: controller + "?action=list",
            type: "GET",
            dataType: "json",
            success: function(res) {
                if(res.status === 'success'){
                    renderTable(res.data);
                } else {
                    $("#tablaEmpleados").html(`<div style="color:red">${res.message}</div>`);
                }
            },
            error: function(xhr) {
                $("#tablaEmpleados").html(`<div style="color:red">Error cargando empleados: ${xhr.responseText || xhr.statusText}</div>`);
            }
        });
    }

    function renderTable(rows) {
        if (!rows || rows.length === 0) {
            $("#tablaEmpleados").html("<p>No hay empleados registrados.</p>");
            return;
        }

        let html = "<table>";
        html += "<thead><tr><th>Nombre</th><th>Email</th><th>Cargo</th><th>Salario</th><th>Acciones</th></tr></thead><tbody>";

        rows.forEach(r => {
            const id = r.id ?? '';
            const nombre = escapeHtml(r.Nombre ?? '');
            const email = escapeHtml(r.Correo ?? '');
            const cargo = escapeHtml(r.Cargo ?? '');
            const salario = escapeHtml(r.Salario ?? '');

            html += `<tr>
                        <td>${nombre}</td>
                        <td>${email}</td>
                        <td>${cargo}</td>
                        <td>${salario}</td>
                        <td>
                            <button class="editar" data-id="${id}" data-nombre="${nombre}" data-email="${email}" data-cargo="${cargo}" data-salario="${salario}">Editar</button>
                            <button class="eliminar" data-id="${id}">Eliminar</button>
                        </td>
                     </tr>`;
        });

        html += "</tbody></table>";
        $("#tablaEmpleados").html(html);
    }

    $(document).on("click", ".editar", function() {
        const btn = $(this);
        $("#idEmpleado").val(btn.data("id"));
        $("#nombre").val(btn.data("nombre"));
        $("#email").val(btn.data("email"));
        $("#cargo").val(btn.data("cargo"));
        $("#salario").val(btn.data("salario"));
        $("#btnGuardar").text("Actualizar");
        $("#cancelarEdicion").show();
        $("html, body").animate({ scrollTop: $("#formEmpleado").offset().top }, 300);
    });

    $(document).on("click", ".eliminar", function() {
        const id = $(this).data("id");
        if (!id) return alert("ID inválido");
        if (!confirm("¿Seguro que deseas eliminar este empleado?")) return;

        $.ajax({
            url: controller + "?action=delete",
            type: "POST",
            data: { id },
            dataType: "json",
            success: function(res) {
                if(res.status === 'success'){
                    $("#mensaje").html(`<div style="color:green">✅ ${res.message}</div>`);
                    cargarEmpleados();
                } else {
                    $("#mensaje").html(`<div style="color:red">❌ ${res.message}</div>`);
                }
            },
            error: function(xhr) {
                $("#mensaje").html(`<div style="color:red">❌ Error: ${xhr.responseText || xhr.statusText}</div>`);
            }
        });
    });

    function resetForm() {
        $("#formEmpleado")[0].reset();
        $("#idEmpleado").val("");
        $("#btnGuardar").text("Registrar");
        $("#cancelarEdicion").hide();
    }

    function escapeHtml(text) {
        if (!text && text !== 0) return "";
        return String(text).replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }
});
