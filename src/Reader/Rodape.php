<?php

namespace Unipago\Reader;

use Unipago\Base\Log;
use Unipago\Model\Rodape as RodapeModel;

class Rodape extends Line
{
    private $line;

    public function __construct($line)
    {
        $this->validateLine($line);

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

        Log::debug('Informações do rodape:', [$rodape->toArray()]);

        return $rodape;
    }

    /**
     * Retorna o identificador da classes
     *
     * @return string
     */
    public static function getIdentificador(): string
    {
        return 'RODAPE';
    }
}
