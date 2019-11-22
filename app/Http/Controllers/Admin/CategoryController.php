<?php

namespace App\Http\Controllers\Admin;

use App\Contracts\CategoryContract;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryRepository;

    public function __construct(CategoryContract $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;   
    }

    public function index()
    {
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Catégories', 'Liste des catégories');
        return view('admin.categories.index', compact('categories'));
        
    }

    public function create()
    {
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Catégories', 'Créer une catégorie');
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191|unique:categories',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');
        $category = $this->categoryRepository->createCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de l\'ajout', 'error', true, true);
        }

        return $this->responseRedirect('admin.categories.index', 'Catégorie ajouté avec succèss', 'success', false, false);
    }

    public function edit($id)
    {
        $targetCategory = $this->categoryRepository->findCategoryById($id);
        $categories = $this->categoryRepository->listCategories();

        $this->setPageTitle('Catégories', 'Modifier une catégorie');
        return view('admin.categories.edit', compact('targetCategory', 'categories'));
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|max:191',
            'parent_id' =>  'required|not_in:0',
            'image'     =>  'mimes:jpg,jpeg,png|max:1000'
        ]);

        $params = $request->except('_token');

        $category = $this->categoryRepository->updateCategory($params);

        if (!$category) {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de la modification', 'error', true, true);
        }

        return $this->responseRedirect('admin.categories.index', 'Catégorie modifiée avec succèss', 'success', false, false);        
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->deleteCategory($id);
    
        if (!$category) {
            return $this->responseRedirectBack('Une erreur s\'est produite lors de la suppression', 'error', true, true);
        }
        return $this->responseRedirect('admin.categories.index', 'Catégorie supprimée avec succèss' ,'success',false, false);
    }

}
