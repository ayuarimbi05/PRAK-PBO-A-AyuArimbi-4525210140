# Praktikum Sesi 6 — Sistem Apotek

**Nama:** Ayu Arimbi  
**NPM:** 4525210140  
**Mata Kuliah:** Praktikum Pemrograman Berorientasi Objek

## A. Deskripsi Program

Program ini merupakan program sederhana untuk sistem penjualan obat menggunakan bahasa PHP. Program dapat menampilkan daftar obat, data pelanggan, melakukan transaksi pembelian, menghitung total harga, serta menampilkan status pembayaran dan sisa stok obat.

Program ini dibuat untuk menerapkan konsep Pemrograman Berorientasi Objek (OOP) menggunakan abstract class, interface, inheritance, encapsulation, enum, dan method overriding.

## B. Tujuan Praktikum

1. Memahami penggunaan abstract class dan interface pada PHP.
2. Memahami konsep inheritance atau pewarisan kelas.
3. Menerapkan encapsulation menggunakan atribut private dan method getter.
4. Menggunakan enum untuk menentukan status pembayaran.
5. Mengimplementasikan perhitungan harga, PPN, biaya resep, dan pengurangan stok obat.
6. Memahami hubungan antara objek obat, pelanggan, dan transaksi.

## C. Daftar File Program

| No. | Nama File | Keterangan |
|---|---|---|
| 1. | `Main.php` | Program utama untuk membuat objek obat dan pelanggan, menjalankan transaksi, serta menampilkan hasil program. |
| 2. | `Obat.php` | Berisi interface `BisaDijual`, abstract class `Obat`, serta kelas `ObatBebas` dan `ObatKeras`. |
| 3. | `Pelanggan.php` | Berisi kelas `Pelanggan` untuk menyimpan nama dan nomor HP pelanggan. |
| 4. | `Status.php` | Berisi enum `StatusBayar` dengan status Lunas dan Belum Bayar. |
| 5. | `Transanksi.php` | Berisi kelas `Transaksi` untuk memproses pembayaran, memeriksa stok, menghitung total harga, dan mencetak transaksi. |

## D. Konsep OOP yang Digunakan

### 1. Interface

Interface `BisaDijual` digunakan sebagai kontrak yang mengharuskan kelas obat memiliki method `hitungHarga()`.

### 2. Abstract Class

Abstract class `Obat` menjadi kelas dasar yang menyimpan nama, harga, dan stok obat. Kelas ini juga menyediakan method untuk menghitung harga dan mengurangi stok.

### 3. Inheritance

Kelas `ObatBebas` dan `ObatKeras` mewarisi atribut serta method dari kelas `Obat`. Kedua kelas memiliki jenis obat yang berbeda.

### 4. Encapsulation

Atribut pada kelas `Obat`, `Pelanggan`, dan `Transaksi` menggunakan akses `private` agar data tidak diakses secara langsung dari luar kelas.

### 5. Enum

Enum `StatusBayar` digunakan untuk menentukan status pembayaran, yaitu `Lunas` dan `Belum Bayar`.

### 6. Method Overriding

Kelas `ObatKeras` mengubah implementasi method `hitungHarga()` dengan menambahkan biaya resep sebesar Rp5.000 ke harga yang sudah termasuk PPN.

### 7. Constructor dan Static

Constructor digunakan untuk memberikan nilai awal pada objek. Sementara itu, properti static `$jumlahObat` digunakan untuk menghitung jumlah objek obat yang dibuat.

## E. Cara Menjalankan Program

Pastikan PHP sudah terpasang dan seluruh file PHP berada dalam satu folder.

1. Buka folder tugas melalui Visual Studio Code.
2. Buka terminal pada folder tersebut.
3. Jalankan perintah berikut:

```bash
php Main.php
```

4. Tekan Enter untuk menjalankan program.
5. Hasil program akan ditampilkan pada terminal.

**Catatan:** Pastikan penulisan nama file pada perintah `require_once` sesuai dengan nama file yang digunakan, termasuk `Transanksi.php`.

## F. Hasil Program

Program menampilkan dua bagian utama, yaitu daftar obat dan transaksi pembelian.

- **Daftar Obat:** menampilkan nama obat, jenis obat, stok, dan jumlah objek obat.
- **Transaksi:** menampilkan nama pembeli, nama obat, jumlah pembelian, total harga, dan status pembayaran.
- **Pengecekan Stok:** transaksi berhasil mengurangi stok jika jumlah obat mencukupi. Jika stok tidak cukup, program menampilkan pesan bahwa stok obat tidak mencukupi.
- **Perhitungan Harga:** total harga mencakup PPN sebesar 11%. Untuk obat keras, terdapat tambahan biaya resep sebesar Rp5.000.

## G. Screenshot Hasil Program

Tambahkan screenshot hasil eksekusi `Main.php` pada bagian ini.

**Screenshot 1 — Daftar Obat dan Jumlah Obat**

Sisipkan gambar hasil output daftar obat dari terminal.

**Screenshot 2 — Hasil Transaksi Pembelian**

Sisipkan gambar hasil output transaksi yang menampilkan nama pembeli, obat, total harga, dan status pembayaran.

**Screenshot 3 — Pengecekan Stok Obat**

Sisipkan gambar hasil output yang menunjukkan pesan ketika stok obat tidak mencukupi dan informasi sisa stok.

## H. Kesimpulan

Berdasarkan praktikum ini, saya mempelajari penerapan konsep OOP dalam pembuatan program penjualan obat menggunakan PHP. Konsep abstract class, interface, inheritance, encapsulation, dan enum digunakan untuk mengatur data obat, pelanggan, serta transaksi. Program ini juga menerapkan perhitungan harga, penambahan PPN, biaya resep, dan pengecekan stok sebelum transaksi dinyatakan lunas.
