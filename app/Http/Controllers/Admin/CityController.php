<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CityContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CityController extends BaseController
{
    protected $cityRepository;

    public function __construct(CityContract $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function index() {
        $cities = $this->cityRepository->listCities();
        $this->setPageTitle('Villes', 'Liste des villes');
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        $this->setPageTitle('Villes', 'Ajouter une ville');
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:cities',
        ]);

        $params = $request->except('_token');
        $city = $this->cityRepository->createCity($params);

        if(!$city)
        {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de l\'ajout de la ville', 'error', true, true);
        }
        return $this->responseRedirect('admin.cities.index', 'Ville ajoutée avec success', 'success', false, false);
    }

    public function edit($id)
    {
        $targetCity = $this->cityRepository->findCityById($id);
        $this->setPageTitle('Villes', 'Modifier une ville');
        return view('admin.cities.edit', compact('targetCity'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:cities',
        ]);

        $params = $request->except('_token');
        $city = $this->cityRepository->updateCity($params);

        if(!$city)
        {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de la modification de la ville', 'error', true, true);
        }
        return $this->responseRedirect('admin.cities.index', 'Ville modifiée avec success', 'success', false, false);
    }

    public function delete($id)
    {
        $city = $this->cityRepository->deleteCity($id);

        if(!$city)
        {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de la suppression de la ville', 'error', true, true);
        }
        return $this->responseRedirect('admin.cities.index', 'Ville supprimée avec success', 'success', false, false);

    }
}
