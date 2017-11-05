<?php

namespace App\Infrastructure\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class EventBusPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $serviceName = 'infrastructure.event_bus';
        // always first check if the primary service is defined
        if (!$container->has($serviceName)) {
            return;
        }

        $definition = $container->findDefinition($serviceName);

        // find all service IDs with the app.mail_transport tag
        $taggedServices = $container->findTaggedServiceIds($serviceName);

        foreach ($taggedServices as $id => $tags) {
            $eventName = $taggedServices[$id][0]['event_name'];

            $definition->addMethodCall('addListener', array($eventName, new Reference($id)));
        }
    }
}