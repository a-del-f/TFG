# Notifier

Notifier es una aplicación para la gestión de incidencias centrada en centros educativos, diseñada para facilitar la comunicación y resolución de problemas. La aplicación soporta tres roles principales:

1. **Admin**: Administrador con acceso completo para gestionar usuarios y configuraciones.
2. **Técnico**: Personal técnico encargado de resolver las incidencias reportadas.
3. **Usuario**: Usuarios regulares que pueden reportar incidencias y hacer seguimiento de las mismas.

## Requisitos Previos

Antes de iniciar la aplicación por primera vez, asegúrate de tener los siguientes requisitos previos instalados en tu sistema:

- [PHP](https://www.php.net/) >= 8.2.4
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/en)

## Instalación

Sigue estos pasos para configurar e iniciar la aplicación:

1. **Clona el Repositorio**

    ```bash
    git clone https://github.com/tu_usuario/notifier.git
    cd notifier
    ```

2. **Configura el Archivo `.env`**

   Copia el archivo de ejemplo `.envexample` a `.env` y configura los valores necesarios, prestando especial atención a los puertos usados.

    ```bash
    cp .envexample .env
    ```

   Edita el archivo `.env` y ajusta las configuraciones según tu entorno, especialmente las variables de conexión a la base de datos.

3. **Instala las Dependencias de PHP**

   Asegúrate de tener Composer instalado y ejecuta el siguiente comando para instalar las dependencias de PHP:

    ```bash
    composer install
    ```

4. **Instala las Dependencias de Node.js**

   Asegúrate de tener Node.js instalado como mínimo version 20 y en npm como mínimo la version 10.8.0



5. **Ejecuta las Migraciones de Base de Datos**

   Ejecuta las migraciones para crear las tablas necesarias en la base de datos:

    ```bash
    php artisan migrate
    ```

6. **Ejecuta los Seeders de la Base de Datos**

   Llena la base de datos con datos de ejemplo utilizando los seeders:

    ```bash
    php artisan db:seed
    ```

7. **Compila los Recursos Estáticos**

   Para compilar y optimizar los recursos estáticos de la aplicación:

    ```bash
    npm run dev
    ```

8. **Inicia el Servidor de Desarrollo**

   Inicia el servidor de desarrollo de Laravel:

    ```bash
    php artisan serve
    ```

9. **Accede a la Aplicación**

   Haz clic en el enlace generado en la consola, típicamente `http://127.0.0.1:8000`, para abrir la aplicación web en tu navegador.

## Comandos Útiles

- **Limpiar Caché**

  Para limpiar la caché de la aplicación:

    ```bash
    php artisan cache:clear
    php artisan config:clear
    php artisan route:clear
    php artisan view:clear
    ```

## Roles y Permisos

La aplicación soporta los siguientes roles con sus respectivos permisos:

1. **Admin**:
    - Gestionar usuarios.
    - Configurar la aplicación.
    - Ver y gestionar todas las incidencias.

2. **Técnico**:
    - Ver y gestionar incidencias asignadas.
    - Actualizar el estado de las incidencias.

3. **Usuario**:
    - Reportar nuevas incidencias.
    - Ver el estado de sus propias incidencias.



## Licencia

Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo [LICENSE](LICENSE) para más información.

---

¡Gracias por usar Notifier! Para cualquier pregunta o sugerencia, no dudes en contactar al equipo de desarrollo.
