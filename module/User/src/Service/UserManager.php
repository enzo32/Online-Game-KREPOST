<?php

namespace User\Service;

use User\Entity\User;
use User\Entity\UserArmory;
use User\Entity\UserWarriors;
use User\Entity\UserSiegeWeapons;
use User\Entity\Userscrollsofmagic;
use Zend\Crypt\Password\Bcrypt;
use Zend\Math\Rand;
use User\Entity\RegtoTournament;
use DateTime;

/**
 * This service is responsible for adding/editing users
 * and changing user password.
 */
class UserManager {

    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($entityManager) {
        $this->entityManager = $entityManager;
    }

    public function loadUsersThings($userarmory) {
        if (isset($userarmory)) {
            $sett = [];
            for ($i = 0; $i < count($userarmory); $i++) {
                $sett[$i]['id_things'] = $userarmory[$i]->getId_things();
                $sett[$i]['count_armory'] = $userarmory[$i]->getCount_armory();
            }
            return $sett;
        }
        return 0;
    }

    public function loadUsersWariors($usWar) {
        if (isset($usWar)) {
            $sett = [];
            for ($i = 0; $i < count($usWar); $i++) {
                $sett[$i]['id_warriors'] = $usWar[$i]->getIdWarriors();
                $sett[$i]['count_warriors'] = $usWar[$i]->getCountWarriors();
            }
            return $sett;
        }
        return 0;
    }

    public function loaduserSiegeWeapons($uSW) {
        if (isset($uSW)) {
            $sett = [];
            for ($i = 0; $i < count($uSW); $i++) {
                $sett[$i]['SiegeWeaponsId'] = $uSW[$i]->getSiegeWeaponsId();
                $sett[$i]['UserSiegeWeaponsCount'] = $uSW[$i]->getUserSiegeWeaponsCount();
            }
            return $sett;
        }
        return 0;
    }

    public function loadUserscrollsofmagic($uSoMagic) {
        if (isset($uSoMagic)) {
            $sett = [];
            for ($i = 0; $i < count($uSoMagic); $i++) {
                $sett[$i]['scrollsofmagicId'] = $uSoMagic[$i]->getScrollsofmagicId();
                $sett[$i]['scrollsofmagicCount'] = $uSoMagic[$i]->getScrollsofmagicCount();
            }
            return $sett;
        }
        return 0;
    }

    public function loadDataThings($gameThings) {
        $sett = [];
        for ($i = 0; $i < count($gameThings); $i++) {
            $sett[$i]['things_id'] = $gameThings[$i]->getThings_id();
            $sett[$i]['name_things'] = $gameThings[$i]->getName_things();
            $sett[$i]['cost_things'] = $gameThings[$i]->getCost_things();
            $sett[$i]['attack_things'] = $gameThings[$i]->getAttack_things();
            $sett[$i]['defence_things'] = $gameThings[$i]->getDefence_things();
            $sett[$i]['lost_things'] = $gameThings[$i]->getLost_things();
            $sett[$i]['img_things'] = $gameThings[$i]->getImg_things();
            $sett[$i]['strength_things'] = $gameThings[$i]->getStrength_things();
        }


        return $sett;
    }

    public function loadDataWarriors($war) {
        $sett = [];
        for ($i = 0; $i < count($war); $i++) {
            $sett[$i]['idwarriors'] = $war[$i]->getIdwarriors();
            $sett[$i]['namewarriors'] = $war[$i]->getNamewarriors();
            $sett[$i]['costwarriors'] = $war[$i]->getCostwarriors();
            $sett[$i]['lostwarriors'] = $war[$i]->getLostwarriors();
            $sett[$i]['attackwarriors'] = $war[$i]->getAttackwarriors();
            $sett[$i]['deffencewarriors'] = $war[$i]->getDeffencewarriors();
            $sett[$i]['imgwarriors'] = $war[$i]->getImgwarriors();
            $sett[$i]['hplifewarriors'] = $war[$i]->getHplifewarriors();
        }

        return $sett;
    }

