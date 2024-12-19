# Usa una imagen base que tenga Apache y PHP
FROM php:7.4-apache

# Habilita los módulos necesarios para que Apache pueda manejar PHP
RUN docker-php-ext-install mysqli

# Copia el archivo index.php al directorio de Apache
COPY index.php /var/www/html/

# Expone el puerto 80
EXPOSE 80
