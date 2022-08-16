<?php

declare(strict_types=1);

namespace Webinertia\Installer;

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
                'db-config' => Command\DbConfigCommand::class,
                'build-db'  => Command\BuildDbCommand::class,
            ],
            'chains'   => [
                Command\DbConfigCommand::class => [
                    Command\BuildDbCommand::class => [],
                ],
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
                Command\BuildDbCommand::class => Command\Factory\BuildDbCommandFactory::class,
            ],
        ];
    }
}
