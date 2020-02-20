<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 2/20/20
 * Time: 9:45 AM
 */

namespace App\Interfaces;


interface BinaryBranch
{
    /**
     * generate left branch
     *
     * @param $parentId
     * @param $position
     * @param $currentLevel
     * @param $expectedLevel
     * @return mixed
     */
    public function addLeftBranch($parentId, $position, $currentLevel, $expectedLevel);

    /**
     * generate right branch
     *
     * @param $parentId
     * @param $position
     * @param $currentLevel
     * @param $expectedLevel
     * @return mixed
     */
    public function addRightBranch($parentId, $position, $currentLevel, $expectedLevel);
} 