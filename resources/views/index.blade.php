<!doctype html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
<title>Clientes - Urbano Argentina</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div id="header" class="container">
  <div class="row">
    <div class="col-md-5 offset-md-1">
      <a href="/"><img src="images/urbano-logo.png" alt="Urbano"></a>
    </div>
    <div class="col-md-5 text-end pt-5">
      <a href="#" class="btn btn-secondary active mx-3" id="link_clientes" title="ABM de Clientes">Clientes</a><a href="#" class="btn btn-secondary" id="link_grupo_clientes" title="ABM de Grupo de Clientes">Grupo de Clientes</a>
    </div>
  </div>
</div>

<!-- Form de Clientes -->
<div class="modal fade" id="formClientes" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloFormClientes">Clientes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row py-1">
          <div class="col-md-3 text-end">Nombre:</div>
          <div class="col-md-9"><input type="text" class="form-control" id="cliente_nombre" name="cliente_nombre" value=""></div>
        </div>
        <div class="row py-1">
          <div class="col-md-3 text-end">Apellido:</div>
          <div class="col-md-9"><input type="text" class="form-control" id="cliente_apellido" name="cliente_apellido" value=""></div>
        </div>
        <div class="row py-1">
          <div class="col-md-3 text-end">Email:</div>
          <div class="col-md-9"><input type="text" class="form-control" id="cliente_email" name="cliente_email" value=""></div>
        </div>
        <div class="row py-1">
          <div class="col-md-3 text-end">Observaciones:</div>
          <div class="col-md-9"><textarea class="form-control" id="cliente_observaciones" name="cliente_observaciones"></textarea></div>
        </div>
        <div class="row py-1">
          <div class="col-md-3 text-end">Grupo de Cliente:</div>
          <div class="col-md-9"><select class="form-control" id="cliente_grupo_cliente_id" name="cliente_grupo_cliente_id"></select></div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="cliente_id" name="cliente_id" value="">
        <button type="button" class="btn btn-primary" onclick="guardarCliente();">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Listado de Clientes -->
<div id="container_clientes" class="container">
  <div class="row my-3">
    <div class="col-md-10 offset-md-1"><h1 class="display-5">Clientes</h1></div>
  </div>
  <div class="row my-3">
    <div class="col-md-2 offset-md-1">
      <button id="agregar_cliente" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formClientes" onclick="abrirFormCliente(0);" title="Agregar Cliente">Agregar</button>
    </div>
    <div class="col-md-4 offset-md-1">
      <div class="input-group">
        <input type="text" id="texto_cliente" name="texto_cliente" class="form-control" placeholder="Ingrese Nombre, Apellido o Email">
        <button type="button" class="btn btn-secondary" id="buscar_cliente" name="buscar_cliente" onclick="buscarClientes();">Buscar</button>
      </div>
    </div>
    <div class="col-md-3 text-end">
      <select class="form-select" id="select_grupo_cliente" name="select_grupo_cliente"><option value="0">Todos</option></select>
    </div>
  </div>
  <div class="row my-3">
    <div id="mensaje_clientes" class="col-md-10 offset-md-1"></div>
  </div>
  <div class="row">
    <div id="contenido_clientes" class="col-md-10 offset-md-1"></div>
  </div>
</div>

<!-- Form de Grupo de Clientes -->
<div class="modal fade" id="formGrupoClientes" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloFormGrupoClientes">Grupo de Clientes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row py-1">
          <div class="col-md-3 text-end">Nombre:</div>
          <div class="col-md-9"><input type="text" class="form-control" id="grupo_cliente_nombre" name="grupo_cliente_nombre" value=""></div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="grupo_cliente_id" name="grupo_cliente_id" value="">
        <button type="button" class="btn btn-primary" onclick="guardarGrupoCliente();">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Listado de Grupo de Clientes -->
<div id="container_grupo_clientes" class="container">
<div class="row">
    <div class="col-md-10 offset-md-1 my-3"><h1 class="display-5">Grupo de Clientes</h1></div>
  </div>
  <div class="row">
    <div class="col-md-2 offset-md-1">
      <button id="agregar_grupo_cliente" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formGrupoClientes" onclick="abrirFormGrupoCliente(0);" title="Agregar Grupo de Cliente">Agregar</button>
    </div>
    <div class="col-md-4 offset-md-1">
      <div class="input-group mb-3 text-end">
        <input type="text" id="texto_grupo_cliente" name="texto_grupo_cliente" class="form-control" placeholder="Ingrese Nombre" aria-describedby="buscar_grupo_cliente">
        <button type="button" class="btn btn-secondary"  id="buscar_grupo_cliente" onclick="buscarGrupoClientes();">Buscar</button>
      </div>
    </div>
  </div>
  <div class="row">
    <div id="mensaje_grupo_clientes" class="col-md-10 offset-md-1"></div>
  </div>
  <div class="row">
    <div id="contenido_grupo_clientes" class="col-md-10 offset-md-1"></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="js/funciones.js"></script>
<script type="text/javascript" src="js/clientes.js"></script>
<script type="text/javascript" src="js/grupo_clientes.js"></script>
<script>
$(document).ready(function() {
  init();
});
</script>
</body>
</html>