# Use an official PHP runtime as a parent image
FROM php:8.0-apache

# Set the working directory to /app
WORKDIR /app

# Copy the current directory contents into the container at /app
COPY . /app

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache modules
RUN a2enmod rewrite

# Copy Apache virtual host configuration
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Update the default Apache port to 8080
RUN sed -i 's/80/8080/' /etc/apache2/ports.conf

# Expose port 8080 to the outside world
EXPOSE 8080

# Run Apache when the container launches
CMD ["apache2-foreground"]
