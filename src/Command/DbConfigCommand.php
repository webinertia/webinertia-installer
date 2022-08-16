<?php

declare(strict_types=1);

namespace Webinertia\Installer\Command;

use Laminas\Cli\Input\ParamAwareInputInterface;
use Laminas\Cli\Input\StringParam;
use Laminas\Config\Config;
use Laminas\Config\Factory as ConfigFactory;
use Laminas\Config\Writer\PhpArray as Writer;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Webinertia\Installer\Command\AbstractCommand;

use function sprintf;

final class DbConfigCommand extends AbstractCommand
{
    protected const TARGET_FILE = __DIR__ . '/../../../../../config/autoload/%s.php';
    /** @var string $development */
    protected static $development = 'local';
    /** @var string $dsn */
    protected static $dsn = 'mysql:dbname=%s;host=%s;charset=utf8';
    /** @var string $production */
    protected static $production = 'global';
    /** @var string $defaultName */
    protected static $defaultName = 'db-config';
    /** @var string $defaultDescription */
    protected static $defaultDescription = 'Configure MySQL connection for Aurora CMS';
    /** @var string $defaultHelp */
    protected static $defaultHelp = 'This command allows you to configure MySQL connection configuration for Aurora CMS';
    protected function configure(): void
    {
        $this->setName(self::$defaultName);
        $this->addParam(
            (new StringParam('dbname'))->setDescription('Database name')
        );
        $this->addParam(
            (new StringParam('host'))->setDescription('Hostname for the MySQL server')->setDefault('localhost')
        );
        $this->addParam(
            (new StringParam('username'))->setDescription('Username for the MySQL server')
        );
        $this->addParam(
            (new StringParam('password'))->setDescription('Password for the MySQL server')
        );
        $this->addParam(
            (new StringParam('mode'))->setDescription('development or production mode')
        );
    }

    /** @param ParamAwareInputInterface $input */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $config = new Config(
            ConfigFactory::fromFile(
                sprintf(
                    self::TARGET_FILE,
                    $input->getParam('mode') === 'development' ? self::$development : self::$production
                ),
            ),
            true
        );
        if (isset($config->db)) {
            if (isset($config->db->dsn)) {
                $config->db->dsn = sprintf(self::$dsn, $input->getParam('dbname'), $input->getParam('host'));
            }
            $config->db->username = $input->getParam('username');
            $config->db->password = $input->getParam('password');
            $output->writeln(
                '<info>Writing configuration data to '
                . sprintf(
                    self::TARGET_FILE,
                    $input->getParam('mode') === 'development' ? self::$development : self::$production
                ) . '</info>'
            );
            $writer = new Writer();
            $writer->setUseBracketArraySyntax(true);
            $writer->toFile(
                sprintf(
                    self::TARGET_FILE,
                    $input->getParam('mode') === 'development' ? self::$development : self::$production
                ),
                $config
            );
            $output->writeln('<info>Configuration data successfully written.</info>');
        }
        $output->writeln(
            '<info>Importing schema into database: '
            . $input->getParam('dbname')
            . ' on host: '
            . $input->getParam('host')
            . ' using username: '
            . $input->getParam('username')
            . '</info>'
        );
                return 0;
    }
}
