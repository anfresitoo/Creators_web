# 🎬 Guion de Presentación para Video (eSponsor)

Este guion está diseñado para que grabes tu video de presentación de forma fluida, estructurada y profesional (a nivel de desarrollador Senior). Te ayudará a cubrir tanto la demostración del producto como la arquitectura técnica que desarrollamos.

---

## ⏱️ Estructura del Video (Aprox. 5 - 8 minutos)
1. **Introducción** (30s)
2. **Demostración Funcional (UX/UI)** (2 min)
3. **Explicación Técnica: Arquitectura y Base de Datos** (1.5 min)
4. **Explicación Técnica: Backend (Laravel)** (1.5 min)
5. **Explicación Técnica: Frontend (Vue + Inertia)** (1 min)
6. **Conclusión y Despedida** (30s)

---

## 📝 Guion Paso a Paso

### 1. Introducción
**[En pantalla: Tu rostro o la pantalla de inicio del proyecto `http://localhost:8000`]**
* **Tú:** "Hola, mi nombre es [Tu Nombre] y a continuación presento mi solución técnica para el desafío de eSponsor. El objetivo del proyecto fue desarrollar una plataforma tipo Patreon o Ko-fi donde los creadores de contenido puedan recibir apoyos simbólicos de sus seguidores. Para esto, utilicé el stack VILT: Vue 3, Inertia.js, Laravel y Tailwind CSS."

### 2. Demostración Funcional (El flujo del usuario)
**[En pantalla: Navegando por la plataforma. Haz los clics mientras hablas.]**
* **Tú:** "Primero, veamos el flujo del producto. Me registraré como un usuario nuevo para simular la experiencia completa de un creador."
  * *(Muestra el formulario de registro y crea una cuenta rápida)*
* **Tú:** "Una vez autenticado, la plataforma detecta que aún no tengo mi página configurada y me redirige al *Setup* inicial. Aquí configuro mi nombre público, mi identificador o *slug* para la URL, una biografía corta y una foto de perfil (avatar)."
  * *(Llena el formulario y envíalo)*
* **Tú:** "Al guardar, entramos al *Dashboard del Creador*. Este panel de control está diseñado de forma responsiva con Tailwind. A la izquierda tenemos la información general, y a la derecha un sistema de pestañas (Tabs) para manejar mi perfil, mis enlaces (tipo Linktree) y ver mis apoyos. Voy a agregar rápidamente un par de enlaces sociales."
  * *(Agrega un par de enlaces para mostrar la reactividad de Vue)*
* **Tú:** "Ahora, la parte más importante: la vista pública. Al hacer clic en 'Ver página pública', nos lleva a la ruta `/@{slug}`. Aquí es donde los seguidores entran. Si deciden apoyarme, hacen clic en el botón, el cual abre un Modal."
  * *(Abre el modal, llena un apoyo con un nombre, un mensaje y un monto, y envíalo)*
* **Tú:** "El formulario incluye validación. Al enviar el apoyo, el pago se simula, se registra en la base de datos, mostramos un mensaje de éxito (*Toast*) y la página se actualiza mostrando la nueva donación en el muro de apoyos recientes."

### 3. Arquitectura y Estructura de Datos
**[En pantalla: Muestra tu diagrama de la base de datos, el archivo `README.md` o el archivo de migración en el editor de código]**
* **Tú:** "A nivel técnico, estructuré la base de datos buscando normalización y escalabilidad. Tenemos 4 tablas principales:"
  1. "`users`: Maneja la autenticación."
  2. "`creators`: Tiene una relación `One-to-One` con los usuarios. Aquí se guarda el `slug`, que es único, el `display_name`, la `bio` y el `avatar_url`."
  3. "`creator_links`: Tiene una relación `One-to-Many` con `creators` para los enlaces del perfil."
  4. "`supports`: También `One-to-Many` con `creators`. Guarda el nombre del seguidor, un mensaje opcional y el monto."
* **Tú:** "Esta separación permite que a futuro el sistema de usuarios maneje múltiples roles (ej. un usuario normal, un creador o un administrador) sin ensuciar la tabla de autenticación."

### 4. Backend (Laravel)
**[En pantalla: Tu editor de código abierto en `routes/web.php` y `app/Http/Controllers/CreatorController.php`]**
* **Tú:** "En el backend utilicé Laravel aplicando el patrón MVC. Las rutas están organizadas y protegidas mediante *middleware* de autenticación donde es necesario. Para la lógica de negocio, centralicé las operaciones en controladores dedicados como `CreatorController`, `SupportController` y `CreatorLinkController`."
* **Tú:** "Un punto importante de buenas prácticas que implementé es la **validación estricta de datos** en cada petición usando los métodos de validación de Laravel, protegiendo así contra *Mass Assignment* a través del `$fillable` en los modelos. Por ejemplo, al actualizar el perfil, valido con expresiones regulares que el *slug* solo contenga caracteres válidos para URLs."

### 5. Frontend (Vue 3 + Inertia.js)
**[En pantalla: Tu editor de código abierto en `resources/js/Pages/Creator/PublicPage.vue` o `DashboardCreator.vue`]**
* **Tú:** "Por el lado del frontend, Inertia.js actúa como el puente perfecto entre Laravel y Vue, eliminando la necesidad de crear una API REST separada. Los componentes Vue utilizan el **Composition API (`script setup`)** moderno."
* **Tú:** "Para manejar la reactividad y la experiencia del usuario (UX), los formularios no usan un simple `fetch()`. Implementé el `router.put()` y `router.post()` de Inertia. Esto nos permite capturar los errores de validación (`422 Unprocessable Entity`) desde Laravel directamente en el objeto de errores reactivo de Vue, mostrando en tiempo real campos rojos si hay errores, y manejando estados como `isSubmitting` para evitar dobles envíos al hacer clic rápido en un botón."

### 6. Conclusión
**[En pantalla: La página principal del creador nuevamente o tu rostro]**
* **Tú:** "Además de todo esto, proveí una documentación completa en español dentro del archivo `README.md` que incluye requerimientos, pasos de instalación rápidos y cómo ejecutar comandos. Considero que esta estructura deja el proyecto listo para ser escalado fácilmente si se quisiera integrar una pasarela de pago real."
* **Tú:** "Eso es todo, el código está disponible en mi repositorio y espero que les agrade mi solución para el desafío. ¡Muchas gracias por su tiempo!"

---

## 💡 Consejos (Tips Senior)
- **Mantén la calma:** No te apresures. Si te equivocas, puedes hacer una pausa y cortar el video luego.
- **Preparación:** Ten levantado el servidor (`php artisan serve` y `npm run dev`), ten un usuario sin creador y un usuario con creador listos, o la base de datos limpia (`php artisan migrate:fresh`) para hacer el flujo desde cero.
- **Enfócate en los porqués:** Los evaluadores Senior valoran más **por qué** tomaste una decisión técnica que simplemente escuchar **qué** hace el código. Mencionar cosas como "prevenir dobles envíos", "evitar el Mass Assignment" y "Composition API" suma muchísimos puntos.
