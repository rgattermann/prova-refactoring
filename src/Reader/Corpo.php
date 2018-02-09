<?php

namespace Unipago\Reader;

use InvalidArgumentException;
use \Unipago\Model\Corpo as CorpoModel;

class Corpo implements Line
{
    private $line;

    public function __construct($line)
    {
        if (empty($line)) {
            throw new InvalidArgumentException('A linha do corpo não pode ser vazia!');
        }

        $this->line = $line;
    }

    /**
     * Traduz uma linha para um objeto do tipo Corpo
     *
     * @return CorpoModel
     */
    public function readLine(): CorpoModel
    {
        $corpo = new CorpoModel;
        $corpo->setNossoNumero(substr($this->line, 62, 8))
              ->setValorPago((float) substr($this->line, 152, 13) / 100)
              ->setTarifa((float) substr($this->line, 175, 13) / 100)
              ->setJuros((float) substr($this->line, 266, 13) / 100)
              ->setCreditado((float) substr($this->line, 253, 13) / 100)
              ->setOcorrencia(substr($this->line, 108, 2));

        return $corpo;
    }
}
