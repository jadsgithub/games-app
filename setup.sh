#!/bin/bash

echo "Iniciando configuração do ambiente..."

# Criar o .env se não existir
echo "Criando o arquivo .env..."
if [ ! -f .env ]; then
    echo "Arquivo .env não encontrado. Criando com base no .env.example."
    cp .env.example .env
fi

# Subir os containers
echo "Iniciando os containers com docker-compose..."
docker-compose up -d --build

# Instalar dependências do projeto
echo "Instalando dependências do projeto..."
composer install

# Garantir permissões adequadas
echo "Setando permissoes adequadas..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data /var/www

# Configurar Laravel
echo "Configurando Laravel..."
php artisan key:generate
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Esperar pelo banco de dados (usando um loop)
echo "Rodando migrations..."
until php artisan migrate --force; do
    echo "Banco de dados indisponível. Tentando novamente em 5 segundos..."
    sleep 5
done

# Rodar seeders
echo "Rodando seeders..."
php artisan db:seed --force

echo "Ambiente configurado com sucesso!"