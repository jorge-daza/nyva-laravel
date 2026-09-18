# Actividad 2 - Configuración Inicial e Implementación del Esquema de BD con Migraciones en Laravel

## 1. Análisis de la Actividad 1

NYVA es una plataforma web SaaS multiestablecimiento orientada inicialmente a restaurantes, hoteles y cocinas ocultas. La Actividad 1 define 11 entidades: Usuario, Establecimiento, Plan, Suscripción, Categoría, Producto, Horario, Pregunta frecuente, Pedido, Detalle del pedido y Conversación.

El diseño define relaciones 1:N entre las entidades principales y una relación N:M entre Pedido y Producto, resuelta por Detalle del pedido.

## 2. Convenciones de nombres aplicadas

La guía del docente exige:

- tablas en inglés, plural y `snake_case`;
- modelos en inglés, singular y `PascalCase`;
- PK estándar `id`;
- FK con el patrón `modelo_id`;
- migraciones nombradas como `create_[tabla]_table`.

Por esta razón se tradujeron los nombres técnicos sin alterar el significado del modelo.

## 3. Entidades y relaciones

| Modelo | Tabla | Relación principal |
|---|---|---|
| User | users | 1:N con establishments |
| Establishment | establishments | pertenece a User; tiene subscriptions, categories, schedules, FAQ, orders y conversations |
| Plan | plans | 1:N con subscriptions |
| Subscription | subscriptions | pertenece a Establishment y Plan |
| Category | categories | pertenece a Establishment; 1:N con products |
| Product | products | pertenece a Category; N:M con orders mediante order_items |
| Schedule | schedules | pertenece a Establishment |
| FrequentlyAskedQuestion | frequently_asked_questions | pertenece a Establishment |
| Order | orders | pertenece a Establishment; 1:N con order_items |
| OrderItem | order_items | pertenece a Order y Product |
| Conversation | conversations | pertenece a Establishment |

Relaciones FK:

```text
establishments.user_id -> users.id                     (N:1)
subscriptions.establishment_id -> establishments.id    (N:1)
subscriptions.plan_id -> plans.id                      (N:1)
categories.establishment_id -> establishments.id       (N:1)
products.category_id -> categories.id                  (N:1)
schedules.establishment_id -> establishments.id        (N:1)
frequently_asked_questions.establishment_id -> establishments.id (N:1)
orders.establishment_id -> establishments.id           (N:1)
order_items.order_id -> orders.id                      (N:1)
order_items.product_id -> products.id                  (N:1)
conversations.establishment_id -> establishments.id    (N:1)
```

## 4. Correspondencia modelo de datos -> Laravel

> Las longitudes, precisión decimal, nulabilidad y acciones referenciales no aparecen detalladas en la Actividad 1. Son decisiones técnicas justificadas para poder implementar el esquema sin cambiar las entidades ni sus atributos conceptuales.

