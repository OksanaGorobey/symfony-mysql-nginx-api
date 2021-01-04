<?php declare(strict_types=1);
namespace App;

/**
 * Class Kernel
 * @package App
 */
class Kernel extends \Symfony\Component\HttpKernel\Kernel
{
    use \Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;

    /**
     * @param \Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $container
     */
    protected function configureContainer(\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $container ): void
    {
        $container->import( '../config/{packages}/*.yaml' );
        $container->import( '../config/{packages}/' . $this->environment . '/*.yaml' );

        if( is_file( \dirname( __DIR__ ) . '/config/services.yaml' ) )
        {
            $container->import( '../config/services.yaml' );
            $container->import( '../config/{services}_' . $this->environment . '.yaml' );
        }
        elseif( is_file( $path = \dirname( __DIR__ ) . '/config/services.php' ) )
        {
            ( require $path )( $container->withPath( $path ), $this );
        }
    }

    /**
     * @param \Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator $routes
     */
    protected function configureRoutes(\Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator $routes ): void
    {
        $routes->import( '../config/{routes}/' . $this->environment . '/*.yaml' );
        $routes->import( '../config/{routes}/*.yaml' );

        if( is_file( \dirname(__DIR__) . '/config/routes.yaml' ) )
        {
            $routes->import('../config/routes.yaml');
        }
        elseif( is_file( $path = \dirname( __DIR__ ) . '/config/routes.php' ) )
        {
            ( require $path )( $routes->withPath( $path ), $this );
        }
    }
}
