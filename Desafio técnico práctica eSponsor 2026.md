### **Desafío técnico práctica eSponsor**

Construir una mini plataforma tipo eSponsor / Ko-fi / Patreon donde un creador pueda crear su página pública y recibir “apoyos” simbólicos (sin pagos reales) Utilizando IA como herramienta de apoyo.

---

### **Objetivo**

Desarrollar una app full stack usando **Laravel \+ Vue 3 (Inertia JS) \+ Tailwind CSS** donde:

* Un usuario se registra / inicia sesión.  
* Configura su página de creador.  
* Comparte una URL pública donde otras personas pueden:  
  * Ver su perfil.  
  * Enviar un “apoyo” (nombre \+ mensaje \+ monto simulado).

---

### **Requerimientos funcionales mínimos**

**1\. Autenticación básica**

* Registro y login de usuario (email \+ password).  
* Cada usuario tiene 1 “página de creador”.  
* Se permiten usar starter kits y paquetes para autenticación (por ejemplo, Laravel Breeze o Jetstream).

**2\. Página de creador (dashboard)**

Desde un panel sencillo, el creador debe poder:

* Editar su perfil:  
  * Nombre público.  
  * Slug o username (para la URL).  
  * Bio corta.  
  * Imagen de avatar (URL basta).

* Gestionar una lista de links (tipo Linktree):  
  * Título del link.  
  * URL.

* Ver una lista de “apoyos” recibidos:  
  * Nombre del supporter.  
  * Mensaje.  
  * Monto simbólico.  
  * Fecha.

**3\. Página pública del creador**

Ruta algo como:  
 `/@{slug}`

Debe mostrar:

* Avatar, nombre y bio.  
* Lista de links.  
* Un botón **“Apoyar al creador”** que abra un modal (Vue) con un formulario:  
  * Nombre del supporter.  
  * Mensaje.  
  * Monto (número pequeño, ej: 1–100).

Al enviar, se guarda en la base de datos y se muestra un mensaje de éxito.

**4\. Pagos simulados**

No se requiere integración de pago real: solo se debe simular el “apoyo” guardando el registro en la base de datos.

---

### **Tecnologías**

* **Laravel y PHP** (Requerido).  
* **Vue 3 \+ Inertia JS** (Requerido).  
* **Tailwind CSS** (Requerido).

  ---

  ### **Entregables**

* Repo en Git (GitHub, GitLab o similar) con instrucciones claras en el README:  
  * Pasos de instalación.  
  * Configuración de `.env`.  
  * Comandos para correr migraciones y el servidor.

* Al finalizar, enviar:  
  * Enlace al repositorio.  
  * Enlace a una grabación en YouTube del flujo completo. No es necesario que el video contenga la grabación completa del desarrollo, pero sí que explique cada sección principal del código y muestre las funcionalidades del producto.

  ---

  ### **Consideraciones**

* Está permitido utilizar IA para el desarrollo (Cursor, Claude, ChatGPT, etc.).

* Las páginas implementadas deben ser completamente responsivas, utilizar correctamente los espacios y mantener un buen balance en la distribución de los elementos.

* Para evitar inconsistencias en la evaluación, **NO se revisará la solución si el enlace al video o al código no se encuentran presentes**.

* Junto con este documento se adjuntará un enlace de Calendly para agendar una reunión con el objetivo de responder cualquier duda con respecto al problema.

* Todo código desarrollado en la resolución de este problema será de propiedad del desarrollador y no de eSponsor.

  ---

  ### **Criterios principales de evaluación**

* Capacidad de adaptarse a un framework (Laravel \+ Inertia \+ Vue) usando herramientas de IA.

* Diseño de la estructura de datos.

* Buenas prácticas de código tanto en backend como en frontend (MVC, componentización, organización de archivos).

* Claridad para explicar el código y las decisiones en el video.