| Tabla | Campo | Tipo Laravel | PK/FK | Nullable | Restricción / referencia |
|---|---|---|---|---|---|
| users | id | id() | PK | No | primaria |
| users | first_name | string(100) | - | No | - |
| users | last_name | string(100) | - | No | - |
| users | email | string | - | No | unique |
| users | password | string | - | No | - |
| users | role | string(50) | - | No | - |
| users | status | string(30) | - | No | - |
| users | registered_at | dateTime | - | No | - |
| establishments | id | id() | PK | No | primaria |
| establishments | user_id | foreignId | FK | No | users.id |
| establishments | name | string(150) | - | No | - |
| establishments | type | string(50) | - | No | - |
| establishments | description | text | - | Sí | propuesta técnica |
| establishments | address | string(255) | - | No | - |
| establishments | phone | string(30) | - | No | - |
| establishments | email | string | - | No | - |
| establishments | status | string(30) | - | No | - |
| establishments | registered_at | dateTime | - | No | - |
| plans | id | id() | PK | No | primaria |
| plans | name | string(100) | - | No | - |
| plans | description | text | - | Sí | propuesta técnica |
| plans | monthly_price | decimal(12,2) | - | No | monetario |
| plans | annual_price | decimal(12,2) | - | No | monetario |
| plans | status | string(30) | - | No | - |
| subscriptions | id | id() | PK | No | primaria |
| subscriptions | establishment_id | foreignId | FK | No | establishments.id |
| subscriptions | plan_id | foreignId | FK | No | plans.id |
| subscriptions | billing_period | string(20) | - | No | - |
| subscriptions | start_date | date | - | No | - |
| subscriptions | end_date | date | - | Sí | suscripción puede seguir vigente |
| subscriptions | status | string(30) | - | No | - |
| categories | id | id() | PK | No | primaria |
| categories | establishment_id | foreignId | FK | No | establishments.id |
| categories | name | string(100) | - | No | - |
| categories | description | text | - | Sí | propuesta técnica |
| categories | status | string(30) | - | No | - |
| products | id | id() | PK | No | primaria |
| products | category_id | foreignId | FK | No | categories.id |
| products | name | string(150) | - | No | - |
| products | description | text | - | Sí | propuesta técnica |
| products | price | decimal(12,2) | - | No | monetario |
| products | image | string | - | Sí | puede no existir |
| products | available | boolean | - | No | - |
| products | status | string(30) | - | No | - |
| schedules | id | id() | PK | No | primaria |
| schedules | establishment_id | foreignId | FK | No | establishments.id |
| schedules | day_of_week | string(20) | - | No | - |
| schedules | opens_at | time | - | No | - |
| schedules | closes_at | time | - | No | - |
| schedules | status | string(30) | - | No | - |
| frequently_asked_questions | id | id() | PK | No | primaria |
| frequently_asked_questions | establishment_id | foreignId | FK | No | establishments.id |
| frequently_asked_questions | question | text | - | No | - |
| frequently_asked_questions | answer | text | - | No | - |
| frequently_asked_questions | status | string(30) | - | No | - |
| orders | id | id() | PK | No | primaria |
| orders | establishment_id | foreignId | FK | No | establishments.id |
| orders | customer_name | string(150) | - | No | - |
| orders | customer_phone | string(30) | - | No | - |
| orders | delivery_address | string(255) | - | No | - |
| orders | total | decimal(12,2) | - | No | monetario |
| orders | status | string(30) | - | No | - |
| orders | ordered_at | dateTime | - | No | - |
| order_items | id | id() | PK | No | primaria |
| order_items | order_id | foreignId | FK | No | orders.id |
| order_items | product_id | foreignId | FK | No | products.id |
| order_items | quantity | unsignedInteger | - | No | cantidad positiva |
| order_items | unit_price | decimal(12,2) | - | No | histórico del precio |
| order_items | subtotal | decimal(12,2) | - | No | total de línea |
| conversations | id | id() | PK | No | primaria |
| conversations | establishment_id | foreignId | FK | No | establishments.id |
| conversations | customer_identifier | string(255) | - | No | - |
| conversations | started_at | dateTime | - | No | - |
| conversations | ended_at | dateTime | - | Sí | conversación activa |
| conversations | status | string(30) | - | No | - |

## 5. Inconsistencias / ajustes respecto a la Actividad 1

### 5.1 PK y FK

La Actividad 1 usa nombres como `id_usuario`, `id_producto` e `id_establecimiento`. La guía del docente exige `id` para PK y `user_id`, `product_id`, `establishment_id`, etc. para FK. Se aplicó la guía, que tiene prioridad.

### 5.2 Detalle del pedido

Aunque resuelve una relación N:M, no se implementó como una pivot mínima `order_product`, porque la Actividad 1 le asigna una PK y atributos propios (`cantidad`, `precio_unitario`, `subtotal`). Se modeló como `OrderItem` / `order_items`.

### 5.3 Cliente

La Actividad 1 menciona el rol Cliente, pero no define una entidad Cliente ni una FK de usuario en pedidos o conversaciones. No se inventó una tabla `clients`; se conservan los atributos del documento (`customer_name`, `customer_phone`, `customer_identifier`).

### 5.4 Timestamps

No se agregaron `created_at` ni `updated_at` porque no están definidos en la Actividad 1. Los modelos usan `public $timestamps = false;`.

## 6. Orden de migraciones

1. users
2. plans
3. establishments
4. subscriptions
5. categories
6. products
7. schedules
8. frequently_asked_questions
9. orders
10. order_items
11. conversations

Este orden respeta las dependencias de FK. `order_items` se crea después de `orders` y `products`.

## 7. Comandos Artisan equivalentes

Si se construyera desde cero con Artisan:

```bash
php artisan make:model Plan -m
php artisan make:model Establishment -mf
php artisan make:model Subscription -m
php artisan make:model Category -mf
php artisan make:model Product -mf
php artisan make:model Schedule -mf
php artisan make:model FrequentlyAskedQuestion -mf
php artisan make:model Order -mf
php artisan make:model OrderItem -m
php artisan make:model Conversation -mf

php artisan make:seeder PlanSeeder
php artisan make:seeder DevelopmentUserSeeder
php artisan make:seeder DemoDataSeeder
```

`User` y `UserFactory` normalmente vienen con el esqueleto de Laravel y aquí fueron adaptados al modelo NYVA.

## 8. Migraciones

El código completo se encuentra en `database/migrations/`. Todas las migraciones implementan `up()` y `down()`.

### Política de eliminación

- `restrictOnDelete`: User -> Establishment, Establishment -> Subscription, Plan -> Subscription, Establishment -> Order, Product -> OrderItem, Establishment -> Conversation. Se conserva información histórica o se evita borrar accidentalmente datos de negocio.
- `cascadeOnDelete`: Establishment -> Category, Category -> Product, Establishment -> Schedule, Establishment -> FAQ y Order -> OrderItem. Son dependencias configuracionales o detalles que no tienen sentido de forma independiente.
- Se usa `cascadeOnUpdate()` en FK para mantener integridad en el caso excepcional de que una PK cambie.

