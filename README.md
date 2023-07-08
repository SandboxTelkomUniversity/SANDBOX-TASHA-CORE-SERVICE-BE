## Cara instalasi
1. Clone repository ini
2. Buka terminal dan arahkan ke folder repository ini
3. Jalankan perintah `composer install`
4. Copy file `.env.example` dan rename menjadi `.env`
5. Sesuaikan konfigurasi database di file `.env`
5. Buat database baru di MySQL
6. Jalankan perintah `php artisan key:generate`
8. Jalankan perintah `php artisan jwt:secret`
9. Jalankan perintah `php artisan migrate`
10. Jalankan perintah `php artisan db:seed`
11. Jalankan perintah `php artisan storage:link` 
12. Jalankan perintah `php artisan serve --host=0.0.0.0`
13. Buka postman dan pointing ke `103.250.11.97:8000/api/v1`
14. Selesai

## user access
### user investor 1
email: `tester@gmail.com`
password: `password`

### user investor 1
email: `tester2@gmail.com`
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

Made with ❤ by Tasha
