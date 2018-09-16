<?php

/**
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Game\Controller;

use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use User\Entity\User;
use User\Entity\UserArmory;
use User\Entity\Gamethings;
use User\Entity\Warriors;
use User\Entity\SiegeWeapons;
use User\Entity\ScrollsOfMagic;
use User\Entity\UserWarriors;
use User\Entity\UserSiegeWeapons;
use User\Entity\Userscrollsofmagic;

class GameController extends AbstractActionController {

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
        $entityManager = $this->entityManager;
        $container = new Container('UserRegistration');
        $value = $container->key;
        $userarmory = $entityManager->getRepository(UserArmory::class)->findBy(
                ['user_email' => $value], ['id_things' => 'ASC']
        );
        $usWar = $entityManager->getRepository(UserWarriors::class)->findBy(
                ['user_email' => $value], ['id_warriors' => 'ASC']
        );
        $uSW = $entityManager->getRepository(UserSiegeWeapons::class)->findBy(
                ['user_email' => $value], ['SiegeWeaponsId' => 'ASC']
        );
        $uSoMagic = $entityManager->getRepository(Userscrollsofmagic::class)->findBy(
                ['user_email' => $value], ['scrollsofmagicId' => 'ASC']
        );


        $war = $entityManager->getRepository(Warriors::class)->findAll();
        $SiegeWeapons = $entityManager->getRepository(SiegeWeapons::class)->findAll();

        $gamethings = $entityManager->getRepository(Gamethings::class)->findAll();
        $ScrollsOfMagic = $entityManager->getRepository(ScrollsOfMagic::class)->findAll();
        $sett = $this->userManager->loadDataThings($gamethings);
        $warriors = $this->userManager->loadDataWarriors($war);
        $SieWeap = $this->userManager->loadDataSiegeWeapons($SiegeWeapons);
        $scrOfMag = $this->userManager->loadDataScrollsOfMagic($ScrollsOfMagic);
        $usersThings = $this->userManager->loadUsersThings($userarmory);
        $userWarriors = $this->userManager->loadUsersWariors($usWar);
        $userSiegeWeapons = $this->userManager->loaduserSiegeWeapons($uSW);
        $Userscrollsofmagic = $this->userManager->loadUserscrollsofmagic($uSoMagic);
        return ['userarmory' => $usersThings, 'gamethings' => $sett,
            'warriors' => $warriors, 'userWarriors' => $userWarriors, 'SiegeWeapons' => $SieWeap,
            'ScrollsOfMagic' => $scrOfMag, 'userSiegeWeapons' => $userSiegeWeapons,
            'Userscrollsofmagic' => $Userscrollsofmagic];
    }

    public function armoryAction() {
        $entityManager = $this->entityManager;
        $container = new Container('UserRegistration');
        $value = $container->key;
        $gameThings = $entityManager->getRepository(Gamethings::class)->findAll();
        $SiegeWeapons = $entityManager->getRepository(SiegeWeapons::class)->findAll();
        $war = $entityManager->getRepository(Warriors::class)->findAll();
        $SOfMagic = $entityManager->getRepository(ScrollsOfMagic::class)->findAll();
        $user = $entityManager->getRepository(User::class)->findOneByEmail(
                ['email' => $value]
        );
        $sett = $this->userManager->loadDataThings($gameThings);
        $warriors = $this->userManager->loadDataWarriors($war);
        $SieWeap = $this->userManager->loadDataSiegeWeapons($SiegeWeapons);
        $scrOfMag = $this->userManager->loadDataScrollsOfMagic($SOfMagic);

        return ['gameThings' => $sett, 'user' => $user, 'warriors' => $warriors,
            'SiegeWeapons' => $SieWeap, 'ScrollsOfMagic' => $scrOfMag];
    }

    public function attackAction() {
        return[];
    }

    public function mycastleAction() {
        $container = new Container('UserRegistration');
        $value = $container->key;
        $usWar = $this->entityManager->getRepository(UserWarriors::class)->findBy(
                ['user_email' => $value], ['id_warriors' => 'ASC']
        );
        $uSW = $this->entityManager->getRepository(UserSiegeWeapons::class)->findBy(
                ['user_email' => $value], ['SiegeWeaponsId' => 'ASC']
        );
        
        $user = $this->userManager->loadDataUsers($value);
        $countWarriors = $this->userManager->countUsersWarriors($usWar);
        $countUserSiegeWeapons = $this->userManager->countUserSiegeWeapons($uSW);

        return ['countWarriors' => $countWarriors, 'countUserSiegeWeapons' => $countUserSiegeWeapons,
            'user' => $user];
    }

    public function soldthingsAction() {
        $id = (int) $this->params()->fromRoute('id');
    }

    public function soldwarriorsAction() {
        $id = (int) $this->params()->fromRoute('id');
    }

    public function soldsiegeweaponsAction() {
        $id = (int) $this->params()->fromRoute('id');
    }

    public function soldscrollsofmagicAction() {
        $id = (int) $this->params()->fromRoute('id');
    }

    public function buyarmorAction() {
        $countarmour = $this->params()->fromPost('data');
        $totalprice = $this->params()->fromPost('totalprice');

        $id = (int) $this->params()->fromPost('id');
        try {
            $entityManager = $this->entityManager;
            $container = new Container('UserRegistration');
            $value = $container->key;
            $user = $entityManager->getRepository(User::class)->findOneByEmail(
                    ['email' => $value]
            );
            $money = $user->getuMoney();

            if ($money < $totalprice) {
                return new JsonModel(['code' => -2]);
            }
            $user->setuMoney($money - $totalprice);

            $res = $this->userManager->updateUserArmory($id, $countarmour, $value);

            if ($res) {
                return new JsonModel(['code' => 1]);
            }
            return new JsonModel(['code' => -3]);
        } catch (\Exception $e) {
            return new JsonModel(['code' => -1]);
        }
    }

    public function buywarriorsAction() {
        $countarmour = $this->params()->fromPost('data');
        $totalprice = $this->params()->fromPost('totalprice');

        $id = (int) $this->params()->fromPost('id');
        try {
            $entityManager = $this->entityManager;
            $container = new Container('UserRegistration');
            $value = $container->key;
            $user = $entityManager->getRepository(User::class)->findOneByEmail(
                    ['email' => $value]
            );
            $money = $user->getuMoney();

            if ($money < $totalprice) {
                return new JsonModel(['code' => -2]);
            }
            $user->setuMoney($money - $totalprice);

            $res = $this->userManager->updateUserWarriors($id, $countarmour, $value);

            if ($res) {
                return new JsonModel(['code' => 1]);
            }
            return new JsonModel(['code' => -3]);
        } catch (\Exception $e) {
            return new JsonModel(['code' => -1]);
        }
    }

    public function buysiegeweaponsAction() {
        $countarmour = $this->params()->fromPost('data');
        $totalprice = $this->params()->fromPost('totalprice');

        $id = (int) $this->params()->fromPost('id');
        try {
            $entityManager = $this->entityManager;
            $container = new Container('UserRegistration');
            $value = $container->key;
            $user = $entityManager->getRepository(User::class)->findOneByEmail(
                    ['email' => $value]
            );
            $money = $user->getuMoney();

            if ($money < $totalprice) {
                return new JsonModel(['code' => -2]);
            }
            $user->setuMoney($money - $totalprice);

            $res = $this->userManager->updateUserSiegeWeapons($id, $countarmour, $value);

            if ($res) {
                return new JsonModel(['code' => 1]);
            }
            return new JsonModel(['code' => -3]);
        } catch (\Exception $e) {
            return new JsonModel(['code' => -1]);
        }
    }

    public function buyscrollsofmagicAction() {
        $countarmour = $this->params()->fromPost('data');
        $totalprice = $this->params()->fromPost('totalprice');

        $id = (int) $this->params()->fromPost('id');
        try {
            $entityManager = $this->entityManager;
            $container = new Container('UserRegistration');
            $value = $container->key;
            $user = $entityManager->getRepository(User::class)->findOneByEmail(
                    ['email' => $value]
            );
            $money = $user->getuMoney();

            if ($money < $totalprice) {
                return new JsonModel(['code' => -2]);
            }
            $user->setuMoney($money - $totalprice);

            $res = $this->userManager->updateUserscrollsofmagic($id, $countarmour, $value);

            if ($res) {
                return new JsonModel(['code' => 1]);
            }
            return new JsonModel(['code' => -3]);
        } catch (\Exception $e) {
            return new JsonModel(['code' => -1]);
        }
    }

}
