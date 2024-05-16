<?php

namespace App\Http\Controllers;

use App\Repositories\Pets\StatusesRepository;
use App\Repositories\Pets\TagsRepository;
use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Http\Requests\PetsAdd;
use App\Repositories\Pets\CategoriesRepository;

class PetsController extends Controller
{
    public function __construct(
        ApiService                    $apiService,
        CategoriesRepository          $categoriesRepository,
        StatusesRepository            $statusesRepository,
        TagsRepository                $tagsRepository
    )
    {
        $this->apiService =           $apiService;
        $this->categoriesRepository = $categoriesRepository;
        $this->statusesRepository =   $statusesRepository;
        $this->tagsRepository =       $tagsRepository;
    }


    public function index ()
    {
        $availablePets = $this->apiService->getByStatusAvailable()->getData();
        $availablePetsCollection = collect($availablePets)->sortBy('id');
        $pets = $availablePetsCollection->take('25'); // ToDo: paginacja tu lub w widoku

        return view('pets/all', ["pets" => $pets]);
    }

    public function add()
    {
        $categories = $this->categoriesRepository->getCategories();
        $tags = $this->tagsRepository->getTags();
        $statuses = $this->statusesRepository->getStatues();

        return view('pets/create',
        [
            "categories" => $categories,
            "tags" => $tags,
            "statuses" => $statuses,
        ]);
    }
}
