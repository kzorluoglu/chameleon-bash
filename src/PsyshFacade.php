<?php

namespace kzorluoglu\ChameleonBash;

use Psy\Shell;
use RuntimeException;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use function array_merge;
use function Psy\debug;

/**
 * @modified Koray Zorluohlu <koray@d8devs.com>
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
final class PsyshFacade implements ContainerAwareInterface
{
    private static Shell $shell;

    private static ContainerInterface $container;

    public static function init(): void
    {
        if (isset(self::$shell)) {
            return;
        }

        if (!isset(self::$container)) {
            throw new RuntimeException('Cannot initialize the facade without a container.');
        }

        self::$shell = self::$container->get('psysh.shell');
    }

    public static function debug(array $variables = [], $bind = null): void
    {
        self::init();

        $_variables = array_merge(self::$shell->getScopeVariables(), $variables);

        debug($_variables, $bind);
    }

    public function setContainer(ContainerInterface $container = null): void
    {
        self::$container = $container;
    }
}
