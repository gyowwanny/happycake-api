<?php


namespace App\Repository;


use App\Interfaces\CakeEmailRepositoryInterface;
use App\Models\CakeEmail;

class CakeEmailRepository implements CakeEmailRepositoryInterface
{

    /**
     * @param array $emails
     * @param $cake
     * @return void
     */
    public function createMassCakeEmail(array $emails, $cake)
    {
        $cakeId = $cake->id;

        foreach ($emails as $email) {
            $emailDetails = [
                'email' => $email,
                'cake_id' => $cakeId
            ];

            CakeEmail::create($emailDetails);
        }
    }
}
