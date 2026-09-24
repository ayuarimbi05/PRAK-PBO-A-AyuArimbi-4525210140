<?php
declare(strict_types=1);

require_once __DIR__ . '/Pegawai.php';

class PegawaiTetap extends Pegawai
{
    /** Tunjangan masa kerja: 2% gaji pokok per tahun, maksimum 40%. */
    protected const TUNJANGAN_PER_TAHUN = 0.02;
    protected const TUNJANGAN_MAKSIMUM  = 0.40;

    public function __construct(
        string $nip, string $nama, float $gajiPokok,
        protected readonly int $masaKerjaTahun,
    ) {
        // WAJIB. (Langkah 3: hapus sementara baris ini, jalankan,
        //         salin pesan kesalahannya, lalu kembalikan.)
        parent::__construct($nip, $nama, $gajiPokok);

        if ($masaKerjaTahun < 0) {
            throw new InvalidArgumentException('Masa kerja tidak boleh negatif.');
        }
    }

    /** Gaji dasar induk + tunjangan masa kerja. */
    public function hitungGaji(): float
    {
        $dasar  = parent::hitungGaji();
        $persen = min(
            $this->masaKerjaTahun * self::TUNJANGAN_PER_TAHUN,
            self::TUNJANGAN_MAKSIMUM
        );

        return $dasar + $dasar * $persen;
    }

    public function jenis(): string { return 'TETAP'; }

    protected function getMasaKerjaTahun(): int { return $this->masaKerjaTahun; }
}