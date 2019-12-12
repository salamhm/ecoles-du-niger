<?php

namespace App\Contracts;

/**
 * Interface InstitutionContract
 * @package App\Contracts
 */
interface InstitutionContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listInstitutions(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findInstitutionById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createInstitution(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateInstitution(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteInstitution($id);
}
