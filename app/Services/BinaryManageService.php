<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 2/18/20
 * Time: 9:35 PM
 */

namespace App\Services;


use App\Repositories\BinaryRepository;

class BinaryManageService
{
    protected $binaryRepository;

    public function __construct()
    {
        $this->binaryRepository = new BinaryRepository();
    }

    /**
     * autofill binary tree
     *
     * @param int $level
     */
    public function autoFill(int $level)
    {
        //get max current level and start to fill from him
        $currentLevel = $this->binaryRepository->getMaxLevel();

        while ($currentLevel <= $level) {
            //get count binaries in this level
            $expectedCount = pow(2, $currentLevel - 1);
            $currentCount  = $this->binaryRepository->getCountBinariesByLevel($currentLevel);
            $parents       = $this->binaryRepository->getByLevel($currentLevel - 1);

            //echo $currentLevel . ' ' . $expectedCount . ' ' . $currentCount . '!!!<br/>';
            while ($currentCount < $expectedCount) {
                foreach($parents as $item) {
                    $exists1 = $this->binaryRepository->check($item->id, 1);
                    $exists2 = $this->binaryRepository->check($item->id, 2);

                    if (!$exists1) {
                        $id1 = $this->binaryRepository->store($item->id, 1);
                        $this->binaryRepository->update($id1->id, ['level' => $currentLevel]);
                    }

                    if (!$exists2) {
                        $id2 = $this->binaryRepository->store($item->id, 2);
                        $this->binaryRepository->update($id2->id, ['level' => $currentLevel]);
                    }
                }

                $currentCount  = $this->binaryRepository->getCountBinariesByLevel($currentLevel);
//                echo $currentCount . ' ' . $expectedCount . ' ' . $currentLevel . '<br/>';
//                exit;
            }

            $currentLevel++;
        }
    }
} 