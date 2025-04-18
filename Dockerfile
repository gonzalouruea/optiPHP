# Usar una imagen base de PHP 8.2 con Apache
FROM php:8.2-apache

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Instalar dependencias del sistema y extensiones PHP
RUN apt-get update && apt-get install -y \
  libzip-dev \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  && docker-php-ext-install \
  pdo_mysql \
  zip \
  mbstring \
  gd \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

# Habilitar el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copiar el contenido de src/ al contenedor (lo sobreescribimos con el volumen también)
# Podrías omitirlo si vas a trabajar 100% con volumen
COPY src/ /var/www/html/

# Configuración personalizada de Apache para permitir acceso a /public
RUN echo "<VirtualHost *:80>\n\
  DocumentRoot /var/www/html/public\n\
  <Directory /var/www/html/public>\n\
  Options Indexes FollowSymLinks\n\
  AllowOverride All\n\
  Require all granted\n\
  </Directory>\n\
  </VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Asegurar permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html

# Exponer el puerto 80
EXPOSE 80

# Comando por defecto: iniciar Apache en primer plano
CMD ["apache2-foreground"]
