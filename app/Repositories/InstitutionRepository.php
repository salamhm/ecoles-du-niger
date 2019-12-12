<?php

namespace App\Repositories;

use App\Contracts\InstitutionContract;
use App\Models\Institution;
use App\Traits\UploadAble;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Rules\In;

class InstitutionRepository extends BaseRepository implements InstitutionContract
{
    protected $model;

    use UploadAble;

    public function __construct(Institution $institution)
    {
        $this->model = $institution;
    }

    public function listInstitutions(string $order = 'id', string $sort = 'desc', array $columns = ['*'])
    {
        return $this->all(['*'], 'id', 'asc');
    }

    public function findInstitutionById(int $id)
    {
        try {
            return $this->findOneOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ModelNotFoundException($e);
        }
    }

    public function createInstitution(array $params)
    {
        try {
            $collection = collect($params);
            $logo = null;
            if ($collection->has('logo') && ($params['logo'] instanceof UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], $params['name'] . '/logo');
            }
            $merged = $collection->merge(compact('logo'));
            $institution = new Institution($merged->all());
            $institution->save();
            return $institution;
        } catch (QueryException $e) {
            throw new InvalidArgumentException($e);
        }
    }

    public function updateInstitution(array $params)
    {
        $institution = $this->findInstitutionById($params['id']);
        $logo = $institution->logo;
        $collection = collect($params);
        if ($collection->has('logo') && ($params['logo'] instanceof UploadedFile)) {
            if ($logo != null) {
                $this->deleteOne($logo);
            }
            $this->uploadOne($params['logo'], $params['name'] . '/logo');
        }
        $merged = $collection->merge(compact('logo'));
        $institution->update($merged->all());

        return $institution;
    }

    public function deleteInstitution($id)
    {
        $institution = $this->findInstitutionById($id);
        $institution->delete();
        return $institution;
    }
}
