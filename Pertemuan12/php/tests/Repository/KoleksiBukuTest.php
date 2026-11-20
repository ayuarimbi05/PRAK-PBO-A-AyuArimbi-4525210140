<?php
declare(strict_types=1);

namespace Perpustakaan\Tests\Repository;

use Perpustakaan\Exception\AnggotaTidakDitemukanException;
use Perpustakaan\Exception\BukuTidakDitemukanException;
use Perpustakaan\Model\Buku;
use Perpustakaan\Repository\KoleksiBuku;
use Perpustakaan\Service\LibraryService;
use PHPUnit\Framework\TestCase;

/**
 * Sesi 11 - unit test PHPUnit.
 *
 * Letakkan di tests/ dan pastikan autoload-dev pada composer.json sudah
 * memetakan Perpustakaan\Tests\ ke tests/.
 *
 * Jalankan: ./vendor/bin/phpunit tests
 */
final class KoleksiBukuTest extends TestCase
{
    private KoleksiBuku $koleksi;

    protected function setUp(): void
    {
        // Dijalankan ulang sebelum SETIAP pengujian.
        $this->koleksi = new KoleksiBuku();
    }

    public function testItemYangDisimpanDapatDitemukanKembali(): void
    {
        // TODO 1
        // SELESAI (TODO 1): simpan lalu cariByIsbn tidak null dan judulnya sesuai.
        $buku = new Buku('978-1', 'Pemrograman PHP', 'Penulis A', 5);
        $this->koleksi->simpan($buku);

        $hasil = $this->koleksi->cariByIsbn('978-1');
        $this->assertNotNull($hasil, 'Buku seharusnya ditemukan');
        $this->assertEquals('Pemrograman PHP', $hasil->getJudul(), 'Judul buku tidak sesuai');
    }

    public function testMencariIsbnYangTidakAdaMengembalikanNull(): void
    {
        // TODO 2
        // SELESAI (TODO 2): cariByIsbn mengembalikan null untuk ISBN yang tidak ada.
        $hasil = $this->koleksi->cariByIsbn('ISBN-KOSONG');
        $this->assertNull($hasil, 'Mencari ISBN yang tidak ada harus mengembalikan null');
    }

    public function testKoleksiBaruBerisiNolItem(): void
    {
        // TODO 3: perhatikan bahwa count($this->koleksi) bekerja
        // karena kelasnya implements Countable.
        // SELESAI (TODO 3): assertCount(0) dan assertEmpty pada koleksi baru.
        $this->assertCount(0, $this->koleksi, 'Jumlah item pada koleksi baru harus 0');
        $this->assertEmpty($this->koleksi->semua(), 'Array koleksi harus kosong');
    }

    public function testFilterHanyaMengembalikanYangLolosPredikat(): void
    {
        // TODO 4
        // SELESAI (TODO 4): hanya buku dengan stok > 0 yang lolos filter.
        $this->koleksi->simpan(new Buku('978-1', 'Buku A', 'Penulis A', 0));
        $this->koleksi->simpan(new Buku('978-2', 'Buku B', 'Penulis B', 5));

        $hasilFilter = $this->koleksi->filter(fn(Buku $b) => $b->getJumlahEksampelar() > 0);

        $this->assertCount(1, $hasilFilter, 'Hanya boleh ada 1 buku yang lolos filter (stok > 0)');
        $this->assertEquals('Buku B', $hasilFilter->semua()[0]->getJudul());
    }

    public function testJumlahkanMenghitungTotalDenganBenar(): void
    {
        // TODO 5
        // SELESAI (TODO 5): jumlahkan menjumlahkan eksemplar menjadi 5.0.
        $this->koleksi->simpan(new Buku('978-1', 'Buku A', 'Penulis A', 2));
        $this->koleksi->simpan(new Buku('978-2', 'Buku B', 'Penulis B', 3));

        $total = $this->koleksi->jumlahkan(fn(Buku $b) => $b->getJumlahEksampelar());

        $this->assertEquals(5.0, $total, 'Total eksemplar harus 5');
    }

    // TODO 6: terjemahkan minimal LIMA skenario dari skenario-uji.md sesi 10
    // menjadi kasus uji di sini, termasuk satu yang memastikan
    // exception yang benar dilemparkan.
    // Petunjuk: $this->expectException(BukuTidakDitemukanException::class);
    // SELESAI (TODO 6): ada 6 skenario tambahan di bawah, termasuk dua pengujian exception.

    public function testSimpanBukuDenganIsbnSamaAkanMenimpaDataLama(): void
    {
        $this->koleksi->simpan(new Buku('978-3', 'Buku Lama', 'Penulis X', 1));
        $this->koleksi->simpan(new Buku('978-3', 'Buku Baru', 'Penulis X', 2));

        $this->assertCount(1, $this->koleksi, 'Jumlah buku harus tetap 1 karena ISBN sama ditimpa');
        $this->assertEquals('Buku Baru', $this->koleksi->cariByIsbn('978-3')->getJudul());
    }

    public function testMapMengubahBentukDataDenganBenar(): void
    {
        $this->koleksi->simpan(new Buku('978-1', 'Buku A', 'Penulis', 1));
        $this->koleksi->simpan(new Buku('978-2', 'Buku B', 'Penulis', 1));

        $hasilMap = $this->koleksi->map(fn(Buku $b) => $b->getJudul());

        $this->assertEquals(['Buku A', 'Buku B'], $hasilMap);
    }

    public function testKelompokkanMemisahkanBerdasarkanPenulis(): void
    {
        $this->koleksi->simpan(new Buku('1', 'Buku A', 'Penulis X', 1));
        $this->koleksi->simpan(new Buku('2', 'Buku B', 'Penulis X', 1));
        $this->koleksi->simpan(new Buku('3', 'Buku C', 'Penulis Y', 1));

        $hasilKelompok = $this->koleksi->kelompokkan(fn(Buku $b) => $b->getPenulis());

        $this->assertCount(2, $hasilKelompok['Penulis X']);
        $this->assertCount(1, $hasilKelompok['Penulis Y']);
    }

    public function testExceptionPinjamBukuTidakAda(): void
    {
        $service = new LibraryService();
        $service->daftarkanAnggota('ANG-001');

        // Memastikan method membuang BukuTidakDitemukanException
        $this->expectException(BukuTidakDitemukanException::class);
        $service->pinjam('ANG-001', 'ISBN-KOSONG');
    }

    public function testExceptionPinjamAnggotaTidakTerdaftar(): void
    {
        $service = new LibraryService();

        // Memastikan method membuang AnggotaTidakDitemukanException
        $this->expectException(AnggotaTidakDitemukanException::class);
        $service->pinjam('ANG-KOSONG', '978-1');
    }
}