package id.ac.univpancasila.perpustakaan;

import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.DisplayName;
import org.junit.jupiter.api.Test;

import static org.junit.jupiter.api.Assertions.*;

/**
 * Sesi 11 — unit test pertama Anda.
 *
 * Letakkan berkas ini di src/test/java/id/ac/univpancasila/perpustakaan/
 * Jalankan dengan: mvn test
 *
 * Konvensi Maven: hanya berkas di src/test/java yang bernama *Test
 * yang akan dijalankan sebagai pengujian.
 */
class RepositoryTest {

    /** Objek sederhana untuk diuji. */
    record Buku(String isbn, String judul) {}

    private Repository<Buku> repo;

    @BeforeEach
    void siapkan() {
        // Dijalankan ulang sebelum SETIAP pengujian, sehingga tiap uji
        // berangkat dari keadaan yang bersih dan tidak saling memengaruhi.
        repo = new Repository<>(Buku::isbn);
    }

   @Test
@DisplayName("Item yang disimpan dapat ditemukan kembali")
void simpanLaluTemukan() {
    repo.simpan(new Buku("978-1", "PBO"));

    assertTrue(repo.cariById("978-1").isPresent());
    assertEquals("PBO", repo.cariById("978-1").get().judul());
}

@Test
@DisplayName("Mencari id yang tidak ada mengembalikan Optional kosong")
void cariYangTidakAda() {
    assertTrue(repo.cariById("999").isEmpty());
}

@Test
@DisplayName("Item yang dihapus tidak dapat ditemukan lagi")
void hapusItem() {
    repo.simpan(new Buku("978-1", "PBO"));

    assertTrue(repo.hapus("978-1"));
    assertTrue(repo.cariById("978-1").isEmpty());
}

@Test
@DisplayName("Repository baru berisi nol item")
void repositoryKosong() {
    assertEquals(0, repo.jumlah());
}

@Test
@DisplayName("Koleksi yang dikembalikan cariSemua tidak dapat diubah dari luar")
void koleksiTidakBocor() {
    repo.simpan(new Buku("978-1", "PBO"));

    assertThrows(UnsupportedOperationException.class,
        () -> repo.cariSemua().add(new Buku("978-2", "Java")));
}

// Tiga pengujian tambahan

@Test
@DisplayName("Jumlah item bertambah setelah menyimpan buku")
void jumlahBertambah() {
    repo.simpan(new Buku("978-1", "PBO"));
    assertEquals(1, repo.jumlah());
}

@Test
@DisplayName("Menyimpan ID yang sama mengganti data sebelumnya")
void simpanIdSama() {
    repo.simpan(new Buku("978-1", "PBO"));
    repo.simpan(new Buku("978-1", "Java"));

    assertEquals(1, repo.jumlah());
    assertEquals("Java", repo.cariById("978-1").get().judul());
}

@Test
@DisplayName("Menghapus ID yang tidak tersedia menghasilkan false")
void hapusIdTidakAda() {
    assertFalse(repo.hapus("999"));
}
}