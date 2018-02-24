<?php

declare(strict_types=1);

namespace Fabiang\ZendPwnedpasswords\Validator;

use Zend\ServiceManager\FactoryInterface;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Log\Logger;
use Zend\Log\PsrLoggerAdapter;
use Zend\Log\Writer\Noop;

class PwnedpasswordsFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Pwnedpasswords
    {
        if (!isset($options['logger'])) {
            $zendLogger = new Logger();
            $zendLogger->addWriter(new Noop());
            $logger = new PsrLoggerAdapter($zendLogger);
        } else {
            $logger = $options['logger'];
        }

        $validator = new Pwnedpasswords($logger, $options);
        return $validator;
    }

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return $this($serviceLocator, Pwnedpasswords::class);
    }

}
