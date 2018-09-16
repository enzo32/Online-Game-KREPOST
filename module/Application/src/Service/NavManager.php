<?php
namespace Application\Service;

/**
 * This service is responsible for determining which items should be in the main menu.
 * The items may be different depending on whether the user is authenticated or not.
 */
class NavManager
{
    /**
     * Auth service.
     * @var Zend\Authentication\Authentication
     */
    private $authService;
    
    /**
     * Url view helper.
     * @var Zend\View\Helper\Url
     */
    private $urlHelper;
    
    /**
     * Constructs the service.
     */
    public function __construct($authService, $urlHelper) 
    {
        $this->authService = $authService;
        $this->urlHelper = $urlHelper;
    }
    
    /**
     * This method returns menu items depending on whether user has logged in or not.
     */
    public function getMenuItems() 
    {
        $url = $this->urlHelper;
        $items = [];
        
        $items[] = [
            'id' => 'home',
            'label' => 'Стартовая страница',
            'link'  => $url('home')
        ];
        
        $items[] = [
            'id' => 'about',
            'label' => 'Про игру',
            'link'  => $url('about')
        ];
        
        // Display "Login" menu item for not authorized user only. On the other hand,
        // display "Admin" and "Logout" menu items only for authorized users.
        if (!$this->authService->hasIdentity()) {
            $items[] = [
                'id' => 'login',
                'label' => 'Вход в игру',
                'link'  => $url('login'),
                'float' => 'right'
            ];
            $items[] = [
                'id' => 'registration',
                'label' => 'Регистрация',
                'link'  => $url('registration'),
                'float' => 'right'
            ];
        } else {
            
            $items[] = [
                'id' => 'admin',
                'label' => 'GAME',
                'dropdown' => [
                    [
                        'id' => 'users',
                        'label' => 'Мой замок',
                        'link' => $url('game',['action'=>'mycastle'])
                    ],
                    [
                        'id' => 'magazin',
                        'label' => 'Магазин',
                        'link' => $url('game',['action'=>'armory'])
                    ],
                    [
                        'id' => 'tournament',
                        'label' => 'Турниры',
                        'link' => $url('tournament',['action'=>'index'])
                    ]
                ]
            ];
            
            $items[] = [
                'id' => 'Выход из игры',
                'label' => $this->authService->getIdentity(),
                'float' => 'right',
                'dropdown' => [
                    [
                        'id' => 'settings',
                        'label' => 'Настройки',
                        'link' => $url('application', ['action'=>'settings'])
                    ],
                    [
                        'id' => 'logout',
                        'label' => 'Выход из игры',
                        'link' => $url('logout')
                    ],
                ]
            ];
        }
        
        return $items;
    }
}


