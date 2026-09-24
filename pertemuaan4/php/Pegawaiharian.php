<?php
declare(strict_types=1);

require_once __DIR__ . '/Pegawai.php';

/** Pegawai harian: $gajiPokok diperlakukan sebagai upah per hari kerja. */
class PegawaiHarian extends Pegawai
{
    public function __construct(
        string $nip, string $nama, float $upahPerHari,
        private readonly int $hariKerja,
    ) {
        parent::__construct($nip, $nama, $upahPerHari);

        if ($hariKerja < 0) {
            throw new InvalidArgumentException('Hari kerja tidak boleh negatif.');
        }
    }

    public function hitungGaji(): float
    {
        return parent::hitungGaji() * $this->hariKerja;
    }

    public function jenis(): string { return 'HARIAN'; }

    public function getHariKerja(): int { return $this->hariKerja; }
}