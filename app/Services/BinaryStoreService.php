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

    protected $path = [];

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

            array_unshift($this->path, $binary->id);

            //get binary path and revert
            $reversePath = array_reverse($this->path);
            $level       = count($reversePath);
            $path        = implode('.', $reversePath);

            $this->binaryRepository->update($binary->id, ['path' => $path, 'level' => $level]);
        }

        return !$exists;
    }

    /**
     * get path for binary
     *
     * @param $id
     */
    protected function getPath($id)
    {
        $binary = $this->binaryRepository->getById($id);

        if ($binary->parent_id) {
            array_push($this->path, $binary->parent_id);
            $this->getPath($binary->parent_id);
        }
    }
} 