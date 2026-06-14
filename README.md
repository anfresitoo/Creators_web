# CreatorsWeb

Plataforma web donde los creadores de contenido pueden crear su página personalizada para recibir **apoyos simbólicos** de sus seguidores. Los pagos se registran en la base de datos sin realizar transacciones reales.

## 🚀 Características

- **Registro e inicio de sesión** de usuarios con autenticación segura.
- **Página de creador personalizada** con URL pública (ej: `/@tu-nombre`).
- **Perfil de creador** con avatar, biografía y slug personalizable.
- **Gestor de enlaces** estilo Linktree para organizar tus redes y contenido.
- **Recepción de apoyos** simbólicos con nombre, mensaje opcional y monto (CLP 1-100).
- **Dashboard del creador** con estadísticas de apoyos recibidos y monto total recaudado.
- **Edición de perfil de usuario** (nombre y email).

## 🛠️ Stack Tecnológico

| Tecnología | Versión | Uso |
|---|---|---|
| **PHP** | ^8.3 | Lenguaje backend |
| **Laravel** | ^13 | Framework backend |
| **Vue.js** | ^3.4 | Framework frontend |
| **Inertia.js** | ^2.0 | Puente Laravel-Vue (SPA sin API) |
| **Tailwind CSS** | ^3.4 | Framework de estilos |
| **SQLite** | - | Base de datos (por defecto) |
| **Vite** | ^5.0 | Bundler de assets |
| **Ziggy** | ^2.0 | Rutas de Laravel en JavaScript |

## 📋 Requisitos Previos

- **PHP** >= 8.3 (Probado en 8.5.7) con extensiones: `pdo_sqlite`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`
- **Composer** >= 2.x (Probado en v2.10.1)
- **Node.js** >= 22.x (Probado en v22.15.1)
- **npm** >= 10.x (Probado en v10.9.2)

## ⚙️ Instalación

### 1. Clonar el repositorio

```bash
git clone <url-del-repositorio>
cd creators_webs
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar el entorno

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Crear la base de datos

El proyecto usa SQLite por defecto. Si no existe el archivo de base de datos, créalo:

```bash
# Windows (PowerShell)
New-Item -Path database/database.sqlite -ItemType File -Force

# Linux/macOS
touch database/database.sqlite
```

### 5. Ejecutar migraciones

```bash
php artisan migrate
```

### 6. Instalar dependencias de Node.js

```bash
npm install
```

### 7. Compilar assets (desarrollo)

```bash
npm run dev
```

### Instalación rápida (alternativa)

También puedes usar el script de Composer que ejecuta todos los pasos:

```bash
composer setup
```

## 🖥️ Uso

### Modo desarrollo

Abre **dos terminales** y ejecuta en cada una:

**Terminal 1 — Servidor PHP:**
```bash
php artisan serve
```

**Terminal 2 — Vite (assets en vivo):**
```bash
npm run dev
```

