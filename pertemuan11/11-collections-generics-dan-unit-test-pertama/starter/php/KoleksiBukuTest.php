
<?php
declare(strict_types=1);

namespace Perpustakaan\Model;

use Countable;
use IteratorAggregate;
use ArrayIterator;
use Traversable;

class KoleksiBuku implements Countable, IteratorAggregate
{
    private array $items = [];

    public function simpan(Buku $b): void
    {
        $this->items[$b->getIsbn()] = $b;
    }

    public function cariByIsbn(string $isbn): ?Buku
    {
        return $this->items[$isbn] ?? null;
    }

    public function hapus(string $isbn): void
    {
        unset($this->items[$isbn]);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function filter(callable $predikat): self
    {
        $hasil = new self();

        foreach ($this->items as $buku) {
            if ($predikat($buku)) {
                $hasil->simpan($buku);
            }
        }

        return $hasil;
    }

    public function jumlahkan(callable $penghitung): float
    {
        $total = 0;

        foreach ($this->items as $buku) {
            $total += $penghitung($buku);
        }

        return $total;
    }
}