    public function loadDataSiegeWeapons($SiegeWeapons) {
        $sett = [];
        for ($i = 0; $i < count($SiegeWeapons); $i++) {
            $sett[$i]['idSiegeWeapons'] = $SiegeWeapons[$i]->getidSiegeWeapons();
            $sett[$i]['NameSiegeWeapons'] = $SiegeWeapons[$i]->getNameSiegeWeapons();
            $sett[$i]['CostSiegeWeapons'] = $SiegeWeapons[$i]->getCostSiegeWeapons();
            $sett[$i]['LostSiegeWeapons'] = $SiegeWeapons[$i]->getLostSiegeWeapons();
            $sett[$i]['AttackSiegeWeapons'] = $SiegeWeapons[$i]->getAttackSiegeWeapons();
            $sett[$i]['DeffenceSiegeWeapons'] = $SiegeWeapons[$i]->getDeffenceSiegeWeapons();
            $sett[$i]['ImgSiegeWeapons'] = $SiegeWeapons[$i]->getImgSiegeWeapons();
        }

        return $sett;
    }

    public function loadDataScrollsOfMagic($ScrollsOfMagic) {
        $sett = [];
        for ($i = 0; $i < count($ScrollsOfMagic); $i++) {
            $sett[$i]['idScrollsOfMagic'] = $ScrollsOfMagic[$i]->getidScrollsOfMagic();
            $sett[$i]['NameScrollsOfMagic'] = $ScrollsOfMagic[$i]->getNameScrollsOfMagic();
            $sett[$i]['CostScrollsOfMagic'] = $ScrollsOfMagic[$i]->getCostScrollsOfMagic();
            $sett[$i]['LostScrollsOfMagic'] = $ScrollsOfMagic[$i]->getLostScrollsOfMagic();
            $sett[$i]['AttackScrollsOfMagic'] = $ScrollsOfMagic[$i]->getAttackScrollsOfMagic();
            $sett[$i]['DeffenceScrollsOfMagic'] = $ScrollsOfMagic[$i]->getDeffenceScrollsOfMagic();
            $sett[$i]['ImgScrollsOfMagic'] = $ScrollsOfMagic[$i]->getImgScrollsOfMagic();
            $sett[$i]['scrollsofmagicMP'] = $ScrollsOfMagic[$i]->getScrollsofmagicMP();
        }

        return $sett;
    }

    public function loadTournaments($listtournament) {
        $sett = [];
        for ($i = 0; $i < count($listtournament); $i++) {
            $sett[$i]['idlisttournament'] = $listtournament[$i]->getIdlisttournament();
            $sett[$i]['datelisttournament'] = $listtournament[$i]->getDatelisttournament();
            $sett[$i]['nametournament'] = $listtournament[$i]->getNametournament();
            $sett[$i]['maxcountlisttournament'] = $listtournament[$i]->getMaxcountlisttournament();
            $sett[$i]['prizefund'] = $listtournament[$i]->getPrizefund();
            $sett[$i]['costofregistration'] = $listtournament[$i]->getCostofregistration();
        }

        return $sett;
    }

    public function countUsersWarriors($usWar) {
        $count = 0;
        for ($i = 0; $i < count($usWar); $i++) {
            $count += $usWar[$i]->getCountWarriors();
        }
        return $count;
    }

    public function countUserSiegeWeapons($uSW) {
        $count = 0;
        for ($i = 0; $i < count($uSW); $i++) {
            $count += $uSW[$i]->getUserSiegeWeaponsCount();
        }
        return $count;
    }
    
    public function loadListButtle($gotoButtle){
        $sett = [];
        for ($i = 0; $i < count($gotoButtle); $i++) {
            $sett[$i]['idtournament'] = $gotoButtle[$i]->getIdtournament();
            $sett[$i]['prize'] = $gotoButtle[$i]->getPrize();
            $sett[$i]['woninbuttle'] = $gotoButtle[$i]->getWoninbuttle();
            //$sett[$i]['maxcountlisttournament'] = $listtournament[$i]->getMaxcountlisttournament();
            //$sett[$i]['prizefund'] = $listtournament[$i]->getPrizefund();
            //$sett[$i]['costofregistration'] = $listtournament[$i]->getCostofregistration();
        }

        return $sett;
    }

