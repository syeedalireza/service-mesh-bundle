<?php

declare(strict_types=1);

namespace Syeedalireza\ServiceMeshBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

final class ServiceMeshExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('service_mesh.grpc.enabled', $config['grpc']['enabled']);
        $container->setParameter('service_mesh.grpc.port', $config['grpc']['port']);
        $container->setParameter('service_mesh.discovery.provider', $config['discovery']['provider']);
    }

    public function getAlias(): string
    {
        return 'service_mesh';
    }
}
