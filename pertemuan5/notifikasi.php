<?php
declare(strict_types=1);

/**
 * Langkah 6 — latihan mandiri.
 *
 * Buat hierarki Notifikasi dengan tiga turunan: Email, SMS, WhatsApp.
 * Lalu lengkapi kirimSemua() TANPA satu pun pemeriksaan tipe.
 */

abstract class Notifikasi
{
    public function __construct(public readonly string $tujuan)
    {
    }

    abstract public function kirim(string $pesan): void;

    public function saluran(): string
    {
        return static::class;
    }
}


class Email extends Notifikasi
{
    public function kirim(string $pesan): void
    {
        echo "Email ke {$this->tujuan}: {$pesan}" . PHP_EOL;
    }
}

class SMS extends Notifikasi
{
    public function kirim(string $pesan): void
    {
        echo "SMS ke {$this->tujuan}: {$pesan}" . PHP_EOL;
    }
}

class WhatsApp extends Notifikasi
{
    public function kirim(string $pesan): void
    {
        echo "WhatsApp ke {$this->tujuan}: {$pesan}" . PHP_EOL;
    }
}


/**
 * Mengirim pesan ke seluruh notifikasi dalam daftar melalui polimorfisme.
 *
 * ATURAN: tidak boleh ada instanceof, tidak boleh ada match/switch
 *         atas jenis notifikasi. Kalau Anda merasa membutuhkannya,
 *         berarti hierarki Anda belum benar.
 *
 * @param Notifikasi[] $daftar
 */
function kirimSemua(array $daftar, string $pesan): void
{
    foreach ($daftar as $notifikasi) {
        $notifikasi->kirim($pesan);
    }
}


$email = new Email("ayu@gmail.com");
$email->kirim("Halo, ini pesan percobaan!");


// Uji setelah TODO 1-3 selesai:
// kirimSemua([
//     new Email('ani@univpancasila.ac.id'),
//     new SMS('081234567890'),
//     new WhatsApp('081234567890'),
// ], 'Buku yang Anda pesan sudah tersedia.');
