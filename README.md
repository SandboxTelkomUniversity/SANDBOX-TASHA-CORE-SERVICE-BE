## Cara instalasi
1. Clone repository ini
2. Buka terminal dan arahkan ke folder repository ini
3. Jalankan perintah `composer update / composer install`
4. Jalankan perintah `cp.env.example .env`
5. Sesuaikan konfigurasi database di file `.env`
6. Buat database baru di MySQL
7. Jalankan perintah `php artisan key:generate`
8. Jalankan perintah `php artisan jwt:secret`
9. Jalankan perintah `php artisan migrate:fresh --seed`
10. Jalankan perintah `php artisan storage:link` 
11. Jalankan perintah `php artisan serve --host=0.0.0.0`
12. Buka postman dan pointing ke `103.250.11.97:8000/api/v1`
13. Selesai

## user access
### user investor 1
email: `investor@gmail.com`
password: `password`

### user investor 2
email: `investor2@gmail.com`
password: `password`

### user umkm 1
email: `sme@gmail.com`
passwords: `password`

### user umkm 2
email: `sme2@gmail.com`
passwords: `password`

### user reviewer 1
email: `admin@example.com`
passwords: `password`

### user reviewer 2
email: `admin2@example.com`
passwords: `password`

Made with ❤ by Sandbox Telkom University
