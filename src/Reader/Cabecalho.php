<?php

namespace Unipago\Reader;

use InvalidArgumentException;
use \Unipago\Model\Cabecalho as CabecalhoModel;

class Cabecalho
{
    private $line;

    public function __construct($line)
    {
        if (empty($line)) {
            throw new InvalidArgumentException('A linha do cabeçalho não pode ser vazia!');
        }

        $this->line = $line;
    }

    public function readLine()
    {
        $cabecalho = new CabecalhoModel;
        $cabecalho->setEmpresa(substr($this->line, 46, 30));
        $cabecalho->setBanco(substr($this->line, 79, 15));
        $cabecalho->setData(substr($this->line, 94, 6));

        return $cabecalho;
    }
}
