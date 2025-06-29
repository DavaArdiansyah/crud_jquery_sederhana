<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## 🚀 Clone Project

```bash
git clone https://github.com/DavaArdiansyah/crud_jquery_sederhana.git
cd crud_jquery_sederhana
```
## 📦 Install Dependencies

```bash
composer install
npm install && npm run dev
```

## ⚙️ Setup Environment

Copy file `.env`:

```bash
cp .env.example .env
```

Generate key:

```bash
php artisan key:generate
```

Atur koneksi database di `.env` lalu migrasi:

```bash
php artisan migrate
```

## 🧪 Jalankan Development Server

```bash
php artisan serve
```
