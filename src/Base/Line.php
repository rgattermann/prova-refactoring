<?php

namespace Unipago\Base;

use InvalidArgumentException;

class Line implements LineInterface
{
    public function validateLine($line)
    {
        if (empty($line)) {
            throw new InvalidArgumentException('A linha do corpo não pode ser vazia!');
        }

        $typeLine = IdentificadorLinha::identify($line);

        if ($typeLine != $this->getIdentificador()) {
            throw new InvalidArgumentException('A linha não é compativel com o tipo da classe ' . $this->getIdentificador());
        }
    }

    public static function getIdentificador()
    {
    }

    public function readLine()
    {
    }
}
