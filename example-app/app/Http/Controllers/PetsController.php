<?php

namespace App\Http\Controllers;

use App\Repositories\Pets\StatusesRepository;
use App\Repositories\Pets\TagsRepository;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Http\Requests\PetsAdd;
use App\Repositories\Pets\CactegoriesRepository;

class PetsController extends Controller
{
    public function __construct(
        ApiService                    $apiService
    )
    {
        $this->apiService =           $apiService;
    }


    public function index ()
    {
        $availablePets = $this->apiService->getByStatusAvailable()->getData();
        $availablePetsCollection = collect($availablePets)->sortBy('id');
        $pets = $availablePetsCollection->take('25'); // ToDo: poginacja tu lub w widoku

        return view('pets/all', ["pets" => $pets]);
    }
}
