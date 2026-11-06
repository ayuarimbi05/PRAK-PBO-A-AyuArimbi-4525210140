<?php

namespace Perpustakaan\Exception;

final class AnggotaTidakDitemukanException extends PerpustakaanException
{
    public function __construct(private readonly string $idAnggota)
    {
        parent::__construct("Anggota dengan ID {$idAnggota} tidak ditemukan.");
    }

    public function getIdAnggota(): string
    {
        return $this->idAnggota;
    }
}
