<?php

namespace Upload\Contract;

use Upload\Model\File;

interface Picture
{
    /**
     * @param File $file
     * @param int $degree
     * @return File
     */
    public function rotate(File $file, $degree);

    /**
     * @param File $file
     * @param int $x
     * @param int $y
     * @param int $w
     * @param int $h
     * @return File
     */
    public function crop(File $file, $x, $y, $w, $h);

    /**
     * @param File $file
     * @param int $w - ширина
     * @param int $h - высота
     * @param string $m - тип ресайза ('c' - crop-resize, 'r' - пропорциональный ресайз)
     * @return string - путь до кеша картинки
     */
    public function thumbnail(File $file, $w, $h, $m = 'r');
}