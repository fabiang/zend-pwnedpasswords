<?php

declare(strict_types=1);

namespace Fabiang\ZendPwnedpasswords;

class ConfigProvider
{
    /**
     * Return general-purpose zend-i18n configuration.
     *
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'validators' => $this->getValidatorConfig(),
        ];
    }

    public function getValidatorConfig(): array
    {
        return [
            'aliases'   => [
                'pwnedpasswords' => Validator\Pwnedpasswords::class,
                'Pwnedpasswords' => Validator\Pwnedpasswords::class,
            ],
            'factories' => [
                Validator\Pwnedpasswords::class => Validator\PwnedpasswordsFactory::class,
            ]
        ];
    }
}
