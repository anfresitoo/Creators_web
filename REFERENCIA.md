# ⚡ REFERENCIA RÁPIDA

## 🚀 INSTALAR EN 3 COMANDOS

```bash
cd c:\Users\andre\OneDrive\Escritorio\prueba\ open\ code\creators_webs
composer update && npm install && php artisan migrate
php artisan serve & npm run dev
```

Luego: `http://localhost:8000`

---

## 📂 CARPETAS IMPORTANTES

| Carpeta | Para qué | Editar? |
|---------|----------|---------|
| `app/Models/` | Lógica de datos | ✅ Sí |
| `app/Http/Controllers/` | Lógica de servidor | ✅ Sí |
| `resources/js/Pages/` | Páginas Vue | ✅ Sí |
| `resources/js/Layouts/` | Templates | ✅ Sí |
| `database/migrations/` | Estructura BD | ✅ Sí |
| `routes/` | URLs | ✅ Sí |
| `tailwind.config.js` | Estilos | ✅ Sí |
| `vendor/` | Libs PHP | ❌ No |
| `node_modules/` | Libs JS | ❌ No |

---

## 🔌 URLS PRINCIPALES

```
http://localhost:8000/               HOME
http://localhost:8000/register       REGISTRARSE
http://localhost:8000/login          INICIAR SESIÓN
http://localhost:8000/dashboard      DASHBOARD
http://localhost:8000/creator-dashboard    PANEL CREADOR
http://localhost:8000/@{slug}        PÁGINA PÚBLICA
http://localhost:8000/profile        EDITAR PERFIL
```

---

## 💻 COMANDOS PRINCIPALES

```bash
# INSTALAR
composer install      # Dependencias PHP
npm install          # Dependencias JS

# EJECUTAR
php artisan serve    # Backend (puerto 8000)
npm run dev         # Frontend (Vite)

# BD
php artisan migrate  # Crear tablas
php artisan tinker   # Consola interactiva

# CACHÉ
php artisan cache:clear

# BUILD
npm run build        # Para producción
```

---

## 📝 EDITAR CÓDIGO

### Crear Nueva Página Vue
```bash
# 1. Crear archivo
touch resources/js/Pages/MiPagina.vue

# 2. Crear route
# En routes/web.php:
Route::get('/mi-pagina', [MiController::class, 'mipagina']);

# 3. npm run dev recarga automáticamente
```

### Agregar Nueva Ruta
```php
// En routes/web.php:
Route::get('/nueva-url', [MiController::class, 'metodo'])->name('nombre');
```

### Cambiar Colores
```js
// En tailwind.config.js:
colors: {
  primary: '#3B82F6',
  secondary: '#10B981',
}
```

---

## 🐛 TROUBLESHOOTING

```bash
# Puerto en uso
php artisan serve --port=8001

# Assets no se actualizan
# Ctrl+Shift+Supr en navegador

# Base de datos vacía
php artisan migrate:fresh

# Limpiar caché
php artisan cache:clear && php artisan view:clear

# Ver BD en Tinker
php artisan tinker
> User::all()
> Creator::all()
> Support::all()
```

---

## 🔑 ARCHIVOS CLAVE

| Archivo | Qué hace |
|---------|----------|
| `.env` | Configuración (BD, puerto, etc) |
| `routes/web.php` | Define todas las URLs |
| `app/Models/Creator.php` | Lógica de creador |
| `resources/js/Pages/Creator/PublicPage.vue` | Página pública |
| `tailwind.config.js` | Colores y estilos |
| `package.json` | Dependencias JS |

---

## 📊 FLUJO TÍPICO

1. Usuario se registra → `User` creado en BD
2. Hace clic en "Mi Página" → se crea `Creator`
3. Agrega enlaces → se crean `CreatorLink`
4. Comparte `/@slug` → otros ven `PublicPage.vue`
5. Otros envían apoyo → se crea `Support`
6. Ver en dashboard → muestra todos los `Support`

---

## 🎨 PERSONALIZACIÓN

### Cambiar nombre de app
```bash
# .env
APP_NAME="Mi App Awesome"
```

### Cambiar puerto
```bash
php artisan serve --port=3000
```

### Cambiar color principal
```js
// tailwind.config.js
theme: {
  colors: {
    primary: '#FF0000'  // Cambiar a rojo
  }
}
```

### Cambiar moneda (CLP)
```bash
# Ya está en .env:
APP_CURRENCY=CLP
```

---

## 📱 RESPONSIVE

```html
<!-- Mobile: < 640px -->
<div class="block sm:hidden">Mobile</div>

<!-- Tablet: 640px - 1024px -->
<div class="hidden sm:block lg:hidden">Tablet</div>

<!-- Desktop: > 1024px -->
<div class="hidden lg:block">Desktop</div>
```

---

## ✨ TIPS

- `npm run dev` se queda corriendo y recarga cambios automáticamente
- `php artisan serve` también se queda corriendo
- Los cambios en `.env` requieren reiniciar el servidor
- Los cambios en modelos requieren nueva migración
- `php artisan tinker` es muy útil para probar código
- Las validaciones ocurren en cliente (Vue) y servidor (Laravel)

---

## 📚 MÁS AYUDA

- **Comenzar**: `DOCUMENTACION.md`
- **Instalar**: `INSTALACION.md`
- **Completo**: `README.md`
- **Checklist**: `VERIFICACION.md`
- **Dashboard**: `INICIO.txt`

---

**¡Eso es todo! Ahora a codear! 🚀**
