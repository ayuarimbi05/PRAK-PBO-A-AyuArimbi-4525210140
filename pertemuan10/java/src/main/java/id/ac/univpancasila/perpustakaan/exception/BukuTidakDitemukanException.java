package id.ac.univpancasila.perpustakaan.exception;

/**
 * EXCEPTION YANG MEMBAWA DATA — bukan sekadar teks.
 *
 * Atribut isbn membuat pemanggil bisa MENGAMBIL data penyebabnya kembali,
 * bukan harus mengurai kalimat pesan.
 *
 * Pada sesi 13 dan 14, data inilah yang menjadi isi badan respons HTTP 404.
 */
public class BukuTidakDitemukanException extends PerpustakaanException {

    private final String isbn;

    public BukuTidakDitemukanException(String isbn) {
        super("Buku dengan ISBN " + isbn + " tidak ditemukan");
        this.isbn = isbn;
    }

    public String getIsbn() {
        return this.isbn;
    }
}
