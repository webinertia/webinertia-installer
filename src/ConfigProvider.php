<?php

declare(strict_types=1);

namespace Webinertia\Installer;

use Laminas\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'laminas-cli'  => $this->getCliConfig(),
            'dependencies' => $this->getDependencyConfig(),
        ];
    }

    public function getCliConfig(): array
    {
        return [
            'commands' => [
                'import-schema' => Command\ImportSchemaCommand::class,
            ],
        ];
    }

    /**
     * Return application-level dependency configuration
     */
    public function getDependencyConfig(): array
    {
        return [
            'factories' => [
                Debug::class => InvokableFactory::class,
            ],
        ];
    }
}
