<?php

namespace App\Contracts;

/**
 * Interface LevelContract
 * @package App\Contracts
 */
interface LevelContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array $columns
     * @return mixed
     */
    public function listLevels(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findLevelById(int $id);

    /**
     * @param array $params
     * @return mixed
     */
    public function createLevel(array $params);

    /**
     * @param array $params
     * @return mixed
     */
    public function updateLevel(array $params);

    /**
     * @param $id
     * @return bool
     */
    public function deleteLevel($id);
}