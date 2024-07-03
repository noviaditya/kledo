
# Kledo Backend Engineer Test




## Installasi
Setelah clone repository ini, jalankan perintah berikut secara berurutan : 

- jalankan perintah di terminal : ```composer install```
- sesuaikan env database : (sesuaikan dengan pengaturan di local masing-masing)
- jalankan perintah : ```php artisan migrate --seed```

## Testing
Untuk melakukan testing bisa menggunakan perintah : `vendor/bin/phpunit`

## Dokumentasi
- Jalankan perintah ini untuk menggenerate dokumentasi API : ```php artisan l5-swagger:generate```
- Dokumentasi API bisa dicek di : `http://localhost:8000/api/documentation`

