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
            $institutionType = new InstitutionType($params);
            $institutionType->save();
            return $institutionType;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e);
        }
    }

    public function updateInstitutionType(array $params)
    {
        $institutionType = $this->findInstitutionTypeById($params['id']);
        $institutionType->update($params);
        return $institutionType;
    }

    public function deleteInstitutionType($id)
    {
        $institutionType = $this->findInstitutionTypeById($id);
        $institutionType->delete();
        return $institutionType;
    }
}
