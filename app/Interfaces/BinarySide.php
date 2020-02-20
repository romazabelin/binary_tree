<?php
/**
 * Created by PhpStorm.
 * User: roma
 * Date: 2/20/20
 * Time: 9:39 AM
 */

namespace App\Interfaces;


interface BinarySide
{
    /**
     * get above binaries by level
     *
     * @return mixed
     */
    public function getUnderBinaries($id);

    /**
     * get under binaries by level
     *
     * @return mixed
     */
    public function getAboveBinaries($id);
} 