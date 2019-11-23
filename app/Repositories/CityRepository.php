<?php

namespace App\Repositories;

use App\Contracts\CityContract;
use App\Models\City;
use App\Repositories\BaseRepository;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class CityRepository extends BaseRepository implements CityContract
{
    protected $model;

    public function __construct(City $city)
    {
        $this->model = $city;
    }

    public function listCities(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all(['*'], 'id', 'asc');
    }
    
    public function findCityById(int $id)
    {
        try{
            return $this->findOneOrFail($id);
        } catch(ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function createCity(array $params)
    {
        try {
            $city = new City($params);
            $city->save();
            return $city;
        } catch(QueryException $e) {
            throw new InvalidArgumentException($e);
        }
    }

    public function updateCity(array $params)
    {
        $city = $this->findCityById($params['id']);
        $city->update($params);
        return $city;
    }

    public function deleteCity($id)
    {
        $city = $this->findCityById($id);
        $city->delete();
        return $city;
    }
}