# Documentación de Seeders - Aula Virtual Laravel

## 📋 Seeders Creados

Se han creado los siguientes seeders basados en los datos del archivo `aula_virtual.sql`:

### 1. **CursosSeeder**
- **Tabla:** `cursos`
- **Datos:** 10 cursos (1er Año A hasta 6to Año U)
- **Estado:** Todos activos (estado = 1)

### 2. **UsuariosSeeder**
- **Tabla:** `usuarios`
- **Datos:** 9 usuarios principales
  - 1 Administrador (Maxon)
  - 4 Profesores (Caridad, German, Marjorie, Jenny)
  - 4 Estudiantes (Deiner, Elio, José, Alejandro)
- **Password:** Todos con password "password" (hasheado)

### 3. **MateriasSeeder**
- **Tabla:** `materias`
- **Datos:** 9 materias
  - 5to Año U: Castellano, Informática, Prácticas de oficina, Mantenimiento, Programación
  - 6to Año U: Estructura de Datos, Sistemas Operativos, Proyecto, Programación II

### 4. **PeriodoClasesSeeder**
- **Tabla:** `periodo_clases`
- **Datos:** 2 períodos
  - 2024-2025
  - 2025-2026

### 5. **ProfGuiaSeeder**
- **Tabla:** `prof_guia`
- **Datos:** 4 profesores guías asignados a cursos

### 6. **EventosSeeder**
- **Tabla:** `eventos`
- **Datos:** 1 evento sobre la página web del colegio

### 7. **FechasSeeder**
- **Tabla:** `fechas`
- **Datos:** 2 fechas importantes
  - Consejo de Profesores
  - Corte de Notas (3er Lapso)

### 8. **NotasSeeder**
- **Tabla:** `notas`
- **Datos:** 15 registros de notas del estudiante Deiner (ID: 157)
- **Lapsos:** 1er, 2do y 3er Lapso
- **Materias:** Todas las materias de 5to Año U

### 9. **AsistenciaSeeder**
- **Tabla:** `asistencia`
- **Datos:** 8 registros de asistencia de ejemplo
- **Estudiantes:** Deiner, José, Elio, Alejandro
- **Materias:** Varias materias de 5to y 6to Año

## 🚀 Cómo Usar los Seeders

### Ejecutar Todos los Seeders
```bash
php artisan db:seed
```

### Ejecutar un Seeder Específico
```bash
php artisan db:seed --class=CursosSeeder
php artisan db:seed --class=UsuariosSeeder
php artisan db:seed --class=MateriasSeeder
# ... etc
```

### Refrescar Base de Datos y Ejecutar Seeders
```bash
php artisan migrate:fresh --seed
```

## 📊 Datos de Prueba Incluidos

### Usuarios de Prueba
- **Admin:** usuario: `Maxon`, password: `password` (ID: 1)
- **Profesor:** usuario: `German Vergara`, password: `password` (ID: 9)
- **Estudiante:** usuario: `Deiner Montes de Oca`, password: `password` (ID: 4)

### Cursos (IDs: 1-10)
- 1er Año A (ID: 1), 1er Año B (ID: 2)
- 2do Año A (ID: 3), 2do Año B (ID: 4)
- 3er Año A (ID: 5), 3er Año B (ID: 6)
- 4to Año A (ID: 7), 4to Año B (ID: 8)
- 5to Año U (ID: 9), 6to Año U (ID: 10)

### Materias por Curso (IDs: 1-9)
- **5to Año U (ID: 9):** Castellano (ID: 1), Informática (ID: 2), Prácticas de oficina (ID: 3), Mantenimiento (ID: 4), Programación (ID: 5)
- **6to Año U (ID: 10):** Estructura de Datos (ID: 6), Sistemas Operativos (ID: 7), Proyecto (ID: 8), Programación II (ID: 9)

## 🔧 Orden de Ejecución

Los seeders se ejecutan en el siguiente orden (importante para las relaciones):

1. **RolesSeeder** - Roles del sistema
2. **CursosSeeder** - Cursos/secciones
3. **UsuariosSeeder** - Usuarios (requiere roles y cursos)
4. **MateriasSeeder** - Materias (requiere usuarios/profesores y cursos)
5. **PeriodoClasesSeeder** - Períodos académicos
6. **ProfGuiaSeeder** - Profesores guías (requiere usuarios y cursos)
7. **EventosSeeder** - Eventos del colegio
8. **FechasSeeder** - Fechas importantes
9. **NotasSeeder** - Notas (requiere usuarios, materias, cursos y períodos)
10. **AsistenciaSeeder** - Asistencia (requiere usuarios, materias y cursos)
11. **PersonalizarSeeder** - Configuración del colegio

## ⚠️ Notas Importantes

- Todos los passwords están hasheados con `Hash::make('password')`
- Los IDs de usuarios, materias y cursos deben coincidir con los del archivo SQL original
- Las relaciones entre tablas están respetadas en el orden de ejecución
- Los datos incluyen tanto registros de ejemplo como datos reales del sistema original

## 🎯 Próximos Pasos

1. Ejecutar `php artisan migrate:fresh --seed` para poblar la base de datos
2. Verificar que todos los datos se insertaron correctamente
3. Probar el login con los usuarios de prueba
4. Verificar las relaciones entre las tablas
