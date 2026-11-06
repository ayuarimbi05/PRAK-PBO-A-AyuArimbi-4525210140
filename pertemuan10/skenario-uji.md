# Skenario Uji — Sesi 10

## Keputusan desain: unchecked (RuntimeException)
`PerpustakaanException` diturunkan dari `RuntimeException`. Kegagalan seperti ID
anggota salah, ISBN tidak ada, stok habis, atau batas pinjam terlampaui
menandakan **permintaan yang tidak sah**, bukan keadaan luar yang wajar
(file hilang, jaringan putus). Pemanggil tidak dipaksa menulis `try/catch` /
`throws` di setiap lapisan, tetapi tetap bisa menangkap semuanya sekaligus
lewat satu `catch (PerpustakaanException e)`. Di PHP semua exception memang
setara unchecked, sehingga `@throws` di PHPDoc menjadi dokumentasi utama.

## Skenario (sama untuk Java dan PHP)
| # | Anggota | ISBN | Hasil yang diharapkan                          |
|---|---------|------|------------------------------------------------|
| 1 | A-001   | 111  | Berhasil (stok 111 → 0)                        |
| 2 | A-002   | 111  | BukuSedangDipinjamException (judul + ISBN)     |
| 3 | A-002   | 999  | BukuTidakDitemukanException (ISBN 999)         |
| 4 | X-999   | 222  | AnggotaTidakDitemukanException (ID X-999)      |
| 5 | A-001   | 222  | Berhasil (pinjaman A-001 = 2)                  |
| 6 | A-001   | 222  | Berhasil (pinjaman A-001 = 3)                  |
| 7 | A-001   | 222  | BatasPinjamTerlampauiException (batas 3)       |

Urutan pemeriksaan di `pinjam()`: anggota → buku ada → stok → batas pinjam.

## Skenario tambahan (Java, lewat menu)
- Menu 1 dengan jumlah eksemplar `abc` → `[Error Input]`, program tidak crash.
- Menu 3 dengan ID kosong → peringatan, form diulang.
- Keluar (0) → `laporan_buku.txt` dibuat; writer ditutup otomatis (try-with-resources).
