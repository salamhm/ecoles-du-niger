<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\ProgramTypeContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class ProgramTypeController extends BaseController
{
    protected $programTypeRepository;

    public function __construct(ProgramTypeContract $programTypeRepository)
    {
        $this->programTypeRepository = $programTypeRepository;
    }

    public function index()
    {
        $programTypes = $this->programTypeRepository->listProgramTypes();

        $this->setPageTitle('Types de formation', 'Liste des types de formation');
        return view('admin.program-types.index', compact('programTypes'));
    }

    public function create()
    {
        $this->setPageTitle('Types de formation', 'Ajouter un type de formation');
        return view('admin.program-types.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:institution_types',
        ]);
        $params = $request->except('_token');
        $type = $this->programTypeRepository->createProgramType($params);

        if (!$type) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de l'ajout du type", 'error', true, true);
        }
        return $this->responseRedirect('admin.program-types.index', 'Type ajouté avec success', 'success', false, false);
    }

    public function edit($id)
    {
        $targetProgramType = $this->programTypeRepository->findProgramTypeById($id);

        $this->setPageTitle('Types de formation', 'Modifier un type');
        return view('admin.program-types.edit', compact('targetProgramType'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:institution_types',
        ]);
        $params = $request->except('_token');
        $ProgramType = $this->programTypeRepository->updateProgramType($params);

        if (!$ProgramType) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de la modification du type", 'error', true, true);
        }
        return $this->responseRedirect('admin.program-types.index', 'Type modifié avec success', 'success', false, false);
    }

    public function delete($id)
    {
        $ProgramType = $this->programTypeRepository->deleteProgramType($id);

        if (!$ProgramType) {
            return $this->responseRedirectBack("Une erreur s'est produite lors de la suppression du type", 'error', true, true);
        }
        return $this->responseRedirect('admin.program-types.index', 'Type supprimé avec success', 'success', false, false);
    }
}
