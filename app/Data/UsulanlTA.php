<?php

namespace App\Data;

class UsulanlTA
{
    // public string $judul;
    // public string $pengusul;
    // public string $deskripsi;

    // public function __construct(string $judul, string $pengusul, string $deskripsi)
    // {
    //     $this->judul = $judul;
    //     $this->pengusul = $pengusul;
    //     $this->deskripsi = $deskripsi;
    // }

    public function __construct(
        public string $judul,
        public string $pengusul,
        public string $deskripsi
    ) {}
}
