<?php

namespace App\Infrastructure\Symfony;

use App\Infrastructure\Symfony\DependencyInjection\Compiler\EventBusPass;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class MyIdSafeGuardBundle
 * @package App\Infrastructure\Symfony
 */
class MyIdSafeGuardBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new EventBusPass());
        $container->addCompilerPass($this->buildMappingCompilerPass());
    }

    public function buildMappingCompilerPass()
    {
        $entityDir = realpath(__DIR__.'/../Persistence/Doctrine/ORM/Mapping/Entity');
        $entityMappings = 'App\Domain\Model\Entity';

        $valueObjectDir = realpath(__DIR__.'/../Persistence/Doctrine/ORM/Mapping/ValueObject');
        $valueObjectMappings = 'App\Domain\Model\ValueObject';

        return DoctrineOrmMappingsPass::createYamlMappingDriver(
            [$entityDir => $entityMappings, $valueObjectDir => $valueObjectMappings],
            [],
            false,
            ['Model' => 'App\Domain\Model\Entity']
        );
    }
}
