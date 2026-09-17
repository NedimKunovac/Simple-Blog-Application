# Simple-Blog-Application

A full-stack blog application built with **Laravel 11**, **PostgreSQL**, **Inertia.js**, **Vue 3**, **Tailwind CSS**, and **PrimeVue**.

---

## ✨ Features

* **Authentication**: Complete user registration, login, and logout powered by Laravel Breeze.
* **Blog Post Management (CRUD)**: Full lifecycle support (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`) with strict request validation for titles and content.
* **Interactive Comments**: View all comments per post, submit new comments, and delete comments with smooth UI state preservation (`preserveScroll`).
* **Dual Authorization**: Server-side Laravel Policies (`PostPolicy`, `CommentPolicy`) paired with reactive client-side ownership checks (`v-if`).
* **Modern Frontend Architecture**: Vue 3 Composition API (`<script setup>`), Inertia.js SPA experience, Tailwind CSS, and PrimeVue UI components.

---

## 🚀 Tech Stack
* **Backend:** Laravel 11, PHP 8.2+, PostgreSQL, Eloquent ORM, Laravel Policies
* **Frontend:** Vue 3 (Composition API), Inertia.js, Tailwind CSS, PrimeVue
* **Asset Bundler:** Vite

---

## 📋 Prerequisites
* **PHP >= 8.2** (`pdo_pgsql`, `mbstring`, `bcmath`, `gd`, `zip`)
* **Composer**
* **Node.js >= 20** & **npm**
* **PostgreSQL** instance running locally

---

## 🛠️ Step-by-Step Local Setup

```bash
# 1. Clone & enter repository
git clone https://github.com/NedimKunovac/Simple-Blog-Application.git
cd Simple-Blog-Application

# 2. Install dependencies
composer install
npm install

# 3. Environment & Key Generation
cp .env.example .env
php artisan key:generate

# 4. Database Setup (Configure DB_* credentials in .env first, then:)
createdb your_database_name
php artisan migrate --seed
```

## 🏃 Running the Application

Run frontend hot-reloading and your backend server concurrently in two terminal windows:

### Terminal 1 — Frontend (Vite HMR)
```bash
npm run dev
```

### Terminal 2 — Backend Server (Choose Artisan or Herd)
#### Option A — PHP Artisan:
```bash
php artisan serve
```

#### Option B — Laravel Herd:
```bash
herd link
```
