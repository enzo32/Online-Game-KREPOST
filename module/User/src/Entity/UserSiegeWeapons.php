<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="usersiegeweapons")
 */
class UserSiegeWeapons {

    /**
     * @var integer
     *
     * @ORM\Column(name="IdUserSiegeWeapons", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $IdUserSiegeWeapons;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $user_email;

    /**
     * @ORM\Column(name="SiegeWeaponsId", type="integer")  
     */
    private $SiegeWeaponsId;

    /**
     * @ORM\Column(name="UserSiegeWeaponsCount")  
     */
    private $UserSiegeWeaponsCount;

    public function getIdUserSiegeWeapons() {
        return $this->IdUserSiegeWeapons;
    }

    public function setIdUserSiegeWeapons($IdUserSiegeWeapons) {
        $this->IdUserSiegeWeapons = $IdUserSiegeWeapons;
    }

    public function getUserEmail() {
        return $this->user_email;
    }

    public function setUserEmail($user_email) {
        $this->user_email = $user_email;
    }

    public function getSiegeWeaponsId() {
        return $this->SiegeWeaponsId;
    }

    public function setSiegeWeaponsId($SiegeWeaponsId) {
        $this->SiegeWeaponsId = $SiegeWeaponsId;
    }

    public function getUserSiegeWeaponsCount() {
        return $this->UserSiegeWeaponsCount;
    }

    public function setUserSiegeWeaponsCount($UserSiegeWeaponsCount) {
        $this->UserSiegeWeaponsCount = $UserSiegeWeaponsCount;
    }

}


