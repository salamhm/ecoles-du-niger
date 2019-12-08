<?php

namespace App\Repositories;

use App\Contracts\InstitutionTypeContract;
use App\Models\InstitutionType;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class InstitutionTypeRepository extends BaseRepository implements InstitutionTypeContract
{
    protected $model;

    public function __construct(InstitutionType $institutionType)
    {
        $this->model = $institutionType;
    }

    public function listInstitutionTypes(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all(['*'], 'id', 'asc');
    }

    public function findInstitutionTypeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function createInstitutionType(array $params)
    {
        try {
            $InstitutionType = new InstitutionType($params);
            $InstitutionType->save();
            return $InstitutionType;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e);
        }
    }

    public function updateInstitutionType(array $params)
    {
        $InstitutionType = $this->findInstitutionTypeById($params['id']);
        $InstitutionType->update($params);
        return $InstitutionType;
    }

    public function deleteInstitutionType($id)
    {
        $InstitutionType = $this->findInstitutionTypeById($id);
        $InstitutionType->delete();
        return $InstitutionType;
    }
}
