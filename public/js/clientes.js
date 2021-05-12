function cargarClientes() {
    $("#contenido_clientes").html("<div class='text-center' style='padding:100px;'><div class='spinner-border' role='status'></div></div>");
    $.ajax({
        type:'GET',
        url:'api/clientes',
        data:{},
        success:function(data) {
            var contenido = "";

            if (data.status == "ok") {
                data.message = "";
                var color = "class='alert alert-success text-center' role='alert'";
                contenido += mostrarResultadosClientes(data);
            } else {
                var color = "class='alert alert-danger text-center' role='alert'";
            }

            if (data.message != "") {
                $("#mensaje_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
            }

            $("#contenido_clientes").html(contenido);
        }
    });
}

function cargarSelectGrupoClientes() {
    $("#select_grupo_cliente").children().remove().end().append("<option selected value='0'>Todos</option>");

    $.ajax({
        type:'GET',
        url:'api/grupoclientes',
        data:{},
        success:function(data) {
            if (data.status == "ok") {                
                $.each(data.data, function(key, value) {
                    if (value.id > 1) {
                        $("#select_grupo_cliente").append($("<option>", {value:value.id, text:value.nombre}));
                    }
                });
            } else {
                $("#select_grupo_cliente").append($("<option>", {value:"", text:"No se encontraron resultados"}));
            }
        }
    });
}

function buscarClientes() {
    var texto_cliente = $("#texto_cliente").val();
    
    if (texto_cliente == "") {
        cargarClientes();
    } else {
        $.ajax({
            type:'GET',
            url:'api/clientes/buscar/' + texto_cliente,
            data:{},
            success:function(data) {
                var contenido = "";

                if (data.status == "ok") {
                    data.message = "";
                    var color = "class='alert alert-success text-center' role='alert'";
                    contenido += mostrarResultadosClientes(data);
                } else {
                    var color = "class='alert alert-danger text-center' role='alert'";
                }
    
                if (data.message != "") {
                    $("#mensaje_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
                }
    
                $("#contenido_clientes").html(contenido);
            }
        });
    }
}

function mostrarResultadosClientes(data) {
    let contenido = "<table class='table'>\n";
    contenido += "<thead>\n";
    contenido += "<tr>\n";
    contenido += "<th scope='col'>#</th>\n";
    contenido += "<th scope='col'>Nombre</th>\n";
    contenido += "<th scope='col'>Apellido</th>\n";
    contenido += "<th scope='col'>Email</th>\n";
    contenido += "<th scope='col'>Grupo de Cliente</th>\n";
    contenido += "<th scope='col'>&nbsp;</th>\n";
    contenido += "</tr>\n";
    contenido += "</thead>\n";
    contenido += "<tbody>\n";
    
    $.each(data.data, function(key, value) {
        contenido += "<tr>\n";
        contenido += "<td>" + value.id + "</td>\n";
        contenido += "<td>" + value.nombre + "</td>\n";
        contenido += "<td>" + value.apellido + "</td>\n";
        contenido += "<td>" + value.email + "</td>\n";
        contenido += "<td>" + value.grupo_cliente_nombre + "</td>\n";
        contenido += "<td class='text-end'><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#formClientes' onclick='abrirFormCliente(" + value.id + ");' title='Editar Cliente'>Editar</button>&nbsp;<button class='btn btn-danger' onclick='eliminarCliente(" + value.id + ");' title='Eliminar Cliente'>Eliminar</button></td>\n";
        contenido += "</tr>\n";
    });

    contenido += "</tbody>\n";
    contenido += "</table>\n";
    
    return contenido;
}

function filtrarClientesPorGrupo() {
    var select_grupo_cliente = $("#select_grupo_cliente").val();
    
    if (select_grupo_cliente == 0) {
        cargarClientes();
    } else {
        $.ajax({
            type:'GET',
            url:'api/clientes/filtrar/' + select_grupo_cliente,
            data:{},
            success:function(data) {
                var contenido = "";

                if (data.status == "ok") {
                    data.message = "";
                    var color = "class='alert alert-success text-center' role='alert'";
                    contenido += mostrarResultadosClientes(data);
                } else {
                    var color = "class='alert alert-danger text-center' role='alert'";
                }
    
                if (data.message != "") {
                    $("#mensaje_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
                }
    
                $("#contenido_clientes").html(contenido);
            }
        });
    }
}

function abrirFormCliente(id) {
    $("#cliente_id").val(id);
    $("#cliente_grupo_cliente_id").children().remove();
    
    $.ajax({
        type:'GET',
        url:'api/grupoclientes',
        data:{},
        success:function(data) {    
            if (data.status == "ok") {                
                $.each(data.data, function(key, value) {
                    if (value.id > 1) {
                        $("#cliente_grupo_cliente_id").append($("<option>", {value:value.id, text:value.nombre}));
                    }
                });
            }
        }
    });
    
    if (id == 0) {
        $("#tituloFormClientes").text("Agregar Cliente");
        $("#cliente_nombre").val("");
        $("#cliente_apellido").val("");
        $("#cliente_email").val("");
        $("#cliente_observaciones").val("");
    } else {
        $("#tituloFormClientes").text("Editar Cliente");

        $.ajax({
            type:'GET',
            url:'api/cliente/' + id,
            data:{},
            success:function(data) {
                if (data.status == "ok") {    
                    $("#cliente_nombre").val(data.data.nombre);
                    $("#cliente_apellido").val(data.data.apellido);
                    $("#cliente_email").val(data.data.email);
                    $("#cliente_observaciones").val(data.data.observaciones);
                    $("#cliente_grupo_cliente_id").find("option").each(function() {
                        if ($(this).val() == data.data.grupo_cliente_id) {
                            $(this).attr("selected", true);
                        }
                    });
                }
            }
        });
    }
}

function cerrarFormCliente() {
    $("#formClientes").modal("hide");
}

function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    
    return emailReg.test($email);
}

function guardarCliente() {
    var id = $("#cliente_id").val();
    var nombre = $("#cliente_nombre").val();
    var apellido = $("#cliente_apellido").val();
    var email = $("#cliente_email").val();
    var observaciones = $("#cliente_observaciones").val();
    var grupo_cliente_id = $("#cliente_grupo_cliente_id").val();

    if (nombre == "") {
        $("#cliente_nombre").addClass("is-invalid");
        return false;
    } else {
        $("#cliente_nombre").removeClass("is-invalid");
    }

    if ((email == "") || (!validateEmail(email))) {
        $("#cliente_email").addClass("is-invalid");
        return false;
    } else {
        $("#cliente_email").removeClass("is-invalid");
    }

    if (id == 0) {
        $.ajax({
            type:'POST',
            url:'api/cliente',
            data:{nombre:nombre, apellido:apellido, email:email, observaciones:observaciones, grupo_cliente_id:grupo_cliente_id},
            success:function(data) {
                if (data.status == "ok") {
                    var color = "class='alert alert-success text-center' role='alert'";
                } else {
                    var color = "class='alert alert-danger text-center' role='alert'";
                }
    
                $("#mensaje_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
            }
        });
    } else {
        $.ajax({
            type:'PUT',
            url:'api/cliente/' + id,
            data:{nombre:nombre, apellido:apellido, email:email, observaciones:observaciones, grupo_cliente_id:grupo_cliente_id},
            success:function(data) {
                if (data.status == "ok") {
                    var color = "class='alert alert-success text-center' role='alert'";
                } else {
                    var color = "class='alert alert-danger text-center' role='alert'";
                }
    
                $("#mensaje_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
            }
        });
    }

    cargarClientes();
    cerrarFormCliente();
}

function eliminarCliente(id) {
    $.ajax({
        type:'DELETE',
        url:'api/cliente/' + id,
        data:{},
        success:function(data) {
            if (data.status == "ok") {
                var color = "class='alert alert-success text-center' role='alert'";
            } else {
                var color = "class='alert alert-danger text-center' role='alert'";
            }

            $("#mensaje_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
        }
    });

    cargarClientes();
}