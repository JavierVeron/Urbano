function mostrarContainerClientes() {
    $("#container_clientes").show();
    cargarClientes();
}

function ocultarContainerClientes() {
    $("#container_clientes").hide();
}

function mostrarContainerGrupoClientes() {
    $("#container_grupo_clientes").show();
    cargarGrupoClientes();
}

function ocultarContainerGrupoClientes() {
    $("#container_grupo_clientes").hide();
}

$("#link_clientes").click(function () {
    ocultarContainerGrupoClientes();
    mostrarContainerClientes();
    cargarSelectGrupoClientes();
})

$("#link_grupo_clientes").click(function () {
    ocultarContainerClientes();
    mostrarContainerGrupoClientes();
})

function init() {
    $("#select_grupo_cliente").on("change", filtrarClientesPorGrupo);
    $("#link_clientes").click();
}