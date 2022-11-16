# API-RESENIAS

CENTRO VETERINARIO PATITAS SERRANAS proporciona una API de estilo Rest para que nuestros clientes puedan dejar plasmada sus opiniones luego se ser atendidos por nuestros profesionales.
Mediante determinados metodos se podrà recuperar experiencias históricas y actuales de las consultas efectuadas en nuestro centro. Dentro del servicio se permite registrar una puntuaciòn cuya calificaciòn va de 1 a 5 que es de valiosa importancia para nosotros, clientes actuales y potenciales.

# IMPORTAR BASE DE DATOS
Importar desde PHPMyAdmin (u otra) base de datos/db_tp.sql

# RECURSO: "resenias", asignado al final de la URL:
http://localhost/TPApi-resenias/resenias


# API METODOS:
Metodo          URL	             
GET     	      /resenias	   
GET	       /resenias/:ID	
DELETE	  /resenias/:ID	
POST	    /resenias	
PUT	   /resenias/:ID	
Nota:El formato de transferencia que admite la API para enviar y recibir respuestas es JSON.

# API ENDPOINT: ACCIONES DISPONIBLES-METODOS

# METODO GET
(SIN PARAMETROS)
http://localhost/TPApi-resenias/resenias
Devuelve total de las reseñias efectuadas por nuestros clientes.
(CON PARAMETROS)
Agregue parámetros de consulta a las solicitudes GET:
:ID
Ejemplo:
http://localhost/TPApi-resenias/5
Devuelve la resenia cuyo ID es 5.

SORT && ORDER
sort: cualquier campo del recurso por el cual desee ordenar.
order: ascendente (asc o ASC) o descendente (desc o DESC).
Ejemplo:
http://localhost/TPApi-resenias/resenias?sort=consulta_id&order=asc
Devuelve todas resenias ordenadas por numero de consulta del cliente de manera ascendente.

FILTER-VALUE
filter: cualquier campo del recurso que desee buscar/filtrar.
value: parametro de busqueda.
Ejemplo:
http://localhost/TPApi-resenias/resenias?filter=mascota&value=nombre
Devuelve todas resenias de una mascota determinada.

PAGINACION
page: pagina requerida.
limite: cantidad de resultados por pagina.
Ejemplo:
http://localhost/TPApi-resenias/resenias?page=2&limit=3
Devuelve las tres resenias de la pagina dos.

# METODO DELETE
Agregue parámetro a la accion DELETE:
Ejemplo:
http://localhost/TPApi-resenias/1
Este mètodo permite eliminar del recurso una resenia determinada. Ejemplo elimina la resenia cuyo ID es 1.

# METODO POST
Ejemplo:
http://localhost/TPApi-resenias
Este mètodo permite dar de alta una resenia. 
En el cuerpo del Body debe completarse los datos siguientes:
{ "consulta_id": ,
   "comentario": "",
   "mascota": "",
   "puntuacion":""
}

# METODO PUT
Ejemplo:
Agregue parámetro a la accion PUT:
http://localhost/TPApi-resenias/2
Este mètodo permite editar los datos de una resenia determinada. 
Ejemplo edita la resenia cuyo ID es 1.
En el cuerpo del Body debe completarse los datos siguientes:
{ "id_resenia":"",
  "consulta_id": ,
  "comentario": "",
   "mascota": "",
   "puntuacion":""
}

# CODIGO RESPUESTA:
200 => "OK"
201 => "Created"
400 => "Bad request"
404 => "Not found"

````

