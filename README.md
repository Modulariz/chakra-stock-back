FORMAT: 1A

# PHPStockREST

# Users [/users]
Representación del recurso de usuarios.

## Mostrar todos los usuarios. [GET /users]
Obtener una representación JSON de todos los usuarios en la base de datos.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "result": [
                    {
                        "user_id": "integer",
                        "email": "string",
                        "name": "string"
                    }
                ],
                "count": "integer"
            }

## Obtener usuario específico. [GET /users/id/{id}]
Obtener una representación JSON de un usuario por su ID.

+ Parameters
    + id (integer, required) - ID del usuario.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "user_id": "integer",
                "email": "string",
                "name": "string"
            }

## Crear un nuevo usuario. [POST /users]


+ Request (application/json)
    + Body

            {
                "name": "string",
                "password": "string",
                "email": "email"
            }

## Actualizar nombre de usuario. [PUT /users/updatename]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "name": "string"
            }

## Actualizar contraseña. [PUT /users/updatepassword]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "password": "string"
            }

## Eliminar usuario. [DELETE /users/{id}]


+ Parameters
    + id (integer, required) - ID del usuario.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

# Contactos [/contacts]
Representación del recurso de contactos.

## Obtener contactos. [GET /contacts/{search?,role?,order?,offset?}]
Filtrados por nombre, rol y offset.
Ordenados por nombre, rol, fecha de creación, fecha de actualización o deuda.
El límite está programado a 10.
Los roles son "c" para los clientes y "p" para los proveedores
Los parámetros pueden ser enviados por querystring o por json.

+ Parameters
    + search (string, optional) - Buscar por nombre de contacto.
        + Default: String vacío
    + role ('c'|'p', optional) - Filtrar por cliente o proveedor.
        + Default: c
    + order ('name'|'created_at'|'updated_at'|'money', optional) - Define la columna utilizada para ordenar los resultados.
        + Default: name
    + offset (integer, optional) - Cantidad de resultados a saltear, recomendable ir de 10 en 10, ya que el límite está definido en 10.
        + Default: 0

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "search": "Patricio",
                "role": "c",
                "order": "name",
                "offset": "0"
            }

+ Response 200 (application/json)
    + Body

            {
                "result": [
                    {
                        "contact_id": "integer",
                        "address": "string",
                        "name": "string",
                        "phone": "string",
                        "money": "float",
                        "created_at": "timestamp",
                        "updated_at": "timestamp",
                        "deleted_at": "null"
                    }
                ],
                "count": "integer"
            }

## Obtener contactos minificados. [GET /contacts/menu]
Retorna una lista de todos los contactos, sólamente con sus nombres e ID's.
Elegí el alias "value" para los ID's porque desde el frontend servía para usarlos en menús 'select'

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "result": [
                    {
                        "value": "integer",
                        "name": "string"
                    }
                ],
                "count": "integer"
            }

## Obtener contacto específico. [GET /contacts/id/{id}]
Obtener una representación JSON de un contacto por su ID.

+ Parameters
    + id (integer, required) - ID del contacto.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "contact_id": "integer",
                "address": "string",
                "name": "string",
                "phone": "string",
                "money": "float",
                "created_at": "timestamp",
                "updated_at": "timestamp",
                "deleted_at": "null"
            }

## Crear un nuevo contacto. [POST /contacts]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "name": "string",
                "phone": "string",
                "address": "string",
                "role": "'c'|'p'"
            }

## Actualizar contacto. [PUT /contacts]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "contact_id": "integer",
                "name": "string",
                "phone": "string",
                "address": "string",
                "role": "'c'|'p'"
            }

## Eliminar contacto. [DELETE /contacts]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "contact_id": "integer"
            }

# Gastos [/expenses]
Representación del recurso de gastos.

## Obtener gastos. [GET /expenses/{search?,category_id,order?,offset?}]
Filtrados por descripción, categoría y offset.
Ordenados por descripción, suma, fecha de creación o fecha de actualización.
El límite está programado a 10.
Los parámetros pueden ser enviados por querystring o por json.

