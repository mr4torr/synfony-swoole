<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\Finder\Finder;

class Kernel extends BaseKernel
{
    use MicroKernelTrait {
        configureContainer as configureContainerTrait;
        configureRoutes as configureRoutesTrait;
    }

    /**
     * Define as configuração diretamente na função
     */
    // protected function configureRoutes(RoutingConfigurator $routes): void
    // {
    //     $this->configureRoutesTrait($routes);
    //     $routes->import("../components/*/config/{routes}/*.yaml", "glob");
    //     $routes->import("../components/*/config/{routes}.yaml", "glob");
    // }

    /**
     * Carrega as configurações de acordo com components/+/config/routes.yaml
     */
    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $this->configureRoutesTrait($routes);

        $finder = new Finder();
        $finder
            ->directories()
            ->in(__DIR__ . "/../components/*")
            ->depth("== 0");

        $directories = [];
        foreach ($finder as $folder) {
            $basename = basename($folder->getPath());
            if (!in_array($basename, $directories)) {
                $dir = dirname(__DIR__) . "/components/$basename/src/Controller";
                if (!is_dir($dir)) {
                    continue;
                }
                $routes->import($dir, "attribute");
            }
        }
    }

    /**
     * Define as configuração diretamente na função
     */
    private function configureContainer(
        ContainerConfigurator $container,
        LoaderInterface $loader,
        ContainerBuilder $builder
    ): void {
        $this->configureContainerTrait($container, $loader, $builder);
        $finder = new Finder();
        $finder
            ->directories()
            ->in(__DIR__ . "/../components/*")
            ->depth("== 0");

        $directories = [];
        foreach ($finder as $folder) {
            $basename = basename($folder->getPath());
            if (!in_array($basename, $directories)) {
                $container
                    ->services()
                    ->load("$basename\\", dirname(__DIR__) . "/components/$basename/src/*")
                    ->autowire()
                    ->autoconfigure();
            }
        }
    }

    /**
     * Carrega as configurações de acordo com components/+/config/service.yaml
     */
    // private function configureContainer(
    //     ContainerConfigurator $container,
    //     LoaderInterface $loader,
    //     ContainerBuilder $builder
    // ): void {
    //     $this->configureContainerTrait($container, $loader, $builder);

    //     $configDir = dirname(__DIR__) . "/components/*/config";
    //     $container->import($configDir . "/services.yaml");
    //     $container->import(
    //         $configDir . "/{services}_" . $this->environment . ".yaml"
    //     );
    // }
}
