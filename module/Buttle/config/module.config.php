<?php

namespace Buttle;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\ButtleController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'buttle' => [
                'type' => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route' => '/buttle[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\ButtleController::class,
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                // You can place additional routes that match under the
                // route defined above here.
                ],
            ],
        ],
    ],
    'session_containers' => [
        'UserRegistration'
    ],
    'controllers' => [
        'factories' => [
            Controller\ButtleController::class => Controller\Factory\ButtleControllerFactory::class,
        //Controller\UserController::class => Controller\Factory\UserControllerFactory::class,            
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
