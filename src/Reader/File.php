<?php

namespace Unipago\Reader;

use Unipago\IdentificadorLinha;
use Unipago\Reader\Cabecalho as CabecalhoReader;
use Unipago\Reader\Corpo as CorpoReader;
use SplFileObject;
use InvalidArgumentException;

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

    private function getTotalLines(SplFileObject $file)
    {
        $file->seek(PHP_INT_MAX);
        return $file->key() + 1;
    }

    public function read()
    {
        $file = new SplFileObject($this->filename, 'r');

        // if ($this->getTotalLines($file) < 2) {
        //     throw new InvalidArgumentException('Arquivo sem lançamentos');
        // }

        while (!$file->eof()) {
            $line = trim($file->fgets());

            $typeLine = IdentificadorLinha::identify($line);

            if ($typeLine == 'CABECALHO') {
                $cabecalhoReader = new CabecalhoReader($line);
                $cabecalho = $cabecalhoReader->readLine();
            } elseif ($typeLine == 'CORPO') {
                $corpoReader = new CorpoReader($line);
                $corpoReader->readLine();
            }
        }
    }
}
