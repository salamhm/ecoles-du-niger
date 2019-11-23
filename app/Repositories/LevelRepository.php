<?php

namespace App\Repositories;

use App\Contracts\LevelContract;
use App\Models\Level;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class LevelRepository extends BaseRepository implements LevelContract
{
    protected $model;

    public function __construct(Level $level)
    {
        $this->model = $level;
    }

    public function listLevels(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all(['*'], 'id', 'asc');
    }

    public function findLevelById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function createLevel(array $params)
    {
        try {
            $level = new Level($params);
            $level->save();
            return $level;
        } catch(QueryException $e) {
            throw new InvalidArgumentException($e);
        }
    }

    public function updateLevel(array $params)
    {
        $level = $this->findLevelById($params['id']);
        $level->update($params);
        return $level;
    }

    public function deleteLevel($id)
    {
        $level = $this->findLevelById($id);
        $level->delete();
        return $level;
    }
}