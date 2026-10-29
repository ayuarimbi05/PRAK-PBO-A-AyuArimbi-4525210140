# Praktikum PBO Sesi 9 — Package, Namespace, dan Build Tool

**Nama:** Ayu Arimbi  
**NPM:** 4525210140  
**Mata Kuliah:** Praktikum Pemrograman Berorientasi Objek

## 1. Deskripsi Praktikum

Praktikum sesi 9 membahas penggunaan package pada Java, namespace pada PHP, serta build tool Maven dan Composer. Praktikum ini bertujuan agar struktur program lebih teratur, kelas dapat dikelompokkan berdasarkan fungsinya, dan dependensi eksternal dapat dikelola dengan lebih mudah.

## 2. Tujuan Praktikum

1. Memahami penggunaan package pada Java.
2. Memahami penggunaan namespace pada PHP.
3. Memahami struktur proyek Java menggunakan Maven.
4. Memahami pengelolaan dependensi PHP menggunakan Composer.
5. Menerapkan autoload PSR-4 pada PHP.
6. Menggunakan dependensi eksternal Datafaker dan Carbon.
7. Mengelola proyek menggunakan Git dan GitHub.

## 3. Struktur Folder Proyek

### A. Java dengan Maven

```text
java/
├── pom.xml
├── src/
│   ├── main/
│   │   ├── java/                        
│   │   │   └── id/ac/univpancasila/perpustakaan/
│   │   │       ├── App.java
│   │   │       ├── model/
│   │   │       │   ├── Buku.java
│   │   │       │   ├── Anggota.java
│   │   │       │   └── Peminjaman.java
│   │   │       ├── service/
│   │   │       │   └── PerpustakaanService.java
│   │   │       └── util/
│   │   │           └── Format.java
│   │   └── resources/                   
│   └── test/
│       └── java/                       
└── target/
```

### B. PHP dengan Composer

```text
php/
├── composer.json
├── composer.lock
├── main.php
└── src/
    ├── Model/
    │   ├── Buku.php
    │   ├── Anggota.php
    │   ├── Jurusan.php
    │   └── Mahasiswa.php
    └── Service/
        └── PerpustakaanService.php
```

## 4. Package pada Java

Package digunakan untuk mengelompokkan kelas berdasarkan fungsi dan kegunaannya. Pada proyek ini, package utama yang digunakan adalah:

```java
package id.ac.univpancasila.perpustakaan;
```

Kelas yang berkaitan dengan model ditempatkan dalam package:

```java
package id.ac.univpancasila.perpustakaan.model;
```

Sedangkan kelas yang berkaitan dengan layanan perpustakaan ditempatkan dalam package:

```java
package id.ac.univpancasila.perpustakaan.service;
```

Penggunaan package membuat struktur kode lebih terorganisasi dan membantu menghindari konflik nama kelas.

## 5. Namespace pada PHP

Namespace digunakan untuk mengelompokkan kelas PHP agar lebih teratur dan menghindari konflik nama kelas.

Contoh namespace untuk kelas model:

```php
namespace Perpustakaan\Model;
```

Contoh namespace untuk kelas service:

```php
namespace Perpustakaan\Service;
```

Dengan menggunakan namespace, kelas dapat dipanggil sesuai lokasi dan nama namespace yang telah ditentukan.

## 6. Maven pada Java

Maven merupakan build tool yang digunakan untuk mengelola dependensi, melakukan kompilasi, dan menjalankan proyek Java.

File konfigurasi Maven adalah `pom.xml`. Pada proyek ini, Maven digunakan untuk mengelola dependensi yang diperlukan, termasuk Datafaker.

### Perintah menjalankan proyek Java

Masuk ke folder proyek Java:

```powershell
cd java
```

Membersihkan hasil kompilasi sebelumnya dan melakukan kompilasi ulang:

```powershell
mvn clean compile
```

Menjalankan program utama:

```powershell
mvn exec:java "-Dexec.mainClass=id.ac.univpancasila.perpustakaan.Main"
```

Melihat daftar dependensi:

```powershell
mvn dependency:tree
```

Menyimpan daftar dependensi ke file:

```powershell
mvn dependency:tree > ../dependency-tree.txt
```

## 7. Composer pada PHP

Composer merupakan dependency manager untuk PHP yang digunakan untuk mengelola pustaka eksternal dan memuat kelas secara otomatis.

File konfigurasi Composer adalah `composer.json`.

Contoh konfigurasi autoload PSR-4:

```json
{
    "autoload": {
        "psr-4": {
            "Perpustakaan\\": "src/"
        }
    },
    "require": {
        "nesbot/carbon": "^3.15"
    }
}
```

Konfigurasi tersebut menghubungkan namespace `Perpustakaan\\` dengan folder `src/`.

### Perintah menjalankan proyek PHP

Masuk ke folder proyek PHP:

```powershell
cd php
```

Memasang dependensi:

```powershell
composer install
```

Memperbarui autoload setelah perubahan struktur kelas:

```powershell
composer dump-autoload
```

Menjalankan program:

```powershell
php main.php
```

## 8. Penggunaan Datafaker dan Carbon

### A. Datafaker

Datafaker merupakan library Java yang dapat digunakan untuk menghasilkan data contoh secara otomatis, seperti nama atau data fiktif lainnya.

Pada praktikum ini, Datafaker digunakan sebagai dependensi eksternal pada proyek Java untuk membantu menghasilkan data contoh.

### B. Carbon

Carbon merupakan library PHP untuk mempermudah pengolahan tanggal dan waktu.

Contoh penggunaan Carbon:

```php
use Carbon\Carbon;

$tanggalPeminjaman = Carbon::now();
$tanggalKembali = $tanggalPeminjaman->copy()->addDays(7);

echo "Tanggal peminjaman: " . $tanggalPeminjaman->format('d-m-Y');
echo PHP_EOL;
echo "Tanggal kembali: " . $tanggalKembali->format('d-m-Y');
```

Kode tersebut menghitung tanggal kembali tujuh hari setelah tanggal peminjaman.

## 9. Percobaan Package dan Namespace

Percobaan dilakukan dengan memeriksa hubungan antara nama package atau namespace dengan struktur folder kelas.

Apabila nama package atau namespace tidak sesuai dengan lokasi kelas, program dapat mengalami kesalahan ketika kompilasi atau ketika kelas dipanggil.

Perbaikan dilakukan dengan menyesuaikan deklarasi package atau namespace dan memastikan file berada pada folder yang sesuai.

Rincian percobaan, pesan kesalahan yang benar-benar muncul, dan langkah perbaikannya dicatat pada file `percobaan.md`.

## 10. Pengelolaan Proyek Menggunakan Git

Git digunakan untuk mencatat perubahan kode dan mengunggah hasil praktikum ke GitHub.

Perintah untuk memeriksa perubahan:

```powershell
git status
```

Menambahkan file ke staging:

```powershell
git add .
```

Membuat commit:

```powershell
git commit -m "Praktikum PBO Sesi 9"
```

Mengunggah perubahan ke GitHub:

```powershell
git push origin main
```

Folder hasil build seperti `target/` dan folder dependensi `vendor/` tidak perlu dimasukkan ke repositori. File `composer.lock` tetap disimpan agar versi dependensi PHP dapat dipertahankan.

## 11. Kesimpulan

Berdasarkan praktikum sesi 9, saya mempelajari penggunaan package pada Java dan namespace pada PHP untuk membuat struktur program lebih teratur. Saya juga mempelajari penggunaan Maven dan Composer untuk mengelola dependensi serta menjalankan proyek.

Selain itu, saya memahami penggunaan autoload PSR-4, dependensi eksternal Datafaker dan Carbon, serta pengelolaan kode menggunakan Git dan GitHub. Praktikum ini membantu saya memahami cara menyusun proyek Java dan PHP dengan struktur yang lebih rapi dan mudah dikelola.
