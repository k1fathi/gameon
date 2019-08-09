<?php
namespace App\Interfaces;

interface ImageResizeInterface
{
    public function getMaxWidth($key = null);
    public function getMaxHeight($key = null);
}