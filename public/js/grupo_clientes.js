function cargarGrupoClientes() {
    $("#contenido_grupo_clientes").html("<div class='text-center' style='padding:100px;'><div class='spinner-border' role='status'></div></div>");
    $.ajax({
        type:'GET',
        url:'api/grupoclientes',
        data:{},
        success:function(data) {
            var contenido = "";

            if (data.status == "ok") {
                data.message = "";
                var color = "class='alert alert-success text-center' role='alert'";
                contenido += mostrarResultadosGrupoClientes(data);
            } else {
                var color = "class='alert alert-danger text-center' role='alert'";
            }

            if (data.message != "") {
                $("#mensaje_grupo_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
            }

            $("#contenido_grupo_clientes").html(contenido);
        }
    });
}

function buscarGrupoClientes() {
    var texto_grupo_cliente = $("#texto_grupo_cliente").val();

    if (texto_grupo_cliente == "") {
        cargarGrupoClientes();
    } else {
        $.ajax({
            type:'GET',
            url:'api/grupoclientes/buscar/' + texto_grupo_cliente,
            data:{},
            success:function(data) {
                var contenido = "";

                if (data.status == "ok") {
                    data.message = "";
                    var color = "class='alert alert-success text-center' role='alert'";
                    contenido += mostrarResultadosGrupoClientes(data);
                } else {
                    var color = "class='alert alert-danger text-center' role='alert'";
                }
    
                if (data.message != "") {
                    $("#mensaje_grupo_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
                }
    
                $("#contenido_grupo_clientes").html(contenido);
            }
        });
    }
}

function mostrarResultadosGrupoClientes(data) {
    let contenido = "<table class='table'>\n";
    contenido += "<thead>\n";
    contenido += "<tr>\n";
    contenido += "<th scope='col'>#</th>\n";
    contenido += "<th scope='col'>Nombre</th>\n";
    contenido += "<th scope='col'>&nbsp;</th>\n";
    contenido += "</tr>\n";
    contenido += "</thead>\n";
    contenido += "<tbody>\n";
    
    $.each(data.data, function(key, value) {
        contenido += "<tr>\n";
        contenido += "<td>" + value.id + "</td>\n";
        contenido += "<td>" + value.nombre + "</td>\n";

        if (value.id > 1) {
            contenido += "<td class='text-end'><button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#formGrupoClientes' onclick='abrirFormGrupoCliente(" + value.id + ");' title='Editar Grupo de Cliente'>Editar</button>&nbsp;<button class='btn btn-danger' onclick='eliminarGrupoCliente(" + value.id + ");' title='Eliminar Grupo de Cliente'>Eliminar</button></td>\n";
        } else {
            contenido += "<td>&nbsp;</td>\n";
        }
        
        contenido += "</tr>\n";
    });

    contenido += "</tbody>\n";
    contenido += "</table>\n";
    
    return contenido;
}

function abrirFormGrupoCliente(id) {
    $("#grupo_cliente_id").val(id);

    if (id == 0) {
        $("#tituloFormGrupoClientes").text("Agregar Grupo de Cliente");
        $("#grupo_cliente_nombre").val("");
    } else {
        $("#tituloFormGrupoClientes").text("Editar Grupo de Cliente");

        $.ajax({
            type:'GET',
            url:'api/grupocliente/' + id,
            data:{},
            success:function(data) {
                if (data.status == "ok") {    
                    $("#grupo_cliente_nombre").val(data.data.nombre);
                }
            }
        });
    }
}

function cerrarFormGrupoCliente() {
    $("#formGrupoClientes").modal("hide");
}

function guardarGrupoCliente() {
    var id = $("#grupo_cliente_id").val();
    var nombre = $("#grupo_cliente_nombre").val();

    if (nombre == "") {
        $("#grupo_cliente_nombre").addClass("is-invalid");
        return false;
    } else {
        $("#grupo_cliente_nombre").removeClass("is-invalid");
    }

    if (id == 0) {
        $.ajax({
            type:'POST',
            url:'api/grupocliente',
            data:{nombre:nombre},
            success:function(data) {
                if (data.status == "ok") {
                    var color = "class='alert alert-success text-center' role='alert'";
                } else {
                    var color = "class='alert alert-danger text-center' role='alert'";
                }
    
                $("#mensaje_grupo_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
            }
        });
    } else {
        $.ajax({
            type:'PUT',
            url:'api/grupocliente/' + id,
            data:{nombre:nombre},
            success:function(data) {
                if (data.status == "ok") {
                    var color = "class='alert alert-success text-center' role='alert'";
                } else {
                    var color = "class='alert alert-danger text-center' role='alert'";
                }
    
                $("#mensaje_grupo_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
            }
        });
    }

    cargarGrupoClientes();
    cerrarFormGrupoCliente();
}

function eliminarGrupoCliente(id) {
    $.ajax({
        type:'DELETE',
        url:'api/grupocliente/' + id,
        data:{},
        success:function(data) {
            if (data.status == "ok") {
                var color = "class='alert alert-success text-center' role='alert'";
            } else {
                var color = "class='alert alert-danger text-center' role='alert'";
            }

            $("#mensaje_grupo_clientes").html("<p " + color + "><small>" + data.message + "</small></p>").show().delay(5000).fadeOut(500);
        }
    });

    cargarGrupoClientes();
}