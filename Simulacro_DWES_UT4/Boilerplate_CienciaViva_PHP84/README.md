# CienciaViva — Simulacro práctico de UT4

## Qué es esta aplicación

CienciaViva es un pequeño portal de una feria científica. Cualquier persona puede consultar un programa de diez talleres y demostraciones. El navegador puede recordar dos preferencias: el área científica y la duración. Las cuentas de prueba tienen dos perfiles:

- attendee: consulta sus propias reservas en Mi agenda.
- coordinator: accede al panel con todas las reservas.

Los datos ya están preparados en arrays PHP. El simulacro no pide base de datos, altas de usuarios, nuevas reservas ni edición de registros. El proyecto es procedural: no hay clases, namespaces, framework ni patrón MVC que debas montar.

## Requisitos y arranque

Se necesita PHP 8.4 o superior y Composer. Desde esta carpeta ejecuta:

~~~bash
composer install
composer serve
~~~

Abre http://localhost:8000. El servidor publica únicamente la carpeta public/. Si Composer no está disponible, puede iniciarse el servidor integrado de PHP desde esta carpeta con:

~~~bash
php -S localhost:8000 -t public
~~~

El composer.json exige PHP ^8.4 y define el comando serve. No se instalan paquetes externos, por eso no se entrega un composer.lock.

## Cuentas de prueba

| Perfil | Correo | Contraseña |
|---|---|---|
| Participante | ana@cienciaviva.test | CuadernoAzul2026! |
| Participante | leo@cienciaviva.test | PipetaSolar2026! |
| Coordinación | clara@cienciaviva.test | MicroscopioNorte2026! |

Las contraseñas se comprueban contra hashes guardados en data/users.php.

## Cómo se organiza el proyecto

| Carpeta o archivo | Responsabilidad |
|---|---|
| composer.json | Requisito de PHP y comando para iniciar el servidor local. |
| config/app.php | Configuración común: zona horaria, cookie de sesión, timeout y opciones de preferencias. |
| app/bootstrap.php | Se carga al principio de cada página. Define APP_ROOT, carga configuración, configura e inicia la sesión, incluye funciones comunes y comprueba el timeout. |
| app/security.php | Funciones genéricas para escapar HTML, detectar HTTPS y redirigir. |
| app/view.php | Función render(), que carga la cabecera, una plantilla y el pie. |
| app/preferences.php | Funciones de cookies y filtrado del programa que completarás. |
| app/auth.php | Funciones de login, sesión y control de permisos. Las funciones de búsqueda y lectura de cuentas ya están listas; completarás las marcadas. |
| data/activities.php | Catálogo de talleres y demostraciones. Cada fila incluye id, título, área, formato, duración, sala y estado. |
| data/users.php | Cuentas de prueba: id, nombre, correo, hash de contraseña y rol. |
| data/bookings.php | Reservas de ejemplo: id, id de cuenta, participante, actividad, área, fecha y estado. |
| public/ | Páginas de entrada y controladores que reciben las peticiones. |
| views/layout/ | Cabecera y pie que se comparten en todas las páginas. |
| views/pages/ | Plantillas HTML del inicio, preferencias, programa, login y páginas privadas. |
| public/assets/styles.css | Estilos comunes ya preparados. |
| tools/generate_hash.php | Utilidad opcional para obtener un hash de contraseña desde la línea de comandos. |

## Recorrido de los datos

### Una petición para ver el programa

1. El navegador solicita /program.php.
2. public/program.php carga app/bootstrap.php.
3. El bootstrap inicia la sesión y carga las funciones comunes.
4. El controlador carga el array de data/activities.php.
5. currentProgramPreferences() lee las cookies cv_area y cv_duration_band.
6. filterActivities() recibe el catálogo y las preferencias; devuelve solo las actividades coincidentes.
7. render() pasa esos datos a views/pages/program.php.
8. La plantilla construye la tabla y e() escapa los valores dinámicos antes de mostrarlos.
9. header.php y footer.php rodean la plantilla con la estructura común.

### Guardar o restablecer preferencias

1. El formulario de preferencias envía un POST a /preferences.php.
2. El controlador llama a saveProgramPreferences() o resetProgramPreferences().
3. PHP añade las cabeceras Set-Cookie a la respuesta.
4. redirect() envía una redirección a /program.php y termina el procesamiento.
5. El navegador realiza una nueva petición e incluye las cookies nuevas o ya expiradas.
6. El catálogo vuelve a leerlas y aplica los filtros.

Las cookies son información controlada por el navegador; por eso hay que validar sus valores cada vez que se reciben.

### Iniciar sesión y solicitar una página privada

1. El formulario envía correo y contraseña por POST a /login.php.
2. El controlador busca la cuenta en data/users.php y verifica la contraseña con password_verify().
3. Si coincide, loginUser() regenera el identificador y conserva en la sesión del servidor solo id, nombre, rol y última actividad.
4. El navegador recibe la cookie identificadora de sesión y se redirige según el rol.
5. En una petición posterior el navegador envía ese identificador; PHP recupera la sesión guardada en el servidor.
6. public/agenda.php exige una sesión y prepara solo las reservas cuyo user_id coincide con la cuenta.
7. public/coordination.php exige el rol coordinator y prepara todas las reservas.
8. La vista genera la tabla. La autorización se hace en el controlador, no ocultando enlaces.

## Páginas disponibles

| URL | Acceso | Función |
|---|---|---|
| /index.php | Público | Presentación del portal. |
| /program.php | Público | Catálogo filtrado por preferencias. |
| /preferences.php | Público | Formulario para guardar o restablecer preferencias. |
| /login.php | Público | Formulario de acceso. |
| /agenda.php | attendee | Tabla con reservas de la cuenta actual. |
| /coordination.php | coordinator | Tabla con todas las reservas. |
| /logout.php | Sesión iniciada mediante POST | Cierra la sesión y vuelve al inicio. |

## Qué debes completar

Busca los comentarios TODO en app/preferences.php, app/auth.php, public/login.php y en las tablas de las vistas. El enunciado detalla cada comportamiento y la puntuación. Los controladores de preferencias, agenda y coordinación ya muestran el flujo de datos que debes completar.

No guardes contraseñas, hashes ni roles en cookies. Escapa los datos dinámicos con e(). No generes HTML antes de guardar cookies o redirigir. No se pide implementar CSRF ni añadir dependencias.
