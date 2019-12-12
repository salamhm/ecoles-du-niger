<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\LevelContract;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LevelController extends BaseController
{
    protected $levelRepository;

    public function __construct(LevelContract $levelRepository)
    {
        $this->levelRepository = $levelRepository;
    }

    public function index()
    {
        $levels = $this->levelRepository->listLevels();

        $this->setPageTitle('Cycles', 'Liste des cycles');
        return view('admin.levels.index', compact('levels'));
    }

    public function create()
    {
        $this->setPageTitle('Cycles', 'Ajouter un cycle');
        return view('admin.levels.create');   
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:levels',
        ]);
        $params = $request->except('_token');
        $level = $this->levelRepository->createLevel($params);

        if(!$level){
            return $this->responseRedirectBack("Une erreur s'est produite lors de l'ajout du cycle", 'error', true, true);
        }
        return $this->responseRedirect('admin.levels.index', 'Cycle ajouté avec success', 'success', false, false);        
    }

    public function edit($id)
    {
        $targetLevel = $this->levelRepository->findLevelById($id);

        $this->setPageTitle('Cycles', 'Modifier un cycle');
        return view('admin.levels.edit', compact('targetLevel'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191|unique:levels',
        ]);
        $params = $request->except('_token');
        $level = $this->levelRepository->updateLevel($params);

        if(!$level){
            return $this->responseRedirectBack("Une erreur s'est produite lors de la modification du cycle", 'error', true, true);
        }
        return $this->responseRedirect('admin.levels.index', 'Cycle modifié avec success', 'success', false, false);  
    }

    public function delete($id)
    {
        $level = $this->levelRepository->deleteLevel($id);

        if(!$level){
            return $this->responseRedirectBack("Une erreur s'est produite lors de la suppression du cycle", 'error', true, true);
        }
        return $this->responseRedirect('admin.levels.index', 'Cycle supprimé avec success', 'success', false, false);
    }
}
