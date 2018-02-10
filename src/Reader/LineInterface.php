<?php

namespace Unipago\Reader;

interface LineInterface
{
    public function readLine();

    public static function getIdentificador();
}
