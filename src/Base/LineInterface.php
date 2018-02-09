<?php

namespace Unipago\Base;

interface LineInterface
{
    public function readLine();

    public static function getIdentificador();
}
