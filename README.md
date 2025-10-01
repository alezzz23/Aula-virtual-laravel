# Aula Virtual - Sistema de Gestión Educativa

Sistema completo de gestión educativa desarrollado en Laravel 12. Migrado desde PHP puro manteniendo todas las funcionalidades originales.

## 🌟 Características Principales

### Gestión de Usuarios
- Sistema multi-rol (Admin, Profesor, Estudiante, Coordinadores)
- Autenticación segura con Laravel
- Gestión completa de usuarios (CRUD)
- Permisos específicos por rol

### Gestión Académica
- Cursos y secciones
- Materias por curso
- Asignación de profesores
- Profesores guía por curso
- Períodos académicos

### Sistema de Asistencia
- Registro por materia y fecha
- Múltiples registros diarios
- Comentarios por asistencia
- Reportes por alumno
- Reportes por materia

### Sistema de Notas
- Gestión por lapsos (1er, 2do, 3er)
- 4 evaluaciones + adicionales
- Cálculo automático de promedios
- Boletas de notas
- Reportes de rendimiento

### Gestión de Contenidos
- Tareas con archivos adjuntos
- Clases y materiales
- Videos educativos
- Enlaces externos
- Guías de estudio
- Planes de clase

### Comunicación
- Eventos y publicaciones
- Comentarios por materia
- Calendario de fechas importantes

### Personalización
- Logo personalizado
- Color principal personalizable
- Nombre del colegio configurable

## 🔧 Requisitos

- PHP >= 8.2
- Composer
- MySQL >= 5.7 o MariaDB
- Extensiones PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML

## 📦 Instalación

### Método Automático (Recomendado)

```bash
cd /home/ale/Escritorio/Aula-Virtual-Laravel
./instalar.sh
php artisan serve
```

### Método Manual

1. **Crear base de datos**
```bash
mysql -u root -p -e "CREATE DATABASE aula_virtual CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

2. **Ejecutar migraciones**
```bash
php artisan migrate
```

3. **Ejecutar seeders**
```bash
php artisan db:seed
```

4. **Crear enlaces simbólicos**
```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

5. **Crear usuario administrador**
```bash
mysql -u root aula_virtual << EOF
INSERT INTO usuarios (usuario, namefull, cedula, password, correo, telefono, idRol, estado, created_at, updated_at) 
VALUES ('admin', 'Administrador del Sistema', '12345678', '\$2y\$10\$PwachjBZtGRuTzJR.b9RD.iYkt.MFlAaGaT37eGCXS8zcytUgXGYi', 'admin@aulavirtual.com', '0000000000', 1, 'Activo', NOW(), NOW());
EOF
```

6. **Iniciar servidor**
```bash
php artisan serve
```

## 🔐 Acceso al Sistema

- **URL:** http://localhost:8000
- **Usuario:** admin
- **Contraseña:** admin123

## 📁 Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/      # Controladores
│   └── Middleware/       # Middleware
└── Models/              # Modelos Eloquent

database/
├── migrations/          # Migraciones
└── seeders/            # Seeders

resources/
└── views/              # Vistas Blade
    ├── auth/          # Autenticación
    ├── layouts/       # Layouts
    └── dashboard/     # Dashboards

routes/
└── web.php            # Rutas

storage/
└── app/public/        # Archivos
    ├── eventos/
    ├── tareas/
    ├── clases/
    ├── videos/
    ├── guias/
    ├── planes/
    └── img/
```

## 🎨 Tecnologías Utilizadas

- **Backend:** Laravel 12
- **Frontend:** Bootstrap 5, Font Awesome 6
- **Base de Datos:** MySQL/MariaDB
- **JavaScript:** jQuery, DataTables, SweetAlert2

## 🚀 Uso del Sistema

### Como Administrador
1. Inicia sesión con las credenciales de admin
2. Configura el sistema en "Configuración"
3. Crea cursos en "Cursos"
4. Crea usuarios en "Usuarios"
5. Crea materias en "Materias"
6. Asigna profesores guía

### Como Profesor
1. Accede a tus materias
2. Registra asistencia
3. Registra notas
4. Sube tareas y materiales

### Como Estudiante
1. Ve tus materias
2. Descarga materiales
3. Consulta tus notas (si tienes permiso)
4. Ve tu asistencia

## 📚 Documentación Adicional

- **INICIO-RAPIDO.md** - Guía de inicio rápido
- **MIGRACION.md** - Detalles de la migración
- **RESUMEN-PROYECTO.md** - Resumen completo

## 🔧 Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Optimizar
php artisan config:cache
php artisan route:cache

# Ver rutas
php artisan route:list

# Respaldo BD
mysqldump -u root -p aula_virtual > backup.sql
```

## 🐛 Solución de Problemas

### Error de permisos
```bash
chmod -R 775 storage bootstrap/cache
```

### Enlace simbólico
```bash
rm public/storage
php artisan storage:link
```

### Base de datos
Verifica `.env`:
```env
DB_DATABASE=aula_virtual
DB_USERNAME=root
DB_PASSWORD=
```

## 📝 Licencia

Proyecto privado para uso educativo.

## 👥 Contribución

Sistema en producción. Contactar al administrador para cambios.

---

**Versión:** 1.0.0  
**Laravel:** 12.32.5  
**Fecha:** Octubre 2025
