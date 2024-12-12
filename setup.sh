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

# Verificar se os containers estão rodando
echo "Verificando se os containers estão ativos..."
until [ "$(docker inspect -f '{{.State.Running}}' games 2>/dev/null)" == "true" ]; do
    echo "Containers ainda iniciando. Tentando novamente em 5 segundos..."
    sleep 5
done
echo "Containers ativos."

# Instalar dependências do projeto
echo "Instalando dependências do projeto..."
docker exec -it games composer install

# Garantir permissões adequadas
echo "Setando permissoes adequadas..."
docker exec -it games chmod -R 775 storage bootstrap/cache

# Configurar Laravel
echo "Configurando Laravel..."
docker exec -it games php artisan key:generate
docker exec -it games php artisan config:clear
docker exec -it games php artisan cache:clear
docker exec -it games php artisan route:clear
docker exec -it games php artisan view:clear

# Esperar pelo banco de dados (usando um loop)
echo "Rodando migrations..."
until docker exec -it games php artisan migrate --force; do
    echo "Banco de dados indisponível. Tentando novamente em 5 segundos..."
    sleep 5
done

# Rodar seeders
echo "Rodando seeders..."
docker exec -it games php artisan db:seed --force

echo "Ambiente configurado com sucesso!"
