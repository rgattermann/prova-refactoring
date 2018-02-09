<?php

namespace Unipago\Reader;

use Unipago\Base\Log;
use Unipago\Base\Line;
use Unipago\Model\Corpo as CorpoModel;

class Corpo extends Line
{
    private $line;

    public function __construct($line)
    {
        $this->validateLine($line);

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

        Log::debug('Informações do corpo:', [$corpo->toArray()]);

        return $corpo;
    }

    /**
     * Retorna o identificador da classes
     *
     * @return string
     */
    public static function getIdentificador(): string
    {
        return 'CORPO';
    }
}
