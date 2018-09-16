<?php

namespace Buttle\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
//use Zend\Session\SessionManager;
use Zend\Session\Container;
//use User\Entity\User;
//use User\Entity\UserArmory;
//use User\Entity\Gamethings;
use User\Entity\Warriors;
//use User\Entity\SiegeWeapons;
//use User\Entity\ScrollsOfMagic;
use User\Entity\UserWarriors;
//use User\Entity\UserSiegeWeapons;
use User\Entity\Userscrollsofmagic;
//use User\Entity\Listtournament;
//use User\Entity\RegtoTournament;
use User\Entity\Gotobuttle;

class ButtleController extends AbstractActionController {

    /**
     * User manager.
     * @var User\Service\UserManager 
     */
    private $userManager;

    /**
     * sessionManager.
     * @var Zend\Session\SessionManager
     */
    private $sessionManager;

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager, $sessionManager, $userManager) {
        $this->entityManager = $entityManager;
        $this->sessionManager = $sessionManager;
        $this->userManager = $userManager;
    }

    public function indexAction() {
        $container = new Container('UserRegistration');
        $value = $container->key;
        $entityManager = $this->entityManager;
        $usWar = $entityManager->getRepository(UserWarriors::class)->findBy(
                ['user_email' => $value], ['id_warriors' => 'ASC']
        );
        $gotoButtle = $entityManager->getRepository(Gotobuttle::class)->findBy(
                ['emailusers' => $value]
                );
        $uSoMagic = $entityManager->getRepository(Userscrollsofmagic::class)->findBy(
                ['user_email' => $value], ['scrollsofmagicId' => 'ASC']
        );
        $war = $entityManager->getRepository(Warriors::class)->findAll();
        
        
        $warriors = $this->userManager->loadDataWarriors($war);
        $userWarriors = $this->userManager->loadUsersWariors($usWar);
        $Userscrollsofmagic = $this->userManager->loadUserscrollsofmagic($uSoMagic);
        $listbuttle = $this->userManager->loadListButtle($gotoButtle);
        
        
        return ['userWarriors' =>$userWarriors, 'Userscrollsofmagic' => $Userscrollsofmagic, 'warriors' => $warriors,
            'listbuttle' => $listbuttle];
    }
    
   

    

}
