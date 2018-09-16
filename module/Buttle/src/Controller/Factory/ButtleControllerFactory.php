<?php
namespace Buttle\Controller\Factory;

use Interop\Container\ContainerInterface;
use Buttle\Controller\ButtleController;
use Zend\ServiceManager\Factory\FactoryInterface;
//use User\Service\AuthManager;
use User\Service\UserManager;
use Zend\Session\SessionManager;

/**
 * This is the factory for AuthController. Its purpose is to instantiate the controller
 * and inject dependencies into its constructor.
 */
class ButtleControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        //$authManager = $container->get(AuthManager::class);
        $userManager = $container->get(UserManager::class);
        $sessionManager = $container->get(SessionManager::class);
        //$sessionContainer = $container->get('UserRegistration');
//        var_dump($sessionContainer);
//        exit();
        return new ButtleController($entityManager,$sessionManager,$userManager);
    }
}
