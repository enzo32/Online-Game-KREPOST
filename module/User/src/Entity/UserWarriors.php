<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="userwarriors")
 */
class UserWarriors {

    /**
     * @var integer
     *
     * @ORM\Column(name="userwarriors_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userwarriors_id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $user_email;

    /**
     * @ORM\Column(name="id_warriors", type="integer")  
     */
    private $id_warriors;

    /**
     * @ORM\Column(name="count_warriors")  
     */
    private $count_warriors;

    public function getUserwarriorsId() {
        return $this->userwarriors_id;
    }

    public function setUserwarriorsId($userwarriors_id) {
        $this->userwarriors_id = $userwarriors_id;
    }

    public function getUserEmail() {
        return $this->user_email;
    }

    public function setUserEmail($user_email) {
        $this->user_email = $user_email;
    }

    public function getIdWarriors() {
        return $this->id_warriors;
    }

    public function setIdWarriors($id_warriors) {
        $this->id_warriors = $id_warriors;
    }

    public function getCountWarriors() {
        return $this->count_warriors;
    }

    public function setCountWarriors($count_warriors) {
        $this->count_warriors = $count_warriors;
    }

}