+ Parameters
    + search (string, optional) - Buscar por descripción del gasto.
        + Default: String vacío
    + category_id (integer, required) - Filtrar por categoría.
    + order ('description'|'created_at'|'updated_at'|'sum', optional) - Define la columna utilizada para ordenar los resultados.
        + Default: name
    + offset (integer, optional) - Cantidad de resultados a saltear, recomendable ir de 10 en 10, ya que el límite está definido en 10.
        + Default: 0

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "search": "Patricio",
                "role": "c",
                "order": "name",
                "offset": "0"
            }

+ Response 200 (application/json)
    + Body

            {
                "result": [
                    {
                        "expense_id": "integer",
                        "category_id": "integer",
                        "description": "string",
                        "sum": "float",
                        "created_at": "timestamp",
                        "updated_at": "timestamp",
                        "deleted_at": "null"
                    }
                ],
                "count": "integer"
            }

## Obtener categorías. [GET /expenses/categories]
Retorna una lista de todas las categorías de los gastos.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "result": [
                    {
                        "category_id": "integer",
                        "name": "string"
                    }
                ],
                "count": "integer"
            }

## Crear una categoría. [POST /expenses/categories]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "name": "string"
            }

## Actualizar una categoría. [PUT /expenses/categories]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "name": "string",
                "category_id": "integer"
            }

## Eliminar una categoría. [DELETE /expenses/categories]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "category_id": "integer"
            }

## Postear un gasto. [POST /expenses]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "category_id": "integer",
                "name": "string",
                "description": "string",
                "sum": "float"
            }

## Actualizar un gasto. [PUT /expenses]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "category_id": "integer",
                "expense_id": "integer",
                "name": "string",
                "description": "string",
                "sum": "float"
            }

## Eliminar gasto. [DELETE /expenses]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "expense_id": "integer"
            }

# Pedidos [/orders]
Representación del recurso de pedidos.

## Obtener Pedidos. [GET /orders/{search?,type?,completed?,delivered?,order?,offset?}]
Filtrados por nombre de contacto, compleción, entregados, tipo (entrante o saliente) ('a' o 'b', respectivamente) y offset.
Ordenados por suma, fecha de creación o fecha de actualización.
El límite está programado a 10.
Los parámetros pueden ser enviados por querystring o por json.

+ Parameters
    + search (string, optional) - Buscar por descripción del gasto.
        + Default: String vacío
    + completed ('completed'|'not_completed'|'all', optional) - Filtrar por compleción.
        + Default: all
    + delivered ('delivered'|'not_delivered'|'all', optional) - Filtrar por entregados.
        + Default: all
    + order ('created_at'|'updated_at', optional) - Define la columna utilizada para ordenar los resultados. No está utilizado en el front
        + Default: created_at
    + offset (integer, optional) - Cantidad de resultados a saltear, recomendable ir de 10 en 10, ya que el límite está definido en 10.
        + Default: 0

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "search": "Patricio",
                "role": "c",
                "order": "name",
                "offset": "0"
            }

+ Response 200 (application/json)
    + Body

            {
                "result": [
                    {
                        "order_id": "integer",
                        "contact_id": "integer",
                        "completed": "boolean",
                        "delivered": "boolean",
                        "type": "'a'|'b'",
                        "paid": "float",
                        "sum": "float",
                        "products_count": "integer",
                        "created_at": "timestamp",
                        "updated_at": "timestamp",
                        "deleted_at": "null",
                        "contact": {
                            "name": "string",
                            "address": "string",
                            "phone": "string",
                            "contact_id": "integer"
                        }
                    }
                ],
                "count": "integer"
            }

## Obtener pedido específico. [GET /orders/id/{id}]
Obtener una representación JSON de un pedido por su ID.
"current_version" solo aparece si el producto en el pedido está desactualizado.

