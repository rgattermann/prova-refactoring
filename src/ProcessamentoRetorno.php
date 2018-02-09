<?php 

namespace Unipago;

use Unipago\Reader\File as FileReader;
use Monolog\Logger;
use Exception;

class ProcessamentoRetorno
{
    protected $logger;
    protected $config;
    protected $ocorrenciasValidas = ['06', '09'];

    public function __construct(Config $config)
    {
        $this->logger = new Logger(__class__);
        $this->config = $config;
        $this->logger->info('Iniciando processamento de leitura do arquivo de retorno');
    }

    public function processar()
    {
        try {
            $this->logger->info('Realizando a leitura do arquivo: ' . $this->config->getLocalArquivo());

            $fileReader = new FileReader($this->config->getLocalArquivo());
            $arquivoRetorno = $fileReader->read();

            $this->logger->info('Data do arquivo: ' . $arquivoRetorno['cabecalho']->getFormatedDate());

            if ($arquivoRetorno['cabecalho']->getEmpresa() != $this->config->getNomeEmpresa()) {
                throw new Exception('Arquivo não é referente a empresa correta.');
            }

            $this->logger->info('Arquivo válido, continuando com o processamento.');

            $totalTotalDoArquivo = 0;

            foreach ($arquivoRetorno['corpo'] as $corpo) {
                $totalTotalDoArquivo += $corpo->getValorPago();

                if (in_array($corpo->getOcorrencia(), $this->ocorrenciasValidas)) {
                    if ($corpo->validaPagamento()) {
                        ApiPagamentos::baixaTitulo($corpo->getNossoNumero(), $corpo->getValorPago());

                        $this->logger->info('Pagamento do título ' . $corpo->getNossoNumero() . ' efetuado com sucesso!');
                    } else {
                        $this->logger->error('Pagamento do título ' . $corpo->getNossoNumero() . ' não foi validado com sucesso!');
                        //adicionar o valor creditado e o valor total pago no log
                    }
                } else {
                    $this->logger->error('Tipo de entrada não encontrada!');
                }
            }

            if ($totalTotalDoArquivo != $arquivoRetorno['rodape']->getTotalArquivo()) {
                throw new Exception('O arquivo possui inconsistências de valores!');
            }

            $this->logger->info('Arquivo importado com sucesso!');
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }
}
