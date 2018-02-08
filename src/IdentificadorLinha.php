<?php

namespace Unipago;

class IdentificadorLinha
{
    public function __construct()
    {
    }

    public static function identify($line)
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
