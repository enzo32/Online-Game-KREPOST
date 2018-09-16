<?php

namespace Tournament\Controller;

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
use User\Entity\Listtournament;
use User\Entity\RegtoTournament;
use User\Entity\Gotobuttle;

class TournamentController extends AbstractActionController {

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
        $userManager = $this->userManager;
        $listtournament = $entityManager->getRepository(Listtournament::class)->findAll();
        $list = $this->userManager->loadTournaments($listtournament);
        $container = new Container('UserRegistration');
        $value = $container->key;
        $idtourn = $this->userManager->checkOnRegistrationTournament($value);


        return ['listtournament' => $list, 'idtournament' => $idtourn];
    }

    public function regtoAction() {
        $id = (int) $this->params()->fromPost('id');
        $costtotournament = $this->params()->fromPost('cost');

        try {
            $container = new Container('UserRegistration');
            $value = $container->key;
            $entityManager = $this->entityManager;
            $user = $entityManager->getRepository(User::class)->findOneByEmail(
                    ['email' => $value]
            );

            $money = $user->getuMoney();

            if ($money < $costtotournament) {
                return new JsonModel(['code' => -2]);
            }
            $user->setuMoney($money - $costtotournament);
            $res = $this->userManager->regToTournament($id, $value);

            if ($res !== true) {
                return new JsonModel(['code' => -4]);
            }
            $tour = $entityManager->getRepository(Listtournament::class)->findOneByidlisttournament(
                    ['idlisttournament' => $id]
            );
            $timetour = $tour->getDatelisttournament();
        } catch (Exception $ex) {
            return new JsonModel(['code' => -3]);
        }

        return new JsonModel(['code' => 1, 'timetour' => $timetour]);
    }

    public function unregAction() {
        $id = (int) $this->params()->fromPost('id');
        $costtotournament = (int) $this->params()->fromPost('cost');

        try {
            $container = new Container('UserRegistration');
            $value = $container->key;
            $entityManager = $this->entityManager;
            $user = $entityManager->getRepository(User::class)->findOneByEmail(
                    ['email' => $value]
            );

            $money = $user->getuMoney();

            $user->setuMoney($money + $costtotournament);
            $res = $this->userManager->unRegToTournament($id, $value);
            //var_dump($res);
            //exit();
            if ($res !== true) {
                return new JsonModel(['code' => -1]);
            }
        } catch (Exception $ex) {
            return new JsonModel(['code' => -1]);
        }

        return new JsonModel(['code' => 1]);
    }

    public function startoftournamentAction() {
        $container = new Container('UserRegistration');
        $value = $container->key;
        $entityManager = $this->entityManager;
        $list = $entityManager->getRepository(Listtournament::class)->findAll();
        $tour = $this->entityManager->getRepository(RegtoTournament::class)->findByUsersemail(
                ['usersemail' => $value]
        );
        if ($tour) {
            $result = $this->userManager->gotoButtle($list, $tour);
            //var_dump($result);
            //exit();
            return new JsonModel(['code' => $result]);
        } else {
            return new JsonModel(['code' => -1]);
        }
    }

    public function listusersAction() {
        $time = $this->params()->fromPost('time');
        $container = new Container('UserRegistration');
        $value = $container->key;
        $listtour = $this->entityManager->getRepository(Listtournament::class)->findBydatelisttournament(
                ['datelisttournament' => $time]
        );

        $regtournament = $this->entityManager->getRepository(RegtoTournament::class)->findByusersemail(
                ['usersemail' => $value]
        );
        //$list = $listtour[0]->getIdlisttournament();
        //var_dump($list);
        //exit();
        for ($i = 0; $i < count($regtournament); $i++) {
            if ($regtournament[$i]->getTournamentid() === $listtour[0]->getIdlisttournament()) {
                $this->entityManager->remove($regtournament[$i]);
                $this->entityManager->flush();
                //так же необходимо удалить сам турнир из главного списка турниров
                //(хотя тут нужно подумать). Пока не буду делать, оставляю для тестов; 
            }
        }

        $gotobuttle = new Gotobuttle();
        $gotobuttle->setIdtournament($listtour[0]->getIdlisttournament());
        $gotobuttle->setEmailusers($value);
        $gotobuttle->setPrize($listtour[0]->getPrizefund());
        $this->entityManager->persist($gotobuttle);
        $this->entityManager->flush();

        return new JsonModel(['code' => 1]);
    }

}