    public function buyArmoryUsers() {
        
    }

    /**
     * This method adds a new user.
     */
    public function addUser($data) {
        if ($this->checkUserExists($data['email'])) {
            throw new \Exception("User with email address " . $data['email'] . " already exists");
        }
        if ($this->checkUserLogin($data['full_name'])) {
            throw new \Exception("User with Login '" . $data['full_name'] . "' already exists");
        }

        $user = new User();
        $user->setEmail($data['email']);
        $user->setFullName($data['full_name']);
        $user->setuFirstName($data['uFirstName']);
        $user->setuLastName($data['uLastName']);
        $user->setuMoney(0);
        $user->setuGender($data['uGender']);
        $user->setuRace($data['uRace']);
        $user->setuLevel(0);
        $user->setuEXP(0);
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($data['password']);
        $user->setPassword($passwordHash);
        $currentDate = date('Y-m-d H:i:s');
        $user->setDateCreated($currentDate);

        $this->entityManager->persist($user);

        $this->entityManager->flush();

        return $user;
    }

    /**
     * This method updates data of an existing user.
     */
    public function updateUser($user, $data) {
        // Do not allow to change user email if another user with such email already exits.
        if ($user->getEmail() != $data['email'] && $this->checkUserExists($data['email'])) {
            throw new \Exception("Another user with email address " . $data['email'] . " already exists");
        }

        $user->setEmail($data['email']);
        $user->setFullName($data['full_name']);
        $user->setStatus($data['status']);

        // Apply changes to database.
        $this->entityManager->flush();

        return true;
    }

    public function updateUserArmory($id, $countarmour, $email) {
        $userArmory = $this->entityManager->getRepository(UserArmory::class)->findBy(
                ['user_email' => $email]);

        if (isset($userArmory)) {
            for ($i = 0; $i < count($userArmory); $i++) {
                if ($userArmory[$i]->getId_things() === $id) {
                    $count = $userArmory[$i]->getCount_armory();
                    $userArmory[$i]->setCount_armory($count + $countarmour);
                    $this->entityManager->persist($userArmory[$i]);
                    $this->entityManager->flush();
                    return true;
                }
            }
        }

        $armor = new UserArmory();
        $armor->setUser_email($email);
        $armor->setId_things($id);
        $armor->setCount_armory($countarmour);

        $this->entityManager->persist($armor);
        $this->entityManager->flush();
        return true;
    }

    public function updateUserWarriors($id, $countarmour, $email) {
        $userWarriors = $this->entityManager->getRepository(UserWarriors::class)->findBy(
                ['user_email' => $email]);

        if (isset($userWarriors)) {
            for ($i = 0; $i < count($userWarriors); $i++) {
                if ($userWarriors[$i]->getIdWarriors() === $id) {
                    $count = $userWarriors[$i]->getCountWarriors();
                    $userWarriors[$i]->setCountWarriors($count + $countarmour);
                    $this->entityManager->persist($userWarriors[$i]);
                    $this->entityManager->flush();
                    return true;
                }
            }
        }

        $warriors = new UserWarriors();
        $warriors->setUserEmail($email);
        $warriors->setIdWarriors($id);
        $warriors->setCountWarriors($countarmour);

        $this->entityManager->persist($warriors);
        $this->entityManager->flush();
        return true;
    }

