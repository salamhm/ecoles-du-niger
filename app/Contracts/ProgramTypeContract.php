<?php

namespace App\Contracts;

/**
 * Interface ProgramTypeContract
 * @package App\Contracts
 */
interface ProgramTypeContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listProgramTypes(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findProgramTypeById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createProgramType(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateProgramType(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteProgramType($id);
}
