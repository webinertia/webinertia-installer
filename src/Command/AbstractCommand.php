<?php

declare(strict_types=1);

namespace Webinertia\Installer\Command;

use Laminas\Cli\Command\AbstractParamAwareCommand;

class AbstractCommand extends AbstractParamAwareCommand
{
    public function __construct()
    {
        parent::__construct();
    }
}
