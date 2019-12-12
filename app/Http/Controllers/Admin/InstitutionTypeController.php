<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\InstitutionTypeContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class InstitutionTypeController extends BaseController
{
    protected $institutionTypeRepository;

    public function __construct(InstitutionTypeContract $institutionTypeRepository)
    {
        $this->institutionTypeRepository = $institutionTypeRepository;
    }

    public function index()
    {
        $institutionTypes = $this->institutionTypeRepository->listInstitutionTypes();

        $this->setPageTitle('Types d\'école', 'Liste des types d\'écoles');
        return view('admin.institution-types.index', compact('institutionTypes'));
    }

    public function create()
    {
        $this->setPageTitle('Types d\'école', 'Ajouter un type d\'école');
        return view('admin.institution-types.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:institution_types',
        ]);
        $params = $request->except('_token');
        $type = $this->institutionTypeRepository->createinstitutionType($params);

        if (!$type) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de l'ajout du type", 'error', true, true);
        }
        return $this->responseRedirect('admin.institution-types.index', 'Type ajouté avec success', 'success', false, false);
    }

    public function edit($id)
    {
        $targetInstitutionType = $this->institutionTypeRepository->findInstitutionTypeById($id);

        $this->setPageTitle('Cycles', 'Modifier un type');
        return view('admin.institution-types.edit', compact('targetInstitutionType'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:institution_types',
        ]);
        $params = $request->except('_token');
        $institutionType = $this->institutionTypeRepository->updateInstitutionType($params);

        if (!$institutionType) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de la modification du type", 'error', true, true);
        }
        return $this->responseRedirect('admin.institution-types.index', 'Type modifié avec success', 'success', false, false);
    }

    public function delete($id)
    {
        $institutionType = $this->institutionTypeRepository->deleteInstitutionType($id);

        if (!$institutionType) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de la suppression du type", 'error', true, true);
        }
        return $this->responseRedirect('admin.institution-types.index', 'Type supprimé avec success', 'success', false, false);
    }
}
