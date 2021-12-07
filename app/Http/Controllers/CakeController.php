<?php

namespace App\Http\Controllers;

use App\Http\Requests\CakeIndexRequest;
use App\Http\Requests\DestroyCakeRequest;
use App\Http\Requests\ShowCakeRequest;
use App\Http\Requests\StoreCakeRequest;
use App\Http\Requests\UpdateCakeRequest;
use App\Interfaces\CakeEmailRepositoryInterface;
use App\Interfaces\CakeRepositoryInterface;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CakeController extends Controller
{

    protected CakeRepositoryInterface $cakeRepository;
    protected CakeEmailRepositoryInterface $cakeEmailRepository;

    public function __construct(CakeRepositoryInterface $cakeRepository, CakeEmailRepositoryInterface $cakeEmailRepository)
    {
        $this->cakeRepository = $cakeRepository;
        $this->cakeEmailRepository = $cakeEmailRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(CakeIndexRequest $request)
    {
        return $this->cakeRepository->getAllCakes($request->per_page, $request->page);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCakeRequest $request
     * @return JsonResponse
     */
    public function store(StoreCakeRequest $request): JsonResponse
    {
        $cakeInputs = $request->only([
            'name',
            'weight',
            'value',
            'amount_available',
            'emails'
        ]);

        return response()->json([
            'data' => $this->cakeRepository->createCakeWithEmails($cakeInputs)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(ShowCakeRequest $request): JsonResponse
    {
        $cakeId = $request->route('id');

        return response()->json([
            'data' => $this->cakeRepository->getCakeById($cakeId)
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCakeRequest $request
     * @return JsonResponse
     */
    public function update(UpdateCakeRequest $request): JsonResponse
    {
        $cakeId = $request->route('id');
        $cakeNew = $request->only([
            'name',
            'weight',
            'value',
            'amount_available'
        ]);

        return response()->json([
            'data' => $this->cakeRepository->updateCake($cakeId, $cakeNew)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(DestroyCakeRequest $request): JsonResponse
    {
        $cakeId = $request->route('id');
        $this->cakeRepository->deleteCake($cakeId);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

}
