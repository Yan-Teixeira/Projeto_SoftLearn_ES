#!/bin/bash

# Caminho do projeto (altere se precisar)
PROJECT_DIR=~/laravel_project
cd $PROJECT_DIR || exit

echo "=============================="
echo "Iniciando Laravel + Vite..."
echo "=============================="

# 1️⃣ Limpar caches e configurar Laravel
echo ">> Limpando caches..."
php artisan config:clear
php artisan cache:clear
php artisan config:cache

# 2️⃣ Gerar chave APP_KEY se não existir
if ! grep -q "APP_KEY=" .env || [ -z "$(grep APP_KEY= .env | cut -d '=' -f2)" ]; then
    echo ">> Gerando APP_KEY..."
    php artisan key:generate
fi

# 3️⃣ Rodar migrations
echo ">> Rodando migrations..."
php artisan migrate

# 4️⃣ Rodar Laravel server
echo ">> Iniciando servidor Laravel em http://0.0.0.0:8000"
php artisan serve --host=0.0.0.0 --port=8000 &
LARAVEL_PID=$!

# 5️⃣ Rodar Vite (frontend) em dev mode
if [ -f package.json ]; then
    echo ">> Iniciando Vite dev server em http://0.0.0.0:5173"
    npm run dev -- --host &
    VITE_PID=$!
fi

echo "=============================="
echo "Laravel + Vite iniciados!"
echo "Laravel PID: $LARAVEL_PID"
echo "Vite PID: $VITE_PID"
echo "=============================="
echo "Use 'kill $LARAVEL_PID $VITE_PID' para parar ambos."
