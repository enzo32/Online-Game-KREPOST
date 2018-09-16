<?php

namespace Tournament;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'controllers' => [
        'factories' => [
            Controller\TournamentController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'tournament' => [
                'type' => Segment::class,
                'options' => [
                    // Change this to something specific to your module
                    'route' => '/tournament[/:action][/:id]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\TournamentController::class,
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
            Controller\TournamentController::class => Controller\Factory\TournamentControllerFactory::class,
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
