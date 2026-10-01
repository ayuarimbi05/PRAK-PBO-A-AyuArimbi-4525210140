<?php
declare(strict_types=1);

abstract class BangunDatar
{
    public function __construct(private readonly string $nama) {}

    abstract public function luas(): float;
    abstract public function keliling(): float;

    public function getNama(): string { return $this->nama; }

    public function __toString(): string
    {
        return sprintf('%-12s luas=%10.2f  keliling=%10.2f',
            $this->nama, $this->luas(), $this->keliling());
    }
}

class Lingkaran extends BangunDatar
{
    public function __construct(private readonly float $jariJari)
    {
        if ($jariJari <= 0) {
            throw new InvalidArgumentException('Jari-jari harus lebih dari nol.');
        }

        parent::__construct('Lingkaran');
        // TODO 1: tolak jari-jari <= 0.
    }

    public function luas(): float
    {
        return M_PI * $this->jariJari * $this->jariJari;
    }

    public function keliling(): float
    {
        return 2 * M_PI * $this->jariJari;
    }

    public function getJariJari(): float { return $this->jariJari; }
}

class Persegi extends BangunDatar
{
    public function __construct(private readonly float $sisi)
    {
        if ($sisi <= 0) {
            throw new InvalidArgumentException('Sisi harus lebih dari nol.');
        }

        parent::__construct('Persegi');
    }

    public function luas(): float
    {
        return $this->sisi * $this->sisi;
    }

    public function keliling(): float
    {
        return 4 * $this->sisi;
    }
}

class Segitiga extends BangunDatar
{
    public function __construct(
        private readonly float $sisiA,
        private readonly float $sisiB,
        private readonly float $sisiC,
    ) {
        if ($sisiA <= 0 || $sisiB <= 0 || $sisiC <= 0
            || $sisiA + $sisiB <= $sisiC
            || $sisiA + $sisiC <= $sisiB
            || $sisiB + $sisiC <= $sisiA) {
            throw new InvalidArgumentException('Ketiga sisi tidak membentuk segitiga yang valid.');
        }

        parent::__construct('Segitiga');
    }

    public function luas(): float
    {
        $s = $this->keliling() / 2;
        return sqrt($s * ($s - $this->sisiA) * ($s - $this->sisiB) * ($s - $this->sisiC));
    }

    public function keliling(): float
    {
        return $this->sisiA + $this->sisiB + $this->sisiC;
    }
}

class Trapesium extends BangunDatar
{
    public function __construct(
        private readonly float $sisiAtas,
        private readonly float $sisiBawah,
        private readonly float $tinggi,
        private readonly float $sisiKiri,
        private readonly float $sisiKanan,
    ) {
        if ($sisiAtas <= 0 || $sisiBawah <= 0 || $tinggi <= 0
            || $sisiKiri <= 0 || $sisiKanan <= 0) {
            throw new InvalidArgumentException('Semua ukuran trapesium harus lebih dari nol.');
        }

        parent::__construct('Trapesium');
    }

    public function luas(): float
    {
        return (($this->sisiAtas + $this->sisiBawah) * $this->tinggi) / 2;
    }

    public function keliling(): float
    {
        return $this->sisiAtas + $this->sisiBawah
            + $this->sisiKiri + $this->sisiKanan;
    }
}
