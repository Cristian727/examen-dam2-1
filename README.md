### Sprint 1: Preparación


1º Compruebo que puedo hacer un commit correctamente a mi Repositorio

![alt text](PruebaCommit.png)

2º Comprobamos que tengo mi cuenta de Docker iniciada

![alt text](ImagenCuentaDocker.png)

### Sprint 2: Preparación


1. **Verificación del estado de los contenedores Docker**:
   - Comprobé que no había contenedores en ejecución con el comando:
     ```bash
     docker ps
     ```
   - El resultado fue:
     ```bash
     CONTAINER ID   IMAGE     COMMAND   CREATED   STATUS    PORTS     NAMES
     ```

2. **Creación del servidor Apache con Docker**:
   - Creé una carpeta llamada `apache` y dentro de ella, los archivos `Dockerfile` e `index.html`.
   - El contenido del `Dockerfile` es el siguiente:
     ```dockerfile
     FROM httpd:2.4
     COPY index.html /usr/local/apache2/htdocs/
     ```
   - El archivo `index.html` contiene una simple página HTML con el mensaje "Hola Mundo".
   - Construí la imagen Docker con:
     ```bash
     docker build -t apache-server .
     ```
   - Ejecué el contenedor en segundo plano con:
     ```bash
     docker run -d -p 8080:80 apache-server
     ```
   - Verifiqué que el contenedor estaba en ejecución con:
     ```bash
     docker ps
     ```
   - El contenedor estaba en ejecución y el servidor Apache estaba sirviendo la página en `http://localhost:8080`.

## Sprint 3: Apache + PHP

### Objetivo del Sprint 3

En este sprint, hemos configurado un servidor web Apache que ejecuta PHP. El servidor muestra una página que incluye un mensaje de "Hola Mundo", la fecha y hora actual, la versión de PHP y Apache, la IP del servidor y la IP del cliente.

### Pasos realizados

1. **Copiar la carpeta `apache` y renombrarla a `apache-php`**:
   - Copié la carpeta `apache` del Sprint 2 a `apache-php` para seguir trabajando en ella.
   - Usé el siguiente comando para copiar la carpeta:
     ```bash
     cp -r apache apache-php
     ```

2. **Modificación del `Dockerfile`**:
   - En el archivo `Dockerfile`, cambié la imagen base a `php:7.4-apache`, que incluye Apache y PHP.
   - Instalé la extensión `mysqli` de PHP para permitir la conexión a bases de datos MySQL.
   - Copié el archivo `index.php` al directorio adecuado dentro del contenedor Apache.
   - Aquí está el contenido modificado del `Dockerfile`:
     ```dockerfile
     # Usa una imagen base que tenga Apache y PHP
     FROM php:7.4-apache

     # Habilita los módulos necesarios para que Apache pueda manejar PHP
     RUN docker-php-ext-install mysqli

     # Copia el archivo index.php al directorio de Apache
     COPY index.php /var/www/html/

     # Expone el puerto 80
     EXPOSE 80
     ```

3. **Creación del archivo `index.php`**:
   - Creé un archivo PHP (`index.php`) con el siguiente contenido para mostrar información relevante:
     - Un mensaje de "Hola Mundo desde PHP".
     - La fecha y hora actual usando la función `date()`.
     - La versión de PHP con `phpversion()`.
     - La versión de Apache con `apache_get_version()`.
     - La IP del servidor con `getHostByName(getHostName())`.
     - La IP del cliente con `$_SERVER['REMOTE_ADDR']`.
   
   El contenido del archivo `index.php` es el siguiente:
   ```php
   <?php
   // Mostrar un mensaje de Hola Mundo
   echo "<h1>Hola Mundo desde PHP!</h1>";

   // Mostrar la fecha y hora actual
   echo "<p>Fecha y hora actual: " . date('Y-m-d H:i:s') . "</p>";

   // Mostrar la versión de PHP
   echo "<p>Versión de PHP: " . phpversion() . "</p>";

   // Mostrar la versión de Apache
   echo "<p>Versión de Apache: " . apache_get_version() . "</p>";

   // Mostrar la IP del servidor
   echo "<p>IP del servidor: " . getHostByName(getHostName()) . "</p>";

   // Mostrar la IP del cliente
   echo "<p>IP del cliente: " . $_SERVER['REMOTE_ADDR'] . "</p>";
   ?>

## Sprint 4: PHP

### Objetivo

En este sprint, hemos añadido dos archivos PHP importantes al servidor Apache para interactuar con el usuario:

1. **info.php**: Muestra información detallada sobre la configuración de PHP en el servidor.
2. **random.php**: Devuelve un JSON con un número aleatorio entre 1 y 100, indica si el número es par o impar y devuelve un elemento aleatorio de un array predefinido.

### Pasos realizados

1. **Creación del archivo `info.php`**:
   - Este archivo utiliza la función `phpinfo()` para mostrar toda la información relacionada con la configuración de PHP.
   
   El contenido del archivo `info.php` es el siguiente:
   ```php
   <?php
   // Muestra toda la información de PHP
   phpinfo();
   ?>

## Sprint 5: Composing con Apache + PHP + MySQL

### Objetivo

En este sprint, configuramos un entorno de desarrollo utilizando **Docker** con tres servicios principales: **Apache**, **PHP** y **MySQL**. Utilizamos Docker Compose para gestionar estos servicios y asegurarnos de que todos los contenedores se levanten correctamente y se comuniquen entre sí.

### Pasos realizados

1. **Crear el archivo `docker-compose.yml`**:
   - Este archivo define los servicios de Apache, PHP y MySQL, y las redes necesarias para que los contenedores se comuniquen entre sí. Aquí está el contenido del archivo `docker-compose.yml`:
   ```yaml
   version: '3.8'

   services:
     apache-php:
       build: ./apache-php
       ports:
         - "8080:80"
       depends_on:
         - mysql
       environment:
         MYSQL_HOST: mysql
         MYSQL_USER: root
         MYSQL_PASSWORD: example
         MYSQL_DATABASE: my_database
       networks:
         - backend

     mysql:
       image: mysql:5.7
       environment:
         MYSQL_ROOT_PASSWORD: example
         MYSQL_DATABASE: my_database
       volumes:
         - ./init.sql:/docker-entrypoint-initdb.d/init.sql
       networks:
         - backend

   networks:
     backend:
       driver: bridge
