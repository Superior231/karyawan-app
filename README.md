# Karyawan App

**Karyawan App** adalah aplikasi yang digunakan untuk mengelola data karyawan.

Authentication (default):
| Role | Username | Password |
| --- | --- | --- |
| Super Admin | Super Admin | superadmin1234 |
| Admin | Admin | admin1234 |

## Requirements

- [Laravel 11](https://laravel.com/docs/11.x)
- [Composer](https://getcomposer.org/)
- [PHP 8.3](https://www.php.net/)
- [XAMPP](https://www.apachefriends.org/download.html)

## Libraries

- [Laravel UI](https://github.com/laravel/ui)
- [Laravel Livewire](https://livewire.laravel.com/)
- [SweetAlert2](https://sweetalert2.github.io/)
- [Bootstrap](https://getbootstrap.com/)
- [DataTables](https://datatables.net/)

## Installation

Clone the repository by running the following command:

```shell
git clone https://github.com/Superior231/karyawan-app.git
cd karyawan-app
```

Install Dependency:

```shell
composer install
```

Set Environment Variables:

```shell
cp .env.example .env
```

Generate Application Key:

```shell
php artisan key:generate
```

Database Configuration `.env`:

```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=karyawan_app
DB_USERNAME=root
DB_PASSWORD=
```

Run Database Migrations and Seeders:

```shell
php artisan migrate --seed
php artisan db:seed PositionSeeder
php artisan db:seed EmployeeSeeder
```

## Usage

Run Application:

```shell
php artisan serve
```

Server is running. Open url `http://127.0.0.1:8000` in browser.
