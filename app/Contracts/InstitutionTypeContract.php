<?php

namespace App\Contracts;

/**
 * Interface InstitutionTypeContract
 * @package App\Contracts
 */
interface InstitutionTypeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listInstitutionTypes(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findInstitutionTypeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createInstitutionType(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateInstitutionType(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteInstitutionType($id);
}
