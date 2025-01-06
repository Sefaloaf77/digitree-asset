# DIGITREE ASSETS

Description project

## Installation

Sebelum menjalankan projek ini pastikan php yang digunakan minimal versi 8.2.

Berikut tahap untuk setup projek :

- Clone this repository

```
  git clone atau git pull https://github.com/Sefaloaf77/digitree-asset.git
```

- Masuk ke direktori projek

```
cd digitree
```

- Instal dependency project menggunakan perintah

```
composer install
```

```
npm i
```

- Copy `.env.example` menjadi `.env` dengan perintah

```
cp .env.example .env
```

- Generate key laravel

```
php artisan key:generate
```

- Konfigurasi Database
  Sesuaikan konfigurasi database pada file `.env`

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digitree
DB_USERNAME=root
DB_PASSWORD=
```

- Generate Database & Seeder

```
php artisan migrate --seed
```
- Menjalankan projek laravel

```
php artisan storage:link
```
- Menjalankan projek laravel

```
php artisan serve
```

- Selain menjalankan php artisan serve, perlu juga menjalankan tailwindcss dengan command:

```
npm run dev
```



1) Sebelum push, pastikan pull dulu dari main! 
2) push pada branchmu sendiri, kemudian baru merge ke branch main!
