<?php

declare(strict_types=1);

namespace Webinertia\Installer;

use Webinertia\Installer\ConfigProvider;

class Module
{
    /**
     * Return webinertia-installer configuration for aurora cms.
     *
     * @return array
     */
    public function getConfig()
    {
        $provider = new ConfigProvider();
        return [
            'laminas-cli'     => $provider->getCliConfig(),
            'service_manager' => $provider->getDependencyConfig(),
        ];
    }
}
