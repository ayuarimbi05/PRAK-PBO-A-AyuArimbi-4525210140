<?php
declare(strict_types=1);

require_once __DIR__ . '/Pegawai.php';

class PegawaiKontrak extends Pegawai
{
    public function __construct(
        string $nip, string $nama, float $gajiPokok,
        private readonly int $bulanKontrak,
    ) {
        parent::__construct($nip, $nama, $gajiPokok);
    }

    // hitungGaji() TIDAK di-override: warisan dari Pegawai sudah mengembalikan
    // gaji pokok apa adanya, itulah yang berlaku untuk pegawai kontrak.

    public function jenis(): string { return 'KONTRAK'; }

    public function getBulanKontrak(): int { return $this->bulanKontrak; }
}