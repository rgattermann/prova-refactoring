<?php

namespace Unipago;

use SplFileObject;
use InvalidArgumentException;

class FileReader
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
        }
    }
}
