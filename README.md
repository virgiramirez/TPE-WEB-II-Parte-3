# Documentación de la API
## Descripción
Esta API permite gestionar una colección de plantas. Se pueden listar, agregar, modificar y obtener detalles de plantas específicas mediante diferentes endpoints.
## Endpoints
### 1. Listar todas las plantas
- URL: `/api/plantas`
- Método: `GET`
- Descripción: Devuelve una lista de todas las plantas en orden ascendente por defecto.

Parámetros opcionales:
- `order` (query string): define el orden de la lista.
- `attribute` (query string): define el campo de la tabla.
- `value` (query string): define el valor a filtrar.

Puede ser:
- `asc` (orden ascendente, predeterminado)
- `desc` (orden descendente)
- `attribute`: nombre, precio, id_pedido, stock
- `value`: limon, 5000, 10, 2

Ejemplo de uso:
- Request:
`GET` `/api/plantas`

- Response:
```json
[
  {
    "id": 61,
    "nombre": "jj",
    "precio": 100,
    "id_pedido": 10,
    "stock": 2
  },
  {
    "id": 69,
    "nombre": "Cactus",
    "precio": 100,
    "id_pedido": 10,
    "stock": 2
  },
  {
    "id": 64,
    "nombre": "pino",
    "precio": 5000,
    "id_pedido": 10,
    "stock": 5
  },
  {
    "id": 62,
    "nombre": "Limon",
    "precio": 20000,
    "id_pedido": 11,
    "stock": 1
  },
  {  
    "id": 68,
    "nombre": "Pomelo",
    "precio": 45222,
    "id_pedido": 10,
    "stock": 2
  }
]
```
- Request con query string: 
`GET` `/api/plantas?order=desc`

- Response: 
```json
[
  {
    "id": 68,
    "nombre": "Pomelo",
    "precio": 45222,
    "id_pedido": 10,
    "stock": 2
  },
  {
    "id": 62,
    "nombre": "Limon",
    "precio": 20000,
    "id_pedido": 11,
    "stock": 1
  },
  {
    "id": 64,
    "nombre": "pino",
    "precio": 5000,
    "id_pedido": 10,
    "stock": 5
  },
  {
    "id": 61,
    "nombre": "jj",
    "precio": 100,
    "id_pedido": 10,
    "stock": 2
  },
  {
    "id": 69,
    "nombre": "Cactus",
    "precio": 100,
    "id_pedido": 10,
    "stock": 2
  }
]
```

- Request con query string: 
`GET` `/api/plantas?attribute=nombre&value=limon`

```json
[
   {
        "id_planta": 79,
        "nombre": "Limon 3",
        "precio": 2,
        "id_pedido": 11,
        "stock": 6,
        "imagen": ""
    },
    {
        "id_planta": 73,
        "nombre": "limon",
        "precio": 120,
        "id_pedido": 10,
        "stock": 8,
        "imagen": "-"
    },
    {
        "id_planta": 74,
        "nombre": "limon",
        "precio": 120,
        "id_pedido": 10,
        "stock": 8,
        "imagen": "-"
    },
    {
        "id_planta": 75,
        "nombre": "limon",
        "precio": 120,
        "id_pedido": 10,
        "stock": 8,
        "imagen": ""
    },
    {
        "id_planta": 62,
        "nombre": "Limon",
        "precio": 20000,
        "id_pedido": 11,
        "stock": 1,
        "imagen": "./uploads/images/planta_62.jpg"
    }
]
```
- Request con query string: 
`GET` `/api/plantas?attribute=nombre&value=limon&order=desc`
```json

[
    {
        "id_planta": 62,
        "nombre": "Limon",
        "precio": 20000,
        "id_pedido": 11,
        "stock": 1,
        "imagen": "./uploads/images/planta_62.jpg"
    },
    {
        "id_planta": 73,
        "nombre": "limon",
        "precio": 120,
        "id_pedido": 10,
        "stock": 8,
        "imagen": "-"
    },
    {
        "id_planta": 74,
        "nombre": "limon",
        "precio": 120,
        "id_pedido": 10,
        "stock": 8,
        "imagen": "-"
    },
    {
        "id_planta": 75,
        "nombre": "limon",
        "precio": 120,
        "id_pedido": 10,
        "stock": 8,
        "imagen": ""
    }
]
```
### 2. Obtener detalles de una planta específica
- URL: `/api/plantas/:id`
- Método: `GET`
- Descripción: devuelve los datos de una planta específica según su ID.

Ejemplo de uso:
- Request: `GET` `/api/plantas/62`
- Response:
```json
{
  "id": 62,
  "nombre": "Limon",
  "precio": 20000,
  "id_pedido": 11,
  "stock": 1
  }
```
- Error: si el ID no existe.  
  - Response: `'La planta con el id 62 no existe'`

### 3. Agregar una nueva Planta
- URL: `api/plantas`
- Método: `POST`
- Descripción: crea una nueva planta con los datos proporcionados.

Ejemplo de uso: 
- Request: `POST` `/api/plantas`
- Body:
```json
{
  "nombre": "Aloe Vera",
  "precio": 4000,
  "id_pedido": 10,
  "stock": 15
}
```
- Response:
```json
{
  "id": 70,
  "nombre": "Aloe Vera",
  "precio": 4000,
  "id_pedido": 10,
  "stock": 15
}
```
- Error: si faltan datos obligatorios.
  - Response: `'Faltan completar datos obligatorios'`

-Error: si el id_pedido no existe.
  - Response: `'El id_pedido no existe - No se puede asociar a ese pedido'`

### 4. Modificar una planta
- URL: `api/plantas/:id`
- Método: `PUT`
- Descripción: modifica los datos de una planta específica según su ID.

Ejemplo de uso: 
- Request: `PUT` `api/plantas/62`
- Body:
```json
{
  "nombre": "Amapola",
  "precio": 20000,
  "id_pedido": 11,
  "stock": 1
  }
```
- Response:
```json
{
  "id": 62,
  "nombre": "Amapola",
  "precio": 20000,
  "id_pedido": 11,
  "stock": 1
  }
```
- Error: Si el ID no existe.
  - Response: `'La planta con el id 2 no existe'`

 ## Autenticación y autorizacion
 Para poder agregar o actualizar una planta se debe generar el siguiente endpoints:
 - URL: `api/usuarios/token`
 - Método: GET
 - Descripcion: Obtiene un token para autorizar al administrador.

Ejemplo de uso:
  1. Seleccionar en la solapa Auth type: basic auth;
  2. Completar Username: webadmin y password: admin, copiar el token generado; 
  3. Luego cambiar la solapa Auth type a: Bearer Token y pegar el token obtenido;
  4. Realizar las acciones que se deseen (PUT o POST);   

## Aclaraciones
Todos los errores devuelven un código de estado HTTP apropiado y un mensaje descriptivo. 
- Errores de sintaxis devuelven un código 400
- Errores de recurso no existente devuelven un código 404
- Falta de autenticación devuelve un código 401 


