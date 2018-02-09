<?php

namespace Unipago\Reader;

use SplFileObject;
use InvalidArgumentException;
use Unipago\IdentificadorLinha;
use Unipago\Reader\Cabecalho as CabecalhoReader;
use Unipago\Reader\Corpo as CorpoReader;
use Unipago\Reader\Rodape as RodapeReader;
use Unipago\Model\ArquivoRetorno;

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

    public function read(): ArquivoRetorno
    {
        $arquivoRetorno = new ArquivoRetorno;

        $file = new SplFileObject($this->filename, 'r');

        while (!$file->eof()) {
            $line = trim($file->fgets());

            if (!empty($line)) {
                $typeLine = IdentificadorLinha::identify($line);

                if ($typeLine === 'CABECALHO') {
                    $cabecalhoReader = new CabecalhoReader($line);
                    $arquivoRetorno->setCabecalho($cabecalhoReader->readLine());
                    continue;
                } elseif ($typeLine === 'CORPO') {
                    $corpoReader = new CorpoReader($line);
                    $arquivoRetorno->addCorpo($corpoReader->readLine());
                    continue;
                } else {
                    $rodapeReader = new RodapeReader($line);
                    $arquivoRetorno->setRodape($rodapeReader->readLine());
                }
            }
        }

        return $arquivoRetorno;
    }
}
