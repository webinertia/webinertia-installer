<?php

declare(strict_types=1);

namespace Webinertia\Installer\Command\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Webinertia\Installer\Command\BuildDbCommand;

class BuildDbCommandFactory implements FactoryInterface
{
    /** @param string $requestedName */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null): BuildDbCommand
    {
        return new $requestedName(
            $container->get('config'),
        );
    }
}