    public function updateUserSiegeWeapons($id, $countarmour, $email) {
        $UserSiegeWeapons = $this->entityManager->getRepository(UserSiegeWeapons::class)->findBy(
                ['user_email' => $email]);

        if (isset($UserSiegeWeapons)) {
            for ($i = 0; $i < count($UserSiegeWeapons); $i++) {
                if ($UserSiegeWeapons[$i]->getSiegeWeaponsId() === $id) {
                    $count = $UserSiegeWeapons[$i]->getUserSiegeWeaponsCount();
                    $UserSiegeWeapons[$i]->setUserSiegeWeaponsCount($count + $countarmour);
                    $this->entityManager->persist($UserSiegeWeapons[$i]);
                    $this->entityManager->flush();
                    return true;
                }
            }
        }

        $SiegeWeapons = new UserSiegeWeapons();
        $SiegeWeapons->setUserEmail($email);
        $SiegeWeapons->setSiegeWeaponsId($id);
        $SiegeWeapons->setUserSiegeWeaponsCount($countarmour);

        $this->entityManager->persist($SiegeWeapons);
        $this->entityManager->flush();
        return true;
    }

    public function updateUserscrollsofmagic($id, $countarmour, $email) {
        $Userscrollsofmagic = $this->entityManager->getRepository(Userscrollsofmagic::class)->findBy(
                ['user_email' => $email]);

        if (isset($Userscrollsofmagic)) {
            for ($i = 0; $i < count($Userscrollsofmagic); $i++) {
                if ($Userscrollsofmagic[$i]->getScrollsofmagicId() === $id) {
                    $count = $Userscrollsofmagic[$i]->getScrollsofmagicCount();
                    $Userscrollsofmagic[$i]->setScrollsofmagicCount($count + $countarmour);
                    $this->entityManager->persist($Userscrollsofmagic[$i]);
                    $this->entityManager->flush();
                    return true;
                }
            }
        }

        $UscrollsOfMagic = new Userscrollsofmagic();
        $UscrollsOfMagic->setUserEmail($email);
        $UscrollsOfMagic->setScrollsofmagicId($id);
        $UscrollsOfMagic->setScrollsofmagicCount($countarmour);

        $this->entityManager->persist($UscrollsOfMagic);
        $this->entityManager->flush();
        return true;
    }

    public function loadDataUsers($email) {
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($email);
        $set = [];
        for ($i = 0; $i < count($user); $i++) {
            $set[$i]['email'] = $user->getEmail();
            $set[$i]['full_name'] = $user->getFullName();
            $set[$i]['uGender'] = $user->getuGender();
            $set[$i]['uFirstName'] = $user->getuFirstName();
            $set[$i]['uLastName'] = $user->getuLastName();
            $set[$i]['uMoney'] = $user->getuMoney();
            $set[$i]['uRace'] = $user->getuRace();
            $set[$i]['uLevel'] = $user->getuLevel();
            $set[$i]['uNextLevel'] = $user->getuNextLevel();
            $set[$i]['uEXP'] = $user->getuEXP();
        }

        return $set;
    }

    public function checkOnRegistrationTournament($email) {
        $tour = $this->entityManager->getRepository(RegtoTournament::class)->findByUsersemail(
                ['usersemail' => $email]
        );
        $count = [];
        for ($i = 0; $i < count($tour); $i++) {
            $count[$i] = (int) $tour[$i]->getTournamentid();
        }
        return $count;
    }

    public function regToTournament($id, $email) {
        $tour = $this->entityManager->getRepository(RegtoTournament::class)->findByUsersemail(
                ['usersemail' => $email]
        );

        for ($i = 0; $i < count($tour); $i++) {
            if ((int) $tour[$i]->getTournamentid() === $id) {
                return -4;
            }
        }
        $tournament = new RegtoTournament();
        $tournament->setTournamentid($id);
        $tournament->setUsersemail($email);

        $this->entityManager->persist($tournament);
        $this->entityManager->flush();
        return true;
    }

    public function unRegToTournament($id, $email) {
        $tour = $this->entityManager->getRepository(RegtoTournament::class)->findByUsersemail(
                ['usersemail' => $email]
        );
        for ($i = 0; $i < count($tour); $i++) {
            if ((int) $tour[$i]->getTournamentid() === $id) {
                //$tournament = (int) $tour[$i]->getTournamentid();
                $this->entityManager->remove($tour[$i]);
                $this->entityManager->flush();
                return true;
            }
        }
    }

    public function checkUserExists($email) {

        $user = $this->entityManager->getRepository(User::class)
                ->findOneByEmail($email);

        return $user !== null;
    }

