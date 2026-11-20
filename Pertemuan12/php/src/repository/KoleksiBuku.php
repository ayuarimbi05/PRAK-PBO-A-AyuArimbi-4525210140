<?php
declare(strict_types=1);

namespace Perpustakaan\Repository;

use Countable;
use Perpustakaan\Model\Buku;

/*
 * Catatan TODO dari berkas awal (KoleksiBuku.php berisi salinan kelas Bab dan Buku):
 * - TODO 1 (constructor readonly Bab)  -> SELESAI, lihat src/Model/Bab.php
 * - TODO 2 (tolak eksemplar negatif)   -> SELESAI, lihat src/Model/Buku.php
 * - TODO 3 (tambahBab)                 -> SELESAI, lihat src/Model/Buku.php
 * - TODO 4 (kurangiStok)               -> SELESAI, lihat src/Model/Buku.php
 * Kelas ini sendiri hanya berisi KoleksiBuku, agar tidak bentrok dengan Model/Buku.php.
 */

/**
 * Koleksi buku dengan operasi fungsional sederhana: filter, map, jumlahkan, kelompokkan.
 * Kunci internalnya adalah ISBN (nomor induk).
 */
final class KoleksiBuku implements Countable
{
    /** @var array<string, Buku> */
    private array $data = [];

    public function simpan(Buku $buku): void
    {
        $this->data[$buku->getNomorInduk()] = $buku;
    }

    public function cariByIsbn(string $isbn): ?Buku
    {
        return $this->data[$isbn] ?? null;
    }

    /** @return Buku[] */
    public function semua(): array
    {
        return array_values($this->data);
    }

    /** Mengembalikan koleksi baru yang hanya berisi buku yang lolos predikat. */
    public function filter(callable $predikat): self
    {
        $hasil = new self();
        foreach ($this->data as $isbn => $buku) {
            if ($predikat($buku)) {
                $hasil->data[$isbn] = $buku;
            }
        }
        return $hasil;
    }

    /** @return array<int, mixed> */
    public function map(callable $fungsi): array
    {
        return array_values(array_map($fungsi, $this->data));
    }

    public function jumlahkan(callable $fungsi): float
    {
        $total = 0.0;
        foreach ($this->data as $buku) {
            $total += (float) $fungsi($buku);
        }
        return $total;
    }

    /** @return array<string, Buku[]> */
    public function kelompokkan(callable $kunci): array
    {
        $hasil = [];
        foreach ($this->data as $buku) {
            $hasil[$kunci($buku)][] = $buku;
        }
        return $hasil;
    }

    public function count(): int
    {
        return count($this->data);
    }
}