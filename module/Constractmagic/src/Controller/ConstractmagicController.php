<?php

namespace Constractmagic\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
//use Zend\Session\SessionManager;
use Zend\Session\Container;
use User\Entity\User;
//use User\Entity\UserArmory;
//use User\Entity\Gamethings;
//use User\Entity\Warriors;
//use User\Entity\SiegeWeapons;
//use User\Entity\ScrollsOfMagic;
//use User\Entity\UserWarriors;
//use User\Entity\UserSiegeWeapons;
//use User\Entity\Userscrollsofmagic;
//use User\Entity\Listtournament;
//use User\Entity\RegtoTournament;
//use User\Entity\Gotobuttle;

class ConstractmagicController extends AbstractActionController {

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

        return [];
    }

    

}
