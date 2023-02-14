<?php
namespace kzorluoglu\ChameleonBash;

use kzorluoglu\ChameleonBash\DependencyInjection\Compiler\AddPsyshCommandPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class kzorluogluChameleonBashBundle extends Bundle
{
    /**
     * @inheritDoc
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        // Ensures that AddPsyshCommandPass runs before AddConsoleCommandPass to avoid
        // autoconfiguration conflicts.
        $container->addCompilerPass(
            new AddPsyshCommandPass(),
            PassConfig::TYPE_BEFORE_OPTIMIZATION,
            10,
        );
    }
}
