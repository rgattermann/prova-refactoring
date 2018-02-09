<?php

namespace Unipago\Reader;

use InvalidArgumentException;
use \Unipago\Model\Rodape as RodapeModel;

class Rodape
{
    private $line;

    public function __construct($line)
    {
        if (empty($line)) {
            throw new InvalidArgumentException('A linha do rodapé não pode ser vazia!');
        }

        $this->line = $line;
    }

    public function readLine()
    {
        $rodape = new RodapeModel;
        $rodape->setTotalArquivo(substr($this->line, 220, 14) / 100);

        return $rodape;
    }
}
