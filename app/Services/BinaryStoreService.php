<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 2/18/20
 * Time: 8:24 PM
 */

namespace App\Services;


use App\Repositories\BinaryRepository;

class BinaryStoreService
{
    protected $binaryRepository;

    protected $pathData = [];

    protected $path;

    protected $level;

    public function __construct()
    {
        $this->binaryRepository = new BinaryRepository();
    }

    /**
     * get list parent ids
     *
     * @return array
     */
    public function getParentIds()
    {
        return $this->binaryRepository->getParentIds();
    }

    /**
     * store binary in db
     *
     * @param int $parentId
     * @param int $position
     * @return mixed
     */
    public function store(int $parentId, int $position)
    {
        //check if exist with this parent id and on this position
        $exists = $this->binaryRepository->check($parentId, $position);

        if (!$exists) {
            //create binary and get his path
            $binary = $this->binaryRepository->store($parentId, $position);

            $this->getPath($binary->id);
            $this->prepareData($binary->id);
            $this->binaryRepository->update($binary->id, ['path' => $this->path, 'level' => $this->level]);
        }

        return !$exists;
    }

    /**
     * get path for binary
     *
     * @param int $id
     */
    protected function getPath(int $id)
    {
        $binary = $this->binaryRepository->getById($id);

        if ($binary->parent_id) {
            array_push($this->pathData, $binary->parent_id);
            $this->getPath($binary->parent_id);
        }
    }

    /**
     * @param int $id
     */
    protected function prepareData(int $id)
    {
        array_unshift($this->pathData, $id);

        //get binary path and revert
        $reversePath = array_reverse($this->pathData);
        $this->level = count($reversePath);
        $this->path  = implode('.', $reversePath);
    }
} 