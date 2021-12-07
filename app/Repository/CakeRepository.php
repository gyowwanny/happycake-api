<?php

namespace App\Repository;

use App\Http\Resources\CakeCollection;
use App\Http\Resources\CakeResource;
use App\Interfaces\CakeEmailRepositoryInterface;
use App\Interfaces\CakeRepositoryInterface;
use App\Mail\CakeMail;
use App\Models\Cake;
use Illuminate\Support\Facades\Mail;

class CakeRepository implements CakeRepositoryInterface
{

    private CakeEmailRepositoryInterface $cakeEmailRepository;

    public function __construct(CakeEmailRepositoryInterface $cakeEmailRepository)
    {
        $this->cakeEmailRepository = $cakeEmailRepository;
    }

    /**
     * @return mixed
     */
    public function getAllCakes($itemsPerPage = 15, $page = 1)
    {
        return CakeResource::collection(Cake::query()->paginate($itemsPerPage, ['*'], 'page', $page));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCakeById($id)
    {
        return new CakeResource(Cake::findOrFail($id));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteCake($id)
    {
        Cake::destroy($id);
    }

    /**
     * @param array $cakeDetails
     * @return mixed
     */
    public function createCakeWithEmails(array $cakeDetails)
    {
        $cake = Cake::create($cakeDetails);
        $emails = $cakeDetails['emails'] ?? false;

        if ($emails) {
            $this->cakeEmailRepository->createMassCakeEmail($emails, $cake);
            $this->sendMail($emails, $cake);
        }

        return $cake;
    }

    /**
     * @param array $emails
     * @param Cake $cake
     * @return void
     */
    public function sendMail(array $emails, Cake $cake)
    {
        foreach ($emails as $email) {
            Mail::to($email)->queue(new CakeMail($cake));
        }
    }

    /**
     * @param $id
     * @param array $newDetails
     * @return mixed
     */
    public function updateCake($id, array $newDetails)
    {
        return Cake::whereId($id)->update($newDetails);
    }
}
