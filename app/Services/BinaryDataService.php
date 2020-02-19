<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 2/18/20
 * Time: 11:11 PM
 */

namespace App\Services;


use App\Repositories\BinaryRepository;

class BinaryDataService
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

    /**
     * unset data
     */
    protected function unsetData()
    {
        $this->level = 0;
        $this->path = '';
        $this->pathData = [];
    }

    /**
     * reset db, remove all except root element
     */
    protected function resetData()
    {
        $this->binaryRepository->resetData();
    }
} 