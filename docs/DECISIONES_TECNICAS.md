# Decisiones técnicas que no estaban especificadas en la Actividad 1

La Actividad 1 define entidades, atributos y relaciones, pero no especifica todos los detalles necesarios para una migración ejecutable. Por transparencia, estas son las decisiones añadidas:

1. **Longitudes `string`:** elegidas según el tipo de dato esperado (100, 150, 255, etc.).
2. **Monetarios:** `decimal(12,2)` para precios, total y subtotal.
3. **Nullables:** descripción, imagen, fecha de fin de suscripción y fecha de fin de conversación pueden quedar vacías.
4. **Email de usuario único:** se aplica `unique()` porque el acceso se realiza mediante correo electrónico y contraseña.
5. **Estados, roles, tipos y periodicidad:** se almacenan como `string` porque la Actividad 1 no define un catálogo cerrado de valores; no se inventaron ENUM.
6. **Timestamps:** no se añadieron `created_at` / `updated_at`; se conservaron únicamente las fechas que sí aparecen en el modelo original.
7. **Borrado referencial:** se diferenció entre configuraciones dependientes (`cascade`) y datos históricos (`restrict`).
8. **Planes y datos demo:** sus valores concretos son únicamente datos académicos de prueba, no parte del modelo aprobado.

Si el docente proporciona después longitudes, catálogos o reglas de eliminación específicas, deben prevalecer sobre estas decisiones.
