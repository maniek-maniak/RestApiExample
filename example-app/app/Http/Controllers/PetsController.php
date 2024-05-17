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

    public function store(PetsAdd $request)
    {
        $data = [
            "category" => [
                "name" => $request->input('category')
                ],
            "tags" => [[
                "name" => $request->input('tags')
                ]],
            "name" => $request->input('name'),
            "status" => $request->input('status'),
        ];

        $result = $this->apiService->addNewPet($data);
        // ToDo: przydałby się jakiś dymek error/false/true
        if($result->getStatusCode() != 200) {
            return redirect('/pet/add');
        }

        return redirect('/');

    }

    public function show($id)
    {
        $response = $this->apiService->getById($id);
        if($response->getStatusCode() == 404){
            return view('errors/404');
        };

        $pet = $response->getData();
        $categories = $this->categoriesRepository->getCategories();
        $tags = $this->tagsRepository->getTags();
        $statuses = $this->statusesRepository->getStatues();


        return view('pets/edit',
                [
                    "pet" => $pet,
                    "categories" => $categories,
                    "tags" => $tags,
                    "statuses" => $statuses,
                ]);
    }

    public function edit($id, PetsAdd $request) //ToDo: pewnie dla edycji przyda się inna validacja
    {

        $data = [
            "id" => $id,
            "category" => [
                "name" => $request->input('category')
            ],
            "tags" => [[
                "name" => $request->input('tags')
            ]],
            "name" => $request->input('name'),
            "status" => $request->input('status'),
        ];

        $result = $this->apiService->editPet($data);
        // ToDo: przydałby się jakiś dymek error/false/true
        if($result->getStatusCode() != 200) {
            return redirect('pet/show/'.$id);
        }

        return redirect('/');

    }

    public function askToConfirmDestroy($id)
    {
        $pet = $this->apiService->getById($id)->getData();;

        return view('pets/confirmDestroy', ["pet" => $pet]);

    }

    public function destroy($id)
    {
        $result = $this->apiService->deletePet($id);

        // ToDo: przydałby się jakiś dymek error/false/tru
        if($result->getStatusCode() != 200) {
            return redirect('pet/show/'.$id);
        }

        return redirect('/');
    }
}
