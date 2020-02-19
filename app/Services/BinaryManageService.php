<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 2/18/20
 * Time: 9:35 PM
 */

namespace App\Services;


use App\Repositories\BinaryRepository;

class BinaryManageService extends BinaryDataService
{
    /**
     * reset db, remove all except root element
     *
     */
    public function clearData()
    {
        $this->resetData();
    }

    /**
     * auto generate binary tree
     *
     * @param int $level
     */
    public function autoFill(int $level)
    {
        //reset db, remove all except root element
        $this->clearData();
        //TODO:: pass $level, it is can be done with interface
        $this->addLeftBranch(1, 1, 2, 4);
        $this->addRightBranch(1, 2, 2, 4);
    }

    /**
     * generate left branch
     *
     * @param int $parentId
     * @param int $position
     * @param int $currentLevel
     * @param int $expectedLevel
     */
    protected function addLeftBranch(int $parentId, int $position, int $currentLevel, int $expectedLevel)
    {
        //except 0 parent id and do not start right branch
        if ($parentId && !($parentId == 1 && $position == 2)) {
            $binary = $this->binaryRepository->store($parentId, $position);

            $this->getPath($binary->id);
            $this->prepareData($binary->id);
            $this->binaryRepository->update($binary->id, ['path' => $this->path, 'level' => $this->level]);
            $this->unsetData();

            if ($currentLevel <= $expectedLevel) {
                $this->addLeftBranch($binary->id, $position, ++$currentLevel, $expectedLevel);
            } else {
                //check if we have 2 elements with parent id
                if ($this->binaryRepository->getCountByParent($binary->parent_id) == 2) {
                    $binary = $this->binaryRepository->getById($parentId);
                    $temp = $binary->parent_id;
                } else {
                    $temp = $parentId;
                }

                //start to add element in another side (recursion to top of tree)
                $this->addLeftBranch($temp, 2, ++$currentLevel, $expectedLevel);
            }
        } else
            return false;
    }

    /**
     * generate right branch
     *
     * @param int $parentId
     * @param int $position
     * @param int $currentLevel
     * @param int $expectedLevel
     */
    protected function addRightBranch(int $parentId, int $position, int $currentLevel, $expectedLevel)
    {
        //except 0 parent id and do not start left branch
        if ($parentId && !($parentId == 1 && $position == 1)) {
            $binary = $this->binaryRepository->store($parentId, $position);

            $this->getPath($binary->id);
            $this->prepareData($binary->id);
            $this->binaryRepository->update($binary->id, ['path' => $this->path, 'level' => $this->level]);
            $this->unsetData();

            if ($currentLevel <= $expectedLevel) {
                $this->addRightBranch($binary->id, $position, ++$currentLevel, $expectedLevel);
            } else {
                //check if we have 2 elements with parent id
                if ($this->binaryRepository->getCountByParent($binary->parent_id) == 2) {
                    $binary = $this->binaryRepository->getById($parentId);
                    $temp = $binary->parent_id;
                } else {
                    $temp = $parentId;
                }

                //start to add element in another side (recursion to top of tree)
                $this->addRightBranch($temp, 1, ++$currentLevel, $expectedLevel);
            }
        } else
            return false;
    }

    /**
     * autofill binary tree
     *
     * @param int $level
     */
//    public function _old_autoFill(int $level)
//    {
//        //get max current level and start to fill from him
//        $currentLevel = $this->binaryRepository->getMaxLevel();
//
//        while ($currentLevel <= $level) {
//            //get expected count binaries in this level
//            $expectedCount = pow(2, $currentLevel - 1);
//            $currentCount  = $this->binaryRepository->getCountBinariesByLevel($currentLevel);
//            $parents       = $this->binaryRepository->getByLevel($currentLevel - 1);
//
//            while ($currentCount < $expectedCount) {
//                foreach($parents as $item) {
//                    $exists1 = $this->binaryRepository->check($item->id, 1);
//                    $exists2 = $this->binaryRepository->check($item->id, 2);
//
//                    if (!$exists1) {
//                        $id1 = $this->binaryRepository->store($item->id, 1);
//                        $this->binaryRepository->update($id1->id, ['level' => $currentLevel]);
//                    }
//
//                    if (!$exists2) {
//                        $id2 = $this->binaryRepository->store($item->id, 2);
//                        $this->binaryRepository->update($id2->id, ['level' => $currentLevel]);
//                    }
//                }
//
//                $currentCount  = $this->binaryRepository->getCountBinariesByLevel($currentLevel);
//            }
//
//            $currentLevel++;
//        }
//    }
} 