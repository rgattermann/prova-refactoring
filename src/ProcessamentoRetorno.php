<?php 

namespace Unipago;

use Monolog\Logger;

class ProcessamentoRetorno
{
    protected $logger;
    protected $config;

    public function __construct(Config $config)
    {
        $this->logger = new Logger(__class__);
        $this->config = $config;
        $this->logger->info('Iniciando processamento de leitura do arquivo de retorno');
    }

    public function processar()
    {
        $this->logger->info('Realizando a leitura do arquivo: ' . $this->config->getLocalArquivo());

        $fileReader = new FileReader($this->config->getLocalArquivo());
        $fileReader->read();

        die;

        $this->conteudoArquivo = file_get_contents($config->getLocalArquivo());
        $todoArquivo = explode(PHP_EOL, $this->conteudoArquivo);

        for ($i = 0; $i < count($todoArquivo); $i++) {
            if ($i == '0') {
                $tipo_linha = 'cabecalho';
            } else {
                if (substr($todoArquivo[$i], 0, 1) == '1') {
                    $tipo_linha = 'corpo';
                } else {
                    $tipo_linha = 'rodape';
                }
            }

            switch ($tipo_linha) {
                case 'cabecalho':
                    $empresa = substr($todoArquivo[$i], 46, 30);
                    $banco = substr($todoArquivo[$i], 79, 15);
                    $data = substr($todoArquivo[$i], 94, 6);

                    $dia = substr($data, 0, 2);
                    $mes = substr($data, 2, 2);
                    $ano = '20' . substr($data, 4, 2);
                    var_dump($ano . '-' . $mes . '-' . $dia);

                    if (trim($empresa) == $this->config->nomeEmpresa()) {
                        $this->logger->info('Arquivo válido, continuando com o processamento.');
                    } else {
                        throw new \Exception('Arquivo não é referente a empresa correta.');
                    }
                    break;

                case 'corpo':
                    $nosso_numero = substr($todoArquivo[$i], 62, 8);
                    $valorPago = substr($todoArquivo[$i], 152, 13) / 100;
                    $tarifa = substr($todoArquivo[$i], 175, 13) / 100;
                    $juros = substr($todoArquivo[$i], 266, 13) / 100;
                    $creditado = substr($todoArquivo[$i], 253, 13) / 100;
                    $ocorrencia = substr($todoArquivo[$i], 108, 2);

                    $arrayOcorrencias = ['06', '09'];

                    if (in_array($ocorrencia, $arrayOcorrencias)) {
                        if (number_format($creditado, 2) == number_format($valorPago + $juros - $tarifa, 2)) {
                            echo "Pagamento do título $nosso_numero efetuado com sucesso \n";
                            ApiPagamentos::baixaTitulo($nosso_numero, $valorPago);
                        } else {
                            echo "Valor incorreto \n";
                        }
                    } else {
                        echo "Tipo de entrada não encontrado \n";
                    }

                    break;

                default:
                    $valorTotal = substr($todoArquivo[$i], 220, 14) / 100;

                    $totalDoArquivo = 0;
                    for ($i = 0; $i < count($todoArquivo); $i++) {
                        $totalDoArquivo += substr($todoArquivo[$i], 152, 13) / 100;
                    }

                    if (number_format($valorTotal, 2) != number_format($totalDoArquivo, 2)) {
                        throw new \Exception('Arquivo inconsistente');
                    } else {
                        echo "arquivo importado com sucesso \n";
                    }

                    break;
            }
        }
    }
}
