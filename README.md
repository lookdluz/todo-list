# Laravel To‑Do List


App de tarefas focado em portfólio, com autenticação, projetos, tarefas com subtarefas, tags, prioridades, prazos, comentários e anexos. Inclui API com Sanctum e testes básicos.


## ✨ Features
- Auth (Laravel Breeze + Blade/Tailwind)
- Projetos e Tarefas (subtarefas via `parent_id`)
- Tags (N:N), prioridades e datas de vencimento
- Comentários e Upload de anexos
- Filtros, busca, paginação
- Soft deletes e Policies por dono
- API REST (Sanctum)
- Seeder de demo e testes Feature


## 🧱 Stack
- PHP 8.2+, Laravel 10/11
- SQLite (dev), Postgres/MySQL (prod)
- Tailwind + Alpine (frontend Blade)
- Sanctum para autenticação de API


## 🚀 Como rodar (dev)
```bash
composer install
cp .env.example .env
php -r "file_put_contents('database/database.sqlite','');"
php artisan key:generate
# Ajuste no .env -> DB_CONNECTION=sqlite
php artisan migrate --seed
php artisan serve
npm install && npm run dev
```