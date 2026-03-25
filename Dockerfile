# 1. Usa a imagem oficial do PHP 8.2 na versão FPM (sem Apache)
FROM php:8.2-fpm

# 2. Atualiza o Linux interno e instala dependências básicas
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev

# 3. Instala extensões essenciais do PHP (ex: banco de dados e zip)
RUN docker-php-ext-install pdo pdo_mysql mysqli zip

# 4. Define a pasta de trabalho padrão dentro do container
WORKDIR /var/www/html

# 5. Copia os arquivos do projeto para o container
COPY ./src .

# Copia o seu arquivo de configuração para a pasta que o PHP lê automaticamente
COPY ./custom.ini /usr/local/etc/php/conf.d/custom.ini