    public function checkUserLogin($login) {
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByfull_name($login);

        return $user !== null;
    }

    /**
     * Checks that the given password is correct.
     */
    public function validatePassword($user, $password) {
        $bcrypt = new Bcrypt();
        $passwordHash = $user->getPassword();

        if ($bcrypt->verify($password, $passwordHash)) {
            return true;
        }

        return false;
    }

    /**
     * Generates a password reset token for the user. This token is then stored in database and 
     * sent to the user's E-mail address. When the user clicks the link in E-mail message, he is 
     * directed to the Set Password page.
     */
    public function generatePasswordResetToken($user) {
        // Generate a token.
        $token = Rand::getString(32, '0123456789abcdefghijklmnopqrstuvwxyz', true);
        $user->setPasswordResetToken($token);

        $currentDate = date('Y-m-d H:i:s');
        $user->setPasswordResetTokenCreationDate($currentDate);

        $this->entityManager->flush();

        $subject = 'Password Reset';

        $httpHost = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        $passwordResetUrl = 'http://' . $httpHost . '/set-password?token=' . $token;

        $body = 'Please follow the link below to reset your password:\n';
        $body .= "$passwordResetUrl\n";
        $body .= "If you haven't asked to reset your password, please ignore this message.\n";

        // Send email to user.
        mail($user->getEmail(), $subject, $body);
    }

    /**
     * Checks whether the given password reset token is a valid one.
     */
    public function validatePasswordResetToken($passwordResetToken) {
        $user = $this->entityManager->getRepository(User::class)
                ->findOneByPasswordResetToken($passwordResetToken);

        if ($user == null) {
            return false;
        }

        $tokenCreationDate = $user->getPasswordResetTokenCreationDate();
        $tokenCreationDate = strtotime($tokenCreationDate);

        $currentDate = strtotime('now');

        if ($currentDate - $tokenCreationDate > 24 * 60 * 60) {
            return false; // expired
        }

        return true;
    }

    /**
     * This method sets new password by password reset token.
     */
    public function setNewPasswordByToken($passwordResetToken, $newPassword) {
        if (!$this->validatePasswordResetToken($passwordResetToken)) {
            return false;
        }

        $user = $this->entityManager->getRepository(User::class)
                ->findOneByPasswordResetToken($passwordResetToken);

        if ($user == null) {
            return false;
        }

        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);

        // Remove password reset token
        $user->setPasswordResetToken(null);
        $user->setPasswordResetTokenCreationDate(null);

        $this->entityManager->flush();

        return true;
    }

    /**
     * This method is used to change the password for the given user. To change the password,
     * one must know the old password.
     */
    public function changePassword($user, $data) {
        $oldPassword = $data['old_password'];

        // Check that old password is correct
        if (!$this->validatePassword($user, $oldPassword)) {
            return false;
        }

        $newPassword = $data['new_password'];

        // Check password length
        if (strlen($newPassword) < 6 || strlen($newPassword) > 64) {
            return false;
        }

        // Set new password for user        
        $bcrypt = new Bcrypt();
        $passwordHash = $bcrypt->create($newPassword);
        $user->setPassword($passwordHash);

        // Apply changes
        $this->entityManager->flush();

        return true;
    }

    public function gotoButtle($list, $tour) {
        $z = 0;
        $timemass = [];
        date_default_timezone_set('Europe/Kiev');
        //$currentDate = date('Y-m-d H:i:s');
        //var_dump($tour);
        //exit();
        //var_dump($tour);
        //exit();
        for ($i = 0; $i < count($list); $i++) {
            //var_dump($tour[$z]->getTournamentid());
            if (!empty($tour[$z])) {
                if ($list[$i]->getIdlisttournament() == $tour[$z]->getTournamentid()) {
                    $timemass['idtour'][$i] = $list[$i]->getIdlisttournament();
                    $timemass['timetour'][$i] = $list[$i]->getDatelisttournament();
                    $z++;
                }
            }
        }


        
        return $timemass;
    }

}
