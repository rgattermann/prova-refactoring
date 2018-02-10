<?php

namespace Unipago\Reader;

use Unipago\Model\Cabecalho as CabecalhoModel;
use Unipago\Base\Log;

class Cabecalho extends Line
{
    private $line;

    public function __construct($line)
    {
        $this->validateLine($line);
        $this->line = $line;
    }

    /**
     * Traduz uma linha para um objeto do tipo Cabecalho
     *
     * @return CabecalhoModel
     */
    public function readLine(): CabecalhoModel
    {
        Log::info('Lendo a linha do cabecalho');
        $cabecalho = new CabecalhoModel;
        $cabecalho->setEmpresa(substr($this->line, 46, 30))
                  ->setBanco(substr($this->line, 79, 15))
                  ->setData(substr($this->line, 94, 6));

        Log::debug('Informações do cabecalho:', [$cabecalho->toArray()]);

        return $cabecalho;
    }

    /**
     * Retorna o identificador da classes
     *
     * @return string
     */
    public static function getIdentificador(): string
    {
        return 'CABECALHO';
    }
}
