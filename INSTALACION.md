# 🚀 GUÍA RÁPIDA DE INSTALACIÓN

El proyecto **CreatorsWeb** está 100% listo. Sigue estos pasos para ejecutarlo:

## ⚡ Instalación en 3 Pasos

### 1. Abrir Terminal (CMD o PowerShell) y navegar al proyecto:
```bash
cd c:\Users\andre\OneDrive\Escritorio\prueba\ open\ code\creators_webs
```

### 2. Instalar dependencias:

**Opción A (Recomendado - Si tienes PHP en PATH):**
```bash
composer update
npm install
```

**Opción B (Si no está en PATH):**
```bash
C:\Users\andre\scoop\apps\php\current\php.exe C:\Users\andre\scoop\apps\composer\current\composer.phar update
npm install
```

### 3. Configurar base de datos:
```bash
# Crear archivo SQLite (se crea automáticamente, pero asegúrate)
echo. > database/database.sqlite

# Ejecutar migraciones (crear tablas)
php artisan migrate

# Generar clave de aplicación (si no está)
php artisan key:generate
```

## 🖥️ Ejecutar la Aplicación

Abre **DOS terminales** en el directorio del proyecto:

**Terminal 1 - Servidor Laravel:**
```bash
php artisan serve
```
Verás: `Server running on [http://127.0.0.1:8000]`

**Terminal 2 - Compilador de assets (Vue + Tailwind):**
```bash
npm run dev
```
Verás: `VITE v6.x.x ready in x ms`

## 🌐 Acceder a la Aplicación

Abre tu navegador y ve a:
```
http://localhost:8000
```

## 🧪 Crear Usuario de Prueba

Opción 1: Usar formulario de registro
- Click en "Get Started" o "Register"
- Llenar formulario

Opción 2: Crear con Tinker:
```bash
php artisan tinker

# En la consola de Tinker:
User::create([
  'name' => 'Juan Pérez', 
  'email' => 'juan@example.com', 
  'password' => bcrypt('password123'), 
  'is_creator' => true
])
exit
```

## 📋 Flujo de Uso

### Como Creador:
1. Registrarse
2. Iniciar sesión
3. Ir a "Mi Página de Creador"
4. Completar setup (slug, bio, avatar)
5. Agregar enlaces
6. Compartir `http://localhost:8000/@tu-slug`

### Como Seguidor:
1. Acceder a `/@creador-slug`
2. Ver perfil
3. Click "Apoyar al Creador"
4. Completar modal y enviar apoyo

## 🎯 Verificar que Todo Funciona

✅ **Frontend (Vue/Tailwind):**
- Home debe verse con gradiente y botones
- Registrar/Login debe funcionar
- Dashboard accesible tras login

✅ **Backend (Laravel):**
- Crear usuarios
- Crear perfiles de creador
- Guardar apoyos en BD

✅ **BD (SQLite):**
- `database/database.sqlite` debe existir
- Ejecutar: `php artisan tinker` debe funcionar
- Ver usuarios: `User::all()`

## 🛠️ Comandos Útiles

```bash
# Ver rutas
php artisan route:list

# Limpiar caché
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# Reset BD (¡CUIDADO! Borra datos)
php artisan migrate:fresh

# Ver logs
tail -f storage/logs/laravel.log

# Detener servidor
Ctrl+C
```

## ⚠️ Solucionar Problemas

**"composer command not found"**
```bash
# Usa la ruta completa
C:\Users\andre\scoop\apps\php\current\php.exe C:\Users\andre\scoop\apps\composer\current\composer.phar update
```

**"npm command not found"**
```bash
# Reinstalar Node.js o agregar a PATH
scoop install nodejs
```

**"SQLSTATE: Base de datos no existe"**
```bash
touch database/database.sqlite
php artisan migrate
```

**"Port 8000 already in use"**
```bash
php artisan serve --port=8001
```

**"Assets no se actualizan (npm run dev)"**
- Ctrl+Shift+Supr en navegador (limpiar caché)
- Asegúrate de que terminal 2 está corriendo
- Reinicia ambas terminales

## 📚 Estructura Rápida

```
creators_webs/
├── app/Models/ - Modelos de datos
├── app/Http/Controllers/ - Lógica
├── database/migrations/ - Esquema BD
├── resources/js/Pages/ - Componentes Vue
├── resources/js/Layouts/ - Templates
├── routes/web.php - Rutas
├── .env - Configuración
└── README.md - Documentación
```

## ✨ Características Principales

- 📄 Página pública con `/@{slug}`
- 🔗 Gestión de enlaces tipo Linktree
- 💰 Sistema de apoyos/donaciones
- 📱 Responsive mobile-first
- 🔐 Autenticación segura
- ⚡ Interfaz moderna con Vue 3

## 🚀 Siguiente Paso

Si todo funciona bien, ¡tu app está lista!

Para producción:
```bash
npm run build
php artisan config:cache
php artisan route:cache
```

---

**¿Preguntas? Revisa README.md para más detalles.** 💚
