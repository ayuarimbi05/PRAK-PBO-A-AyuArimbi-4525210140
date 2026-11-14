# PRAKTIKUM SESI 11
## Collection dan Unit Testing

**Nama:** Ayu Arimbi  
**NPM:** 4525210140

### Deskripsi
Pada praktikum sesi 11 ini, saya mempelajari tentang Collection, Generic Repository, dan Unit Testing. Praktikum ini membahas bagaimana cara menyimpan, mencari, menghapus, serta mengelola data buku menggunakan PHP dan Java.

Selain itu, saya juga belajar melakukan pengujian program untuk memastikan setiap fungsi berjalan sesuai dengan yang diharapkan.

### Tujuan Praktikum
1. Memahami penggunaan Collection dalam PHP.
2. Memahami konsep Generic Class pada Java.
3. Mempelajari cara menyimpan dan mencari data.
4. Memahami penggunaan interface dan callback.
5. Mengetahui cara melakukan pengujian program menggunakan PHPUnit dan JUnit.

### Penjelasan File

**1. KoleksiBuku.php**

File ini digunakan untuk mengelola kumpulan data buku. Di dalamnya terdapat beberapa fungsi, yaitu:

- `simpan()` untuk menyimpan data buku berdasarkan ISBN.
- `cariByIsbn()` untuk mencari buku berdasarkan ISBN.
- `semua()` untuk mengambil seluruh data buku.
- `filter()` untuk menyaring buku berdasarkan kondisi tertentu.
- `map()` untuk mengubah data buku menjadi bentuk lain.
- `jumlahkan()` untuk menghitung total nilai dari data buku.
- `kelompokkan()` untuk mengelompokkan buku berdasarkan kategori atau kunci tertentu.
- `getIterator()` agar objek dapat digunakan dalam perulangan foreach.
- `count()` untuk menghitung jumlah buku.

**2. Repository.java**

File ini merupakan kelas Generic Repository yang digunakan untuk mengelola data dengan tipe yang bisa ditentukan. Pada program ini, Repository dapat digunakan untuk menyimpan objek Buku.

Beberapa fungsi yang terdapat di dalamnya:

- `simpan()` untuk menyimpan data.
- `cariById()` untuk mencari data berdasarkan ID.
- `cariSemua()` untuk mengambil seluruh data.
- `hapus()` untuk menghapus data berdasarkan ID.
- `jumlah()` untuk menghitung jumlah data yang tersimpan.

**3. RepositoryTest.java**

File ini digunakan untuk melakukan pengujian pada kelas Repository menggunakan JUnit.

Pengujian dilakukan untuk memastikan bahwa:
- Data yang disimpan dapat ditemukan kembali.
- Pencarian data yang tidak tersedia menghasilkan Optional kosong.
- Data yang sudah dihapus tidak dapat ditemukan lagi.
- Repository baru memiliki jumlah data nol.
- Data yang dikembalikan tidak dapat diubah dari luar.

### Materi yang Dipelajari
Dari praktikum ini, materi yang saya pelajari meliputi:

1. Collection.
2. Generic Class.
3. Type Parameter.
4. Encapsulation.
5. Interface.
6. Callback Function.
7. Optional pada Java.
8. Iterator dan Countable pada PHP.
9. Unit Testing.
10. Penggunaan PHPUnit dan JUnit.

### Cara Menjalankan Program

**PHP (PHPUnit)**

Untuk menjalankan pengujian PHP, gunakan perintah:

```bash
./vendor/bin/phpunit tests
```

**Java (Maven)**

Untuk menjalankan pengujian Java, gunakan perintah:

```bash
mvn test
```

### Kesimpulan
Dari praktikum sesi 11 ini, saya memahami bahwa Collection dan Generic Repository dapat membantu dalam mengelola data agar lebih terstruktur. Saya juga mempelajari Unit Testing yang berguna untuk memeriksa apakah fungsi dalam program sudah berjalan dengan benar atau belum.

Dengan praktikum ini, saya menjadi lebih memahami cara mengelola data serta melakukan pengujian pada program menggunakan PHP dan Java.