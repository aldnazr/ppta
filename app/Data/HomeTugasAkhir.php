<?php

namespace App\Data;

class HomeTugasAkhir
{
    public function __construct(
        public string $title,
        public string $student_name,
        public string $student_id,
        public string $pembimbing1,
        public string $pembimbing2,
        public string $sidang_date,
        public string $room,
        public string $time
    ) {}
}
