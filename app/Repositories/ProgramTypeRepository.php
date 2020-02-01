<?php

namespace App\Repositories;

use App\Contracts\ProgramTypeContract;
use App\Models\ProgramType;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class ProgramTypeRepository extends BaseRepository implements ProgramTypeContract
{
    protected $model;

    public function __construct(ProgramType $programType)
    {
        $this->model = $programType;
    }

    public function listProgramTypes(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all(['*'], 'id', 'asc');
    }

    public function findProgramTypeById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function createProgramType(array $params)
    {
        try {
            $programType = new ProgramType($params);
            $programType->save();
            return $programType;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e);
        }
    }

    public function updateProgramType(array $params)
    {
        $programType = $this->findProgramTypeById($params['id']);
        $programType->update($params);
        return $programType;
    }

    public function deleteProgramType($id)
    {
        $programType = $this->findProgramTypeById($id);
        $programType->delete();
        return $programType;
    }
}
