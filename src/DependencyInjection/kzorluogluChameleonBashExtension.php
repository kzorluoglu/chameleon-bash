<?php

namespace kzorluoglu\ChameleonBash\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\ExpressionLanguage\Expression;

class kzorluogluChameleonBashExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/'));
        $loader->load('services.xml');

        $config = $this->processConfiguration(new Configuration(), $config);

        foreach ($config['variables'] as $name => $value) {
            if (is_string($value) && strpos($value, '@') === 0) {
                $value = new Reference(substr($value, 1));
            }

            $config['variables'][$name] = $value;
        }

        $containerId = 'test.service_container';

        $container
            ->findDefinition('psysh.shell')
            ->addMethodCall(
                'setScopeVariables',
                [array_merge(
                    $config['variables'],
                    [
                        'container' => new Reference($containerId),
                        'kernel' => new Reference('kernel'),
                        'self' => new Reference('psysh.shell'),
                        'parameters' => new Expression(sprintf(
                            "service('%s').getParameterBag().all()",
                            $containerId
                        ))
                    ]
                )]
            )
        ;

        $container
            ->registerForAutoconfiguration(Command::class)
            ->addTag('psysh.command')
        ;
    }
}
