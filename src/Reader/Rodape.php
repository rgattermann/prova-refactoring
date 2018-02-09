<?php

namespace Unipago\Reader;

use InvalidArgumentException;
use \Unipago\Model\Rodape as RodapeModel;

class Rodape implements Line
{
    private $line;

    public function __construct($line)
    {
        if (empty($line)) {
            throw new InvalidArgumentException('A linha do rodapé não pode ser vazia!');
        }

        $this->line = $line;
    }

    /**
     * Traduz uma linha para um objeto do tipo Rodapé
     *
     * @return RodapeModel
     */
    public function readLine(): RodapeModel
    {
        $rodape = new RodapeModel;
        $rodape->setTotalArquivo(substr($this->line, 220, 14) / 100);

        return $rodape;
    }
}
