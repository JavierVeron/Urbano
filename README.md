# Urbano Argentina

## Evaluación Técnica PHP

###### Instalación
1. Descargar de GIT el proyecto
2. Crear una BD MySQL **urbano**
3. En la consola de comando, ir al directorio del proyecto y ejecutar: **composer update**
4. Ejecutar: **php artisan migrate**
5. Ejecutar: **php artisan db:seed**
6. Ejecutar: **php artisan serve**

###### API (Clientes)
- URL: http://127.0.0.1:8000/api/clientes<br>
Método: GET<br>
Descripción: Obtiene todos los Clientes.<br><br>

- URL: http://127.0.0.1:8000/api/clientes/buscar/{value}<br>
Parámetros: value = [string]<br>
Método: GET<br>
Descripción: Busca a todos los Clientes por Nombre, Apellido o Email.<br><br>

- URL: http://127.0.0.1:8000/api/clientes/filtrar/{id}<br><br>
Parámetros: id = [integer]<br>
Método: GET<br>
Descripción: Filtra los Clientes por un ID de Grupo de Cliente.<br><br>

- URL: http://127.0.0.1:8000/api/cliente/{id}<br><br>
Parámetros: id = [integer]<br>
Método: GET<br>
Descripción: Busca un Cliente dado su número de ID.<br><br>

- URL: http://127.0.0.1:8000/api/cliente<br><br>
Parámetros: [json]<br>
Método: POST<br>
Descripción: Agrega un nuevo Cliente a la tabla 'clientes'.<br>
Ejemplo: {"nombre":"Javier", "apellido":"Verone", "email":"javier_v81@hotmail.com", "grupo_cliente_id":"3"}<br><br>

- URL: http://127.0.0.1:8000/api/cliente/{id}<br><br>
Parámetros: id = [integer] / [json]<br>
Método: PUT<br>
Descripción: Modifica un Cliente de la tabla 'clientes' dado su número de ID.<br>
Ejemplo: {"nombre":"Juan", "email":"juanperez@gmail.com", "grupo_cliente_id":"2"}<br><br>

- URL: http://127.0.0.1:8000/api/cliente/{id}<br>
Parámetros: id = [integer]<br>
Método: DELETE<br>
Descripción: Elimina un Cliente de la tabla 'clientes' dado su número de ID.<br><br>


###### API (Grupo de Clientes)
- URL: http://127.0.0.1:8000/api/grupoclientes<br>
Método: GET<br>
Descripción: Obtiene todos los Grupo de Clientes.<br><br>

- URL: http://127.0.0.1:8000/api/grupoclientes/buscar/{value}<br>
Parámetros: value = [string]<br>
Método: GET<br>
Descripción: Busca a todos los Grupo de Clientes por Nombre.<br><br>

- URL: http://127.0.0.1:8000/api/grupocliente/{id}<br><br>
Parámetros: id = [integer]<br>
Método: GET<br>
Descripción: Busca un Cliente dado su número de ID.<br><br>

- URL: http://127.0.0.1:8000/api/grupocliente<br><br>
Parámetros: [json]<br>
Método: POST<br>
Descripción: Agrega un nuevo contacto a la tabla 'grupo_clientes'.<br>
Ejemplo: {"nombre":"Javier"}<br><br>

- URL: http://127.0.0.1:8000/api/grupocliente/{id}<br><br>
Parámetros: id = [integer] / [json]<br>
Método: PUT<br>
Descripción: Modifica un Grupo de Cliente de la tabla 'grupo_clientes' dado su número de ID.<br>
Ejemplo: {"nombre":"Javier"}<br><br>

- URL: http://127.0.0.1:8000/api/grupocliente/{id}<br>
Parámetros: id = [integer]<br>
Método: DELETE<br>
Descripción: Elimina un Grupo de Cliente de la tabla 'grupo_clientes' dado su número de ID.<br><br>