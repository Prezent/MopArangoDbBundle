<?php
namespace Mop\ArangoDbBundle\Connection;

use Mop\ArangoDbBundle\LoggerInterface;
use triagens\ArangoDb\Connection;

/**
 * ArangoDb connection factory
 *
 * @author Andreas Streichardt
 * @author Sander Marechal
 */
class Factory
{
    /**
     * @var LoggerInterface[]
     */
    private $loggers = array();

    /**
     * Add a logger
     *
     * @param LoggerInterface $logger
     * @return void
     */
    public function addLogger(LoggerInterface $logger)
    {
        $this->loggers[] = $logger;
    }

    /**
     * Create a new connection
     *
     * @param string $name
     * @param array $options Connection options
     * @return void
     */
    public function createConnection($name, array $options)
    {
        if (count($this->loggers)) {
            $loggers = $this->loggers;

            $trace = function ($type, $data) use ($name, $loggers) {
                foreach ($loggers as $logger) {
                    $logger->log($name, $type, $data);
                }
            };

            $options['trace'] = $trace;
        }

        return new Connection($options);
    }
}
