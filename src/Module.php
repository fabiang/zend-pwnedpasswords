<?php

declare(strict_types=1);

namespace Fabiang\ZendPwnedpasswords;

class Module
{
    public function getConfig(): array
    {
        $provider = new ConfigProvider();
        return [
            'validator' => $provider->getValidatorConfig(),
        ];
    }
}
