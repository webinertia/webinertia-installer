<?php

declare(strict_types=1);

namespace Webinertia\Installer\Command;

use Laminas\Cli\Input\ParamAwareInputInterface;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\Adapter\AdapterAwareInterface;
use Laminas\Db\Adapter\AdapterAwareTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webinertia\Installer\Command\AbstractCommand;

class BuildDbCommand extends AbstractCommand implements AdapterAwareInterface
{
    use AdapterAwareTrait;

    protected const MYSQL_DIR = __DIR__ . '/../../../../../data/db';

    public function __construct(array $config)
    {
        parent::__construct();
        $this->config = $config;
    }

    public function configure(): void
    {
        $this->setName('build-db');
        $this->setDescription('Build Database');
    }

    /** @var ParamAwareInputInterface $input */
    public function execute(InputInterface $input, OutputInterface $output)
    {

    }
}
