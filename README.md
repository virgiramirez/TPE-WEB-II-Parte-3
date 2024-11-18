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

Puede ser:
- `asc` (orden ascendente, predeterminado)
- `desc` (orden descendente)

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

## Aclaraciones
Todos los errores devuelven un código de estado HTTP apropiado y un mensaje descriptivo. 
- Errores de sintaxis devuelven un código 400
- Errores de recurso no existente devuelven un código 404
- Falta de autenticación devuelve un código 401 


