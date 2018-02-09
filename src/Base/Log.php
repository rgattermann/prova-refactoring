<?php
namespace Unipago\Base;

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class Log
{
    protected static $instance;
    
    /**
     * Retorna uma instancia do Monolog
     *
     * @return \Monolog\Logger
     */
    public static function getLogger(): ? Logger
    {
        if (! self::$instance) {
            self::configureInstance();
        }
        return self::$instance;
    }

    /**
     * Configura o método de log usado
     *
     * @return Logger
     */
    protected static function configureInstance()
    {
        $logger = new Logger('ProcessamentoRetorno');
        self::$instance = $logger;
    }

    public static function debug($message, array $context = [])
    {
        self::getLogger()->addDebug($message, $context);
    }

    public static function info($message, array $context = [])
    {
        self::getLogger()->addInfo($message, $context);
    }

    public static function notice($message, array $context = [])
    {
        self::getLogger()->addNotice($message, $context);
    }

    public static function warning($message, array $context = [])
    {
        self::getLogger()->addWarning($message, $context);
    }

    public static function error($message, array $context = [])
    {
        self::getLogger()->addError($message, $context);
    }

    public static function critical($message, array $context = [])
    {
        self::getLogger()->addCritical($message, $context);
    }

    public static function alert($message, array $context = [])
    {
        self::getLogger()->addAlert($message, $context);
    }

    public static function emergency($message, array $context = [])
    {
        self::getLogger()->addEmergency($message, $context);
    }
}
