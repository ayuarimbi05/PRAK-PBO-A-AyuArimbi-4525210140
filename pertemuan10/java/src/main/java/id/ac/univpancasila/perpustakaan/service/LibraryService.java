package id.ac.univpancasila.perpustakaan.service;

import java.util.HashMap;
import java.util.Map;

import id.ac.univpancasila.perpustakaan.exception.AnggotaTidakDitemukanException;
import id.ac.univpancasila.perpustakaan.exception.BatasPinjamTerlampauiException;
import id.ac.univpancasila.perpustakaan.exception.BukuSedangDipinjamException;
import id.ac.univpancasila.perpustakaan.exception.BukuTidakDitemukanException;

/**
 * Sesi 10 Langkah 2 — HASIL REFACTORING dari LibraryServiceKotor.
 *
 * pinjam() memakai guard clause: setiap syarat diperiksa di awal dan
 * langsung melempar exception yang menjelaskan ALASAN kegagalan.
 * Logika utama berada di tingkat paling kiri (tanpa nesting).
 */
public class LibraryService {

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

    /**
     * @throws AnggotaTidakDitemukanException jika anggota belum terdaftar
     * @throws BukuTidakDitemukanException    jika ISBN tidak ada di katalog
     * @throws BukuSedangDipinjamException    jika tidak ada eksemplar tersisa
     * @throws BatasPinjamTerlampauiException jika anggota sudah mencapai batas
     */
    public boolean pinjam(String idAnggota, String isbn) {
        if (!pinjaman.containsKey(idAnggota)) {
            throw new AnggotaTidakDitemukanException(idAnggota);
        }
        if (!stok.containsKey(isbn)) {
            throw new BukuTidakDitemukanException(isbn);
        }
        if (stok.get(isbn) <= 0) {
            throw new BukuSedangDipinjamException(isbn, judul.get(isbn));
        }
        if (pinjaman.get(idAnggota) >= BATAS_PINJAM) {
            throw new BatasPinjamTerlampauiException(idAnggota, BATAS_PINJAM);
        }

        stok.merge(isbn, -1, Integer::sum);
        pinjaman.merge(idAnggota, 1, Integer::sum);
        return true;
    }

    public int sisaEksemplar(String isbn) {
        return stok.getOrDefault(isbn, 0);
    }

    public String judulDari(String isbn) {
        return judul.get(isbn);
    }

    public Map<String, String> getSemuaJudul() {
        return this.judul;
    }
}
