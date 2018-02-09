<?php

namespace Unipago\Base;

class IdentificadorLinha
{
    /**
     * Realiza a identificação da linha do arquivo
     * Retornado o identificador apropriado
     *
     * @param [string] $line
     * @return integer
     */
    public static function identify(string $line): string
    {
        $firstCaractere = substr($line, 0, 1);

        switch ($firstCaractere) {
            case 0:
                $typeLine = 'CABECALHO';
                break;

            case 1:
                $typeLine = 'CORPO';
                break;

            default:
                $typeLine = 'RODAPE';
                break;
        }

        return $typeLine;
    }
}
