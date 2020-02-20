<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 2/19/20
 * Time: 9:25 PM
 */

namespace App\Services;


class BinaryOutputService extends BinaryDataService
{
    /**
     * get binary position
     *
     * @param int $position
     */
    protected function getPosition(int $position)
    {
        if ($position == 1)
            $res = '(left)';
        else if ($position == 2)
            $res = '(right)';
        else
            $res = '';

        return $res;
    }

    /**
     * output binary tree
     *
     * @param int $id
     * @return string
     */
    public function outputBinaryTree(int $id)
    {
        $binary   = $this->binaryRepository->getById($id);
        $menu     = "<ul id='" . $binary->id . "''>";
        $menu    .= "<li>";
        $menu    .= "<a href='#'>" . $binary->id . $this->getPosition($binary->position) . "</a>";
        $binaries = $this->binaryRepository->getByParent($id);

        foreach($binaries as $binary) {
            $submenu = "";

            if($binary['parent_id'] == $id){

                $submenu .= $this->outputBinaryTree($binary->id);

                if($submenu != '')
                    $menu .= "<ul class='submenu'>" . $submenu . "</ul>";


            }
        }

        $menu .= "</li>";
        $menu .= "</ul>";

        return $menu;
    }
} 