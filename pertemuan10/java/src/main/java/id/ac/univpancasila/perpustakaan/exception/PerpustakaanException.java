package id.ac.univpancasila.perpustakaan.exception;

/**
 * Sesi 10 — induk seluruh exception domain perpustakaan.
 *
 * Manfaat punya induk bersama: pemanggil bisa menangkap SELURUH kegagalan
 * domain sekaligus dengan satu blok catch, tanpa ikut menelan kesalahan
 * pemrograman yang lain.
 *
 * Keputusan: turunan RuntimeException (unchecked), karena kegagalan ini
 * menandakan permintaan yang tidak sah (ID/ISBN salah, batas terlampaui),
 * bukan keadaan luar yang wajar seperti file hilang atau jaringan putus.
 * Alasan lengkap ada di skenario-uji.md.
 */
public abstract class PerpustakaanException extends RuntimeException {

    protected PerpustakaanException(String pesan) {
        super(pesan);
    }

    protected PerpustakaanException(String pesan, Throwable penyebab) {
        super(pesan, penyebab);
    }
}