La aplicación estará disponible en: [http://localhost:8000](http://localhost:8000)

### Modo desarrollo (alternativa con concurrently)

Si tienes `concurrently` instalado, puedes usar:

```bash
composer dev
```

Esto inicia el servidor PHP, la cola de trabajos, los logs y Vite simultáneamente.

## 📁 Estructura del Proyecto

```
creators_webs/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                    # Controladores de autenticación
│   │   │   │   ├── AuthenticatedSessionController.php  # Login/Logout
│   │   │   │   └── RegisteredUserController.php        # Registro
│   │   │   ├── CreatorController.php    # CRUD perfil de creador
│   │   │   ├── CreatorLinkController.php # CRUD enlaces del creador
│   │   │   ├── ProfileController.php    # Edición perfil de usuario
│   │   │   └── SupportController.php    # Gestión de apoyos
│   │   └── Middleware/
│   │       └── HandleInertiaRequests.php # Middleware Inertia (props compartidos)
│   └── Models/
│       ├── User.php                     # Modelo de usuario
│       ├── Creator.php                  # Modelo de creador
│       ├── CreatorLink.php              # Modelo de enlace
│       └── Support.php                  # Modelo de apoyo
├── database/
│   └── migrations/                      # Migraciones de la base de datos
├── resources/
│   ├── css/
│   │   └── app.css                      # Estilos (Tailwind)
│   ├── js/
│   │   ├── app.js                       # Punto de entrada Vue + Inertia
│   │   ├── Layouts/
│   │   │   ├── AuthenticatedLayout.vue  # Layout para usuarios autenticados
│   │   │   ├── GuestLayout.vue          # Layout para visitantes
│   │   │   └── PublicLayout.vue         # Layout para páginas públicas de creador
│   │   └── Pages/
│   │       ├── Auth/
│   │       │   ├── Login.vue            # Página de inicio de sesión
│   │       │   └── Register.vue         # Página de registro
│   │       ├── Creator/
│   │       │   ├── DashboardCreator.vue # Dashboard del creador
│   │       │   ├── PublicPage.vue       # Página pública del creador
│   │       │   └── SetupCreator.vue     # Configuración inicial del creador
│   │       ├── Profile/
│   │       │   └── Edit.vue             # Edición de perfil de usuario
│   │       ├── Dashboard.vue            # Dashboard principal
│   │       └── Welcome.vue              # Página de bienvenida
│   └── views/
│       └── app.blade.php                # Template Blade raíz (Inertia)
├── routes/
│   ├── web.php                          # Rutas web principales
│   └── auth.php                         # Rutas de autenticación
└── ...
```

## 🗄️ Modelo de Datos

```
┌─────────────┐       ┌─────────────┐       ┌──────────────────┐
│   users      │       │  creators    │       │  creator_links   │
├─────────────┤       ├─────────────┤       ├──────────────────┤
│ id           │──┐    │ id           │──┐    │ id               │
│ name         │  └───▶│ user_id (FK) │  └───▶│ creator_id (FK)  │
│ email        │       │ slug (unique)│       │ title            │
│ is_creator   │       │ bio          │       │ url              │
│ password     │       │ avatar_url   │       │ position         │
│ timestamps   │       │ timestamps   │       │ timestamps       │
└─────────────┘       └──────┬───────┘       └──────────────────┘
                              │
                              │        ┌─────────────┐
                              └───────▶│  supports    │
                                       ├─────────────┤
                                       │ id           │
                                       │ creator_id   │
                                       │ supporter_name│
                                       │ message (null)│
                                       │ amount       │
                                       │ timestamps   │
                                       └─────────────┘
```

## 🔗 Rutas Principales

| Método | Ruta | Descripción | Auth |
|--------|------|-------------|------|
| GET | `/` | Página de bienvenida | No |
| GET | `/@{slug}` | Página pública del creador | No |
| POST | `/api/supports` | Enviar un apoyo | No |
| GET | `/dashboard` | Dashboard principal | Sí |
| GET | `/creator-dashboard` | Dashboard del creador | Sí |
| PUT | `/creator/update` | Actualizar perfil de creador | Sí |
| GET | `/api/creator-links` | Listar enlaces del creador | Sí |
| POST | `/api/creator-links` | Crear enlace | Sí |
| PUT | `/api/creator-links/{id}` | Actualizar enlace | Sí |
| DELETE | `/api/creator-links/{id}` | Eliminar enlace | Sí |
| GET | `/profile` | Editar perfil de usuario | Sí |
| PUT | `/profile` | Actualizar perfil de usuario | Sí |
| GET | `/register` | Registro | No (guests) |
| POST | `/register` | Procesar registro | No (guests) |
| GET | `/login` | Inicio de sesión | No (guests) |
| POST | `/login` | Procesar login | No (guests) |
| POST | `/logout` | Cerrar sesión | Sí |

## 🧪 Tests

```bash
php artisan test
```

## 📦 Compilar para Producción

```bash
npm run build
```

## 📝 Notas Importantes

- Los **pagos son simbólicos**: se registran en la base de datos pero no se realizan transacciones reales.
- La base de datos por defecto es **SQLite**, ideal para desarrollo. Para producción se recomienda MySQL o PostgreSQL.
- Los **avatares** se cargan por URL externa. No hay subida de archivos local.
- El monto de apoyo está limitado entre **CLP 1 y CLP 100**.

## 📄 Licencia

Este proyecto es de uso educativo y demostrativo.
