<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 2/18/20
 * Time: 8:22 PM
 */

namespace App\Repositories;


use App\Binary;

class BinaryRepository
{
    /**
     * @return array
     */
    public function getParentIds()
    {
        return Binary::all()->pluck('id', 'id')->toArray();
    }

    /**
     * @param int $parentId
     * @param int $position
     * @return mixed
     */
    public function check(int $parentId, int $position)
    {
        return Binary::where([
            ['parent_id', $parentId],
            ['position', $position]
        ])->exists();
    }

    /**
     * @param int $parentId
     * @param int $position
     * @return mixed
     */
    public function store(int $parentId, int $position)
    {
        return Binary::create([
            'parent_id' => $parentId,
            'position'  => $position
        ]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return Binary::find($id);
    }

    /**
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data)
    {
        Binary::where('id', $id)->update($data);
    }


    /*
     * @return Binary
     */
    public function getMaxLevel()
    {
        return Binary::max('level');
    }

    /**
     * @param int $level
     * @return mixed
     */
    public function getByLevel(int $level)
    {
        return Binary::where('level', $level)->get();
    }

    /**
     * @param int $level
     * @return mixed
     */
    public function getCountBinariesByLevel(int $level)
    {
        return Binary::where('level', $level)->count();
    }

    /**
     * @param int $parentId
     * @return mixed
     */
    public function getCountByParent(int $parentId)
    {
        return Binary::where('parent_id', $parentId)->count();
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return Binary::all()->count();
    }

    /**
     * reset db, remove all except root element
     *
     */
    public function resetData()
    {
        Binary::where('id', '<>', '1')->delete();
    }
} 