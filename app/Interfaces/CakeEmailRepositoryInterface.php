<?php

namespace App\Interfaces;

use App\Models\Cake;

interface CakeEmailRepositoryInterface
{
    public function createMassCakeEmail(array $emails, Cake $cake);
}
