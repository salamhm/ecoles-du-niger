<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CityContract;
use App\Contracts\InstitutionContract;
use App\Contracts\InstitutionTypeContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class InstitutionController extends BaseController
{
    protected $institutionTypeRepository;
    protected $institutionRepository;
    protected $cityRepository;

    public function __construct(
        InstitutionContract $institutionRepository,
        InstitutionTypeContract $institutionTypeRepository,
        CityContract $cityRepository
        )
    {
        $this->institutionRepository = $institutionRepository;
        $this->institutionTypeRepository = $institutionTypeRepository;
        $this->cityRepository = $cityRepository;
    }

    public function index()
    {
        $institutions = $this->institutionRepository->listInstitutions();

        $this->setPageTitle('Ecoles', 'Liste des écoles');
        return view('admin.institutions.index', compact('institutions'));
    }

    public function create()
    {
        $cities = $this->cityRepository->listCities();
        $institutionTypes = $this->institutionTypeRepository->listInstitutionTypes();
        
        $this->setPageTitle('Ecoles', 'Ajouter une école');
        return view('admin.institutions.create', compact('cities', 'institutionTypes'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:institutions',
            'logo' => 'image|mimes:jpg,jpeg,png|max:500',
            'initials' => 'nullable|string',
            'institution_type_id' => 'required|integer|not_in:0',
            'city_id' => 'required|integer|not_in:0',
            'address' => 'string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'presentation' => 'nullable'
        ]);

        $params = $request->except('_token');
        $institution = $this->institutionRepository->createInstitution($params);

        if (!$institution) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de l'ajout de l'école ", 'error', true, true);
        }
        return $this->responseRedirect('admin.institutions.index', 'Ecole ajoutée avec success', 'success', false, false);
    }

    public function edit($id)
    {
        $targetInstitution = $this->institutionRepository->findInstitutionById($id);
        $cities = $this->cityRepository->listCities();
        $institutionTypes = $this->institutionTypeRepository->listInstitutionTypes();

        $this->setPageTitle('Ecoles', 'Modifier une école');
        return view('admin.institutions.edit', compact('targetInstitution', 'cities', 'institutionTypes'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'logo' => 'image|mimes:jpg,jpeg,png|max:500',
            'initials' => 'nullable|string',
            'institution_type_id' => 'required|integer|not_in:0',
            'city_id' => 'required|integer|not_in:0',
            'address' => 'string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'email' => 'nullable|email',
            'website' => 'nullable|url',
            'presentation' => 'nullable|'
        ]);

        $params = $request->except('_token');
        $institution = $this->institutionRepository->updateInstitution($params);

        if (!$institution) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de la modification de l'école ", 'error', true, true);
        }
        return $this->responseRedirect('admin.institutions.index', 'Ecole modifiée avec success', 'success', false, false);
    }

    public function delete($id)
    {
        $institution = $this->institutionRepository->deleteInstitution($id);

        if (!$institution) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de la suppression de l'école ", 'error', true, true);
        }
        return $this->responseRedirect('admin.institutions.index', 'Ecole supprimée avec success', 'success', false, false);
    }
}
