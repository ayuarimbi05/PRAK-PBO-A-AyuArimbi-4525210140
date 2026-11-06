package id.ac.univpancasila.perpustakaan.service;

import java.util.HashMap;
import java.util.Map;

/**
 * Sesi 10 Langkah 2 — BAHAN REFACTORING (versi SEBELUM).
 *
 * Method pinjam() di bawah bersarang EMPAT tingkat. Versi hasil refaktor
 * (guard clause + exception) ada di LibraryService.java.
 * JANGAN dihapus — keduanya diperlukan saat demo.
 *
 * Pertanyaan pemandu:
 * 1. Di mana letak logika utamanya? Berapa tingkat menjorok ke dalam?
 * 2. Apa yang terjadi kalau salah satu kondisi tidak terpenuhi?
 *    Apakah pemanggil bisa tahu ALASANNYA?
 * 3. Bagaimana Anda menambahkan satu aturan baru di tengah-tengah ini?
 */
public class LibraryServiceKotor {

    public static final int BATAS_PINJAM = 3;

    private final Map<String, Integer> stok = new HashMap<>();
    private final Map<String, String> judul = new HashMap<>();
    private final Map<String, Integer> pinjaman = new HashMap<>();

    public void tambahBuku(String isbn, String judulBuku, int eksemplar) {
        stok.merge(isbn, eksemplar, Integer::sum);
        judul.put(isbn, judulBuku);
    }

    public void daftarkanAnggota(String idAnggota) {
        pinjaman.putIfAbsent(idAnggota, 0);
    }

    public boolean pinjam(String idAnggota, String isbn) {
        if (pinjaman.containsKey(idAnggota)) {
            if (stok.containsKey(isbn)) {
                if (stok.get(isbn) > 0) {
                    if (pinjaman.get(idAnggota) < BATAS_PINJAM) {
                        stok.merge(isbn, -1, Integer::sum);
                        pinjaman.merge(idAnggota, 1, Integer::sum);
                        return true;
                    } else {
                        return false; // kenapa gagal? pemanggil tidak tahu
                    }
                } else {
                    return false; // kenapa gagal? pemanggil tidak tahu
                }
            } else {
                return false; // kenapa gagal? pemanggil tidak tahu
            }
        } else {
            return false; // kenapa gagal? pemanggil tidak tahu
        }
    }

    public int sisaEksemplar(String isbn) {
        return stok.getOrDefault(isbn, 0);
    }

    public String judulDari(String isbn) {
        return judul.get(isbn);
    }
}
