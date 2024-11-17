# Documentación de la API
## Descripción
Esta API permite gestionar una colección de plantas. Se pueden listar, agregar, modificar y obtener detalles de plantas específicas mediante diferentes endpoints.
## Endpoints
### 1. Listar todas las plantas
URL: /api/plantas
Método: GET
Descripción: Devuelve una lista de todas las plantas en orden ascendente por defecto.

Parámetros opcionales:
- `order` (query string): Define el orden de la lista. Puede ser:
- `asc` (orden ascendente, predeterminado)
- `desc` (orden descendente)

Ejemplo de uso:
- Request:
```GET /api/plantas```

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
``GET /api/plantas?order=desc``

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
