<?php
declare(strict_types=1);

namespace Perpustakaan\Model;

use InvalidArgumentException;
use LogicException;

final class Buku
{
    /** @var Bab[] */
    private array $bab = [];

    public function __construct(
        private readonly string $nomorInduk,
        private readonly string $judul,
        private readonly string $penulis,
        private int $jumlahEksemplar,
    ) {
        // TODO 2: tolak jumlah eksemplar negatif.
        // SELESAI (TODO 2): melempar InvalidArgumentException bila $jumlahEksemplar < 0.
        if ($jumlahEksemplar < 0) {
            throw new InvalidArgumentException('Jumlah eksemplar tidak boleh negatif!');
        }
    }

    /**
     * TODO 3: satu-satunya cara Bab lahir. Parameternya nomor dan judul, bukan objek Bab.
     * SELESAI (TODO 3): tambahBab(int $nomor, string $judulBab) membuat Bab di dalam Buku.
     */
    public function tambahBab(int $nomor, string $judulBab): void
    {
        $this->bab[] = new Bab($nomor, $judulBab);
    }

    /**
     * PHP mengembalikan array secara by-value, sehingga pemanggil hanya
     * memperoleh salinan larik-nya. Namun objek DI DALAMNYA tetap berbagi
     * referensi — itulah sebabnya Bab dibuat readonly.
     * Tuliskan penjelasan ini di bukti-relasi.md.
     *
     * @return Bab[]
     */
    public function getBab(): array
    {
        return $this->bab;
    }

    public function tersedia(): bool
    {
        return $this->jumlahEksemplar > 0;
    }

    /**
     * TODO 4
     * SELESAI (TODO 4): melempar LogicException bila stok sudah 0 (<= 0),
     * bukan hanya bila di bawah 0 seperti di berkas awal.
     */
    public function kurangiStok(): void
    {
        if ($this->jumlahEksemplar <= 0) {
            throw new LogicException('Gagal mengurangi stok: Stok eksemplar sudah 0.');
        }
        $this->jumlahEksemplar--;
    }

    public function tambahStok(): void
    {
        $this->jumlahEksemplar++;
    }

    public function getNomorInduk(): string
    {
        return $this->nomorInduk;
    }

    public function getJudul(): string
    {
        return $this->judul;
    }

    public function getPenulis(): string
    {
        return $this->penulis;
    }

    public function getJumlahEksampelar(): int
    {
        return $this->jumlahEksemplar;
    }

    public function __toString(): string
    {
        return sprintf('%-32s %-16s [%d eks, %d bab]',
            $this->judul, $this->penulis, $this->jumlahEksemplar, count($this->bab));
    }
}