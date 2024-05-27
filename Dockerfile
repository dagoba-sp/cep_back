# Use a imagem oficial do PHP com Apache
FROM php:8.3-apache

# Copie o código do seu projeto para o diretório raiz do Apache
COPY . /var/www/html/

# Exponha a porta 80 para acessar o servidor web
EXPOSE 80