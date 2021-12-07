<?php

namespace App\Interfaces;


interface CakeRepositoryInterface
{
    public function getAllCakes($itemsPerPage, $page);

    public function getCakeById($id);

    public function deleteCake($id);

    public function createCakeWithEmails(array $cakeDetails);

    public function updateCake($id, array $newDetails);
}