No se aplicó cascade indiscriminadamente.

## 9. Modelos Eloquent

Están en `app/Models/`. Se configuraron `$fillable`, casts y relaciones `belongsTo`, `hasMany` y `belongsToMany` según la Actividad 1.

## 10. Factories

Se generaron factories para entidades útiles en datos de demostración:

- User
- Establishment
- Category
- Product
- Schedule
- FrequentlyAskedQuestion
- Order
- Conversation

No se creó Factory para `Plan` porque se trata como dato maestro. `Subscription` y `OrderItem` se crean de manera controlada en el seeder para respetar dependencias y coherencia.

## 11. Seeders

- `PlanSeeder`: carga planes académicos de demostración.
- `DevelopmentUserSeeder`: crea dos usuarios de desarrollo, diferenciando administrador de plataforma y administrador de establecimiento.
- `DemoDataSeeder`: genera un establecimiento, suscripción, categorías, productos, horarios, FAQ, conversaciones, pedido y detalles.

Los nombres y precios de los planes son datos de demostración porque la Actividad 1 no define valores concretos.

## 12. DatabaseSeeder

Ejecuta los seeders en este orden:

```text
PlanSeeder
DevelopmentUserSeeder
DemoDataSeeder
```

## 13. Configuración `.env`

Plantilla principal:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nyva
DB_USERNAME=root
DB_PASSWORD=
```

También se fuerza `SESSION_DRIVER=file`, `CACHE_STORE=file` y `QUEUE_CONNECTION=sync` para que la Actividad 2 no necesite tablas de infraestructura (`sessions`, `cache`, `jobs`) que no existen en la Actividad 1.

## 14. Verificación

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan config:clear
php artisan migrate:fresh --seed
php artisan migrate:status
```

Si `migrate:fresh --seed` finaliza sin errores, el esquema se reconstruye completamente desde cero.

## 15. Estructura para GitHub

Versionar:

- código fuente;
- migraciones;
- modelos;
- factories;
- seeders;
- `.env.example`;
- `composer.json` y `composer.lock`;
- documentación.

No versionar:

- `.env`;
- `vendor/`;
- secretos;
- contraseñas reales.

## 16. Checklist final

- [x] Laravel 13.x declarado en Composer.
- [x] PHP 8.3+ declarado.
- [x] MySQL configurado en `.env.example`.
- [x] 11 entidades de la Actividad 1 implementadas.
- [x] PK estándar `id`.
- [x] FK `modelo_id`.
- [x] Tablas en inglés, plural y snake_case.
- [x] Modelos en inglés, singular y PascalCase.
- [x] PK/FK compatibles (`id()` + `foreignId()`).
- [x] Orden correcto de migraciones.
- [x] `constrained()` en todas las relaciones.
- [x] `cascade` solo donde existe una justificación.
- [x] `restrict` para datos históricos / críticos.
- [x] `nullable` solo donde se justificó como propuesta técnica.
- [x] `unique()` aplicado al email de autenticación de User.
- [x] Campos monetarios con decimal(12,2).
- [x] Modelos Eloquent con `$fillable`.
- [x] Relaciones Eloquent configuradas.
- [x] Factories coherentes.
- [x] Seeders diferenciados por tipo.
- [x] `DatabaseSeeder` ordenado.
- [x] `.env` excluido de Git.
- [x] `.env.example` incluido.
- [x] Sin tablas de infraestructura innecesarias para la actividad.

## 17. Guion breve para sustentación

> En la Actividad 1 definimos el modelo relacional de NYVA con once entidades. Para la Actividad 2 lo trasladamos a Laravel respetando primero la guía de nomenclatura del profesor: tablas en inglés, plural y snake_case; modelos en singular y PascalCase; PK `id` y FK con el patrón `modelo_id`.
>
> Las relaciones se implementaron con `foreignId` y `constrained`. Analizamos cada eliminación en lugar de usar cascade en todas partes. Por ejemplo, al eliminar un pedido sí se eliminan sus detalles porque no tienen sentido sin el pedido, mientras que un producto utilizado en un detalle no puede borrarse automáticamente porque se perdería información histórica.
>
> La relación muchos a muchos entre pedidos y productos se resolvió con `order_items`. Como el detalle tiene su propia PK, cantidad, precio unitario y subtotal, se modeló como una entidad asociativa y no como una pivot mínima.
>
> También creamos modelos Eloquent, factories y seeders. Los planes se cargan como datos maestros de demostración y los demás registros se generan de forma coherente. Finalmente, el proyecto queda preparado para reconstruir la base con `php artisan migrate:fresh --seed`.
