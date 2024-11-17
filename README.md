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
    "id": 1,
    "nombre": "Ficus",
    "precio": 500
  },
  {
    "id": 2,
    "nombre": "Cactus",
    "precio": 300
  }
]
```
- Request con parámetro: 
`GET` `/api/plantas?order=desc`

- Response: 
```json
[
  {
    "id": 2,
    "nombre": "Cactus",
    "precio": 300
  },
  {
    "id": 1,
    "nombre": "Ficus",
    "precio": 500
  }
]
```
### 2. Obtener detalles de una planta específica
- URL: `/api/plantas/id`
- Método: `GET`
- Descripción: devuelve los datos de una planta específica según su ID.

Ejemplo de uso:
- Request: `GET` `/api/plantas/1`
- Response:
```json
{
  "id": 1,
  "nombre": "Ficus",
  "precio": 500
}
```
- Error: si el ID no existe.  
  - Response: `'La planta con el id 1 no existe'`

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
  "precio": 400
}
```
- Response:
```json
{
  "id": 3,
  "nombre": "Aloe Vera",
  "precio": 400
}
```
- Error: si faltan datos obligatorios.
  - Response: `'Faltan completar datos obligatorios'`

### 4. Modificar una planta
- URL: `api/plantas/:id`
- Método: `PUT`
- Descripción: modifica los datos de una planta específica según su ID.

Ejemplo de uso: 
- Request: `PUT` `api/plantas/2`
- Body:
```json
{
  "nombre": "Cactus Actualizado",
  "precio": 350
}
```
- Response:
```json
{
  "id": 2,
  "nombre": "Cactus Actualizado",
  "precio": 350
}
```
- Error: Si el ID no existe.
  - Response: `'La planta con el id 2 no existe'`

## Aclaraciones
Todos los errores devuelven un código de estado HTTP apropiado y un mensaje descriptivo. 
- Errores de sintaxis devuelven un código 400
- Errores de recurso no existente devuelven un código 404
- Falta de autenticación devuelve un código 401 


