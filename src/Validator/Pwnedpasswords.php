<?php

declare(strict_types=1);

namespace Fabiang\ZendPwnedpasswords\Validator;

use Zend\Validator\AbstractValidator;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Pwnedpasswords extends AbstractValidator
{
    const DEFAULT_URI = 'https://api.pwnedpasswords.com/pwnedpassword/%s';

    const PASSWORD_EXISTS = 'passwordExists';
    const TRANSFER_ERROR = 'transferError';

    protected $messageTemplates = [
        self::PASSWORD_EXISTS => 'Password exists in the Pnwedpasswords database',
        self::TRANSFER_ERROR  => 'Transfer error when checking if password exists in Pnwedpasswords database',
    ];

    private $uri = self::DEFAULT_URI;

    /**
     * @var bool
     */
    private $returnOnError = true;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var string
     */
    private $logLevel = LogLevel::WARNING;

    public function __construct(LoggerInterface $logger, $options = null)
    {
        $this->logger = $logger;
        parent::__construct($options);
    }

    public function isValid($value): bool
    {
        $sha1 = strtoupper(sha1($value));
        $uri = sprintf($this->getUri(), $sha1);

        $client = new Client([]);
        try {
            $res = $client->request('GET', $uri);
        } catch (TransferException $ex) {
            $this->logger->log(
                $this->getLogLevel(),
                'Error when requesting Pwnedpasswords: %s',
                ['exception' => $ex]
            );

            if ($this->getReturnOnError() === false) {
                $this->error(self::TRANSFER_ERROR);
            }
            return $this->getReturnOnError();
        }

        if ($res->getStatusCode() === 200) {
            $this->error(self::PASSWORD_EXISTS);
            return false;
        }

        return true;

    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri)
    {
        $this->uri = $uri;
    }

    public function getReturnOnError(): bool
    {
        return $this->returnOnError;
    }

    public function setReturnOnError(bool $returnOnError)
    {
        $this->returnOnError = $returnOnError;
    }

    public function getLogLevel(): string
    {
        return $this->logLevel;
    }

    public function setLogLevel(string $logLevel)
    {
        $this->logLevel = $logLevel;
    }
}
