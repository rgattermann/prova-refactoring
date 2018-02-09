<?php

namespace Unipago\Reader;

use SplFileObject;
use InvalidArgumentException;
use Unipago\IdentificadorLinha;
use Unipago\Reader\Cabecalho as CabecalhoReader;
use Unipago\Reader\Corpo as CorpoReader;
use Unipago\Reader\Rodape as RodapeReader;

class File
{
    private $filename;

    public function __construct($filename)
    {
        if (empty($filename)) {
            throw new InvalidArgumentException('O arquivo ' . $filename . ' não pode ser vazio!');
        }

        if (!file_exists($filename)) {
            throw new InvalidArgumentException('Arquivo não encontrado: ' . $filename);
        }

        $this->filename = $filename;
    }

    public function read()
    {
        $arquivoRetorno = [];
        $file = new SplFileObject($this->filename, 'r');

        while (!$file->eof()) {
            $line = trim($file->fgets());

            if (!empty($line)) {
                $typeLine = IdentificadorLinha::identify($line);

                if ($typeLine === 'CABECALHO') {
                    $cabecalhoReader = new CabecalhoReader($line);
                    $arquivoRetorno['cabecalho'] = $cabecalhoReader->readLine();
                } elseif ($typeLine === 'CORPO') {
                    $corpoReader = new CorpoReader($line);
                    $arquivoRetorno['corpo'][] = $corpoReader->readLine();
                } else {
                    $rodapeReader = new RodapeReader($line);
                    $arquivoRetorno['rodape'] = $rodapeReader->readLine();
                }
            }
        }

        return $arquivoRetorno;
    }
}
