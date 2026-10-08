<?php
declare(strict_types=1);

// ══ INTERFACE — kontrak "apa yang bisa dilakukan" ═══════════════
interface Movable
{
    public function bergerak(): void;
    public function kecepatanMaksimum(): float;
}

interface Fuelable
{
    public function isiBahanBakar(float $jumlah): void;
    public function kapasitasTangki(): float;
    public function tipeBahanBakar(): TipeBahanBakar;
}

// ══ ENUM (PHP 8.1+) — backed enum, punya nilai string ══════════
enum TipeBahanBakar: string
{
    case Bensin  = 'bensin';
    case Solar   = 'solar';
    case Listrik = 'listrik';

    public function label(): string
    {
        return match ($this) {
            self::Bensin => 'Bensin',
            self::Solar => 'Solar',
            self::Listrik => 'Listrik',
        };
    }

    public function hargaPerSatuan(): float
    {
        return match ($this) {
            self::Bensin => 12000,
            self::Solar => 10500,
            self::Listrik => 2500,
        };
    }

    /** TODO 4 */
    public function biayaPengisian(float $jumlah): float
    {
        return $jumlah * $this->hargaPerSatuan();
    }

    /** TODO 5: hanya Listrik yang ramah lingkungan. */
    public function ramahLingkungan(): bool
    {
        return $this === self::Listrik;
    }
}

// ══ TRAIT — penggunaan ulang horizontal, khas PHP ══════════════
trait Loggable
{
    /**
     * Cetak baris log dengan format:
     * [14:32:05] Mobil: servis berkala selesai
     */
    public function log(string $pesan): void
    {
        echo '[' . date('H:i:s') . '] ' . static::class . ': ' . $pesan . PHP_EOL;
    }
}

// ══ ABSTRACT CLASS — kode yang benar-benar sama ═══════════════
abstract class Kendaraan
{
    public function __construct(
        protected readonly string $merek,
        protected readonly int    $tahun,
    ) {}

    /** TODO 7: umur kendaraan, tidak boleh negatif. */
    public function umur(int $tahunSekarang): int
    {
        if ($tahunSekarang < $this->tahun) {
            return 0;
        }

        return $tahunSekarang - $this->tahun;
    }

    abstract public function jumlahRoda(): int;

    public function __toString(): string
    {
        return sprintf('%s (%d, %d roda)', $this->merek, $this->tahun, $this->jumlahRoda());
    }
}

final class Mobil extends Kendaraan implements Movable, Fuelable
{
    use Loggable;                       // trait disisipkan

    private float $isiTangki = 0;

    public function __construct(string $merek, int $tahun, private readonly float $kapasitas)
    {
        parent::__construct($merek, $tahun);
    }

    public function jumlahRoda(): int { return 4; }

    // TODO 8: lengkapi kontrak Movable dan Fuelable.
    public function bergerak(): void
    {
        $this->log('mobil sedang bergerak');
    }

    public function kecepatanMaksimum(): float { return 180; }

    public function isiBahanBakar(float $jumlah): void
    {
        if ($jumlah < 0) {
            throw new InvalidArgumentException('Jumlah bahan bakar tidak boleh negatif.');
        }

        $this->isiTangki = min($this->kapasitas, $this->isiTangki + $jumlah);
    }

    public function kapasitasTangki(): float { return $this->kapasitas; }
    public function tipeBahanBakar(): TipeBahanBakar { return TipeBahanBakar::Bensin; }
    public function getIsiTangki(): float { return $this->isiTangki; }
}

// TODO Langkah 4: buat Sepeda — extends Kendaraan implements Movable,
//                 TETAPI BUKAN Fuelable.
final class Sepeda extends Kendaraan implements Movable
{
    use Loggable;

    public function jumlahRoda(): int { return 2; }

    public function bergerak(): void
    {
        $this->log('sepeda sedang dikayuh');
    }

    public function kecepatanMaksimum(): float { return 30; }
}

/**
 * TODO Langkah 5: buat kelas Pesanan yang juga memakai trait Loggable.
 * Kelas ini sama sekali bukan kerabat Kendaraan — itulah maksud
 * "penggunaan ulang horizontal".
 */
final class Pesanan
{
    use Loggable;

    public function __construct(
        private readonly string $kode,
        private readonly float $total,
    ) {}

    public function total(): float { return $this->total; }

    public function kirim(): void
    {
        $this->log("pesanan {$this->kode} dikirim");
    }
}