+ Parameters
    + id (integer, required) - ID del pedido.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "order_id": "integer",
                "contact_id": "integer",
                "completed": "boolean",
                "delivered": "boolean",
                "type": "'a'|'b'",
                "paid": "float",
                "sum": "float",
                "created_at": "timestamp",
                "updated_at": "timestamp",
                "deleted_at": "null",
                "contact": {
                    "name": "string",
                    "address": "string",
                    "phone": "string",
                    "contact_id": "integer"
                },
                "products": [
                    {
                        "ammount": "integer",
                        "delivered": "boolean",
                        "product_id": "integer",
                        "product_history_id": "integer",
                        "current_version": {
                            "product_id": "integer",
                            "product_history_id": "integer",
                            "name": "string",
                            "sell_price": "float",
                            "buy_price": "float"
                        },
                        "product_version": {
                            "product_id": "integer",
                            "product_history_id": "integer",
                            "name": "string",
                            "sell_price": "integer",
                            "buy_price": "integer"
                        }
                    }
                ],
                "transactions": [
                    {
                        "transaction_id": "integer",
                        "sum": "integer",
                        "created_at": "timestamp"
                    }
                ]
            }

## Obtener productos de un pedido específico. [GET /orders/id/products/{id}]
Obtener una representación JSON de los productos de un pedido por su ID.
"current_version" solo aparece si el producto en el pedido está desactualizado.

+ Parameters
    + id (integer, required) - ID del pedido.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            []

+ Response 200 (application/json)
    + Body

            {
                "result": [
                    {
                        "ammount": "integer",
                        "delivered": "boolean",
                        "product_id": "integer",
                        "product_history_id": "integer",
                        "current_version": {
                            "product_id": "integer",
                            "product_history_id": "integer",
                            "name": "string",
                            "sell_price": "float",
                            "buy_price": "float"
                        },
                        "product_version": {
                            "product_id": "integer",
                            "product_history_id": "integer",
                            "name": "string",
                            "sell_price": "integer",
                            "buy_price": "integer"
                        }
                    }
                ]
            }

## Eliminar un pedido. [DELETE /orders/orders]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "order_id": "integer"
            }

## Crear un pedido. [POST /orders]
La variable type define si el pedido es una compra (a), o una venta (b).

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "contact_id": "integer",
                "type": "'a'|'b'"
            }

## Actualizar un pedido. [PUT /orders]
La variable type define si el pedido es una compra (a), o una venta (b).

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "order_id": "integer",
                "contact_id": "integer",
                "type": "'a'|'b'"
            }

## Agregar un producto a un pedido. [POST /orders/products]
Los productos no pueden estar repetidos en un pedido, si se intenta agregar un producto ya existente, devuelve error de validación.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "order_id": "integer",
                "product_id": "integer",
                "ammount": "integer"
            }

## Modificar un producto de un pedido. [PUT /orders/products]
Los productos no pueden estar repetidos en un pedido, si se intenta cambiar a un producto ya existente, devuelve error de validación.

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "order_id": "integer",
                "product_id": "integer",
                "ammount": "integer",
                "delivered": "integer"
            }

## Remover un producto de un pedido. [DELETE /orders/products]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "order_id": "integer",
                "product_id": "integer"
            }

## Definir cantidad de entregados de un producto en un pedido. [POST /orders/products/delivered]


+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "order_id": "integer",
                "product_id": "integer",
                "ammount": "integer"
            }

## Definir cantidad de entregados de varios productos en un pedido al mismo tiempo. [POST /orders/products/delivered]
- falta poder validar el maximo de productos que podes entregar en base a la cantidad de stock, para no quedar en números negativos

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "order_id": "integer",
                "products": [
                    {
                        "product_id": "integer",
                        "ammount": "integer"
                    }
                ]
            }

## Agregar una transacción a un pedido. [POST /orders/transactions]
- debería pasar este endpoint al recurso "transacciones"

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "transaction_id": "integer",
                "sum": "float"
            }

## Modificar una transacción de un pedido. [PUT /orders/transactions]
- debería pasar este endpoint al recurso "transacciones"

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "transaction_id": "integer",
                "sum": "float"
            }

## Eliminar una transacción de un pedido. [DELETE /orders/transactions]
- debería pasar este endpoint al recurso "transacciones"

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "transaction_id": "integer"
            }

## Marcar pedido como completado. [POST /orders/completed]
Cambia el booleano "completed" de false a true

+ Request (application/json)
    + Headers

            Authorization: Bearer {token}
    + Body

            {
                "order_id": "integer"
            }