# Struktur proyek Composer — Sesi 10

```
php/
├── composer.json
├── composer.lock
├── main.php                      <- demo (php main.php)
├── src/
│   ├── Exception/
│   │   ├── PerpustakaanException.php
│   │   ├── AnggotaTidakDitemukanException.php
│   │   ├── BatasPinjamTerlampauiException.php
│   │   ├── BukuSedangDipinjamException.php
│   │   └── BukuTidakDitemukanException.php
│   ├── Model/                    <- kosong untuk sesi ini
│   ├── Service/
│   │   ├── LibraryService.php        (SESUDAH refaktor)
│   │   └── LibraryServiceKotor.php   (SEBELUM refaktor)
│   └── Util/                     <- kosong untuk sesi ini
├── tests/
└── vendor/                       <- hasil composer install, JANGAN di-commit
```

Jalankan: `composer install` lalu `php main.php`
