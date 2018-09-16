<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="game_things")
 */
class Gamethings {

    /**
     * @var integer
     *
     * @ORM\Column(name="things_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $things_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name_things", type="string", length=255, nullable=false)
     */
    private $name_things;

    /**
     * @var decimal
     *
     * @ORM\Column(name="cost_things", type="string", length=65, nullable=false)
     */
    private $cost_things;

    /**
     * @ORM\Column(name="attack_things")  
     */
    private $attack_things;

    /**
     * @ORM\Column(name="defence_things")  
     */
    private $defence_things;

    /**
     * @ORM\Column(name="lost_things")  
     */
    private $lost_things;

    /**
     * @ORM\Column(name="img_things")  
     */
    private $img_things;

    /**
     * @ORM\Column(name="strength_things")  
     */
    private $strength_things;

    public function getThings_id() {
        return $this->things_id;
    }

    public function setThings_id($things_id) {
        $this->things_id = $things_id;
    }

    public function getName_things() {
        return $this->name_things;
    }

    public function setName_things($name_things) {
        $this->name_things = $name_things;
    }

    public function getCost_things() {
        return $this->cost_things;
    }

    public function setCost_things($cost_things) {
        $this->cost_things = $cost_things;
    }

    public function getAttack_things() {
        return $this->attack_things;
    }

    public function setAttack_things($attack_things) {
        $this->attack_things = $attack_things;
    }

    public function getDefence_things() {
        return $this->defence_things;
    }

    public function setDefence_things($defence_things) {
        $this->defence_things = $defence_things;
    }

    public function getLost_things() {
        return $this->lost_things;
    }

    public function setDefence_armory($lost_things) {
        $this->lost_things = $lost_things;
    }

    public function getImg_things() {
        return $this->img_things;
    }

    public function setCount_armory($img_things) {
        $this->img_things = $img_things;
    }
    
    public function getStrength_things() {
        return $this->strength_things;
    }
    
    public function setStrength_things($strength_things) {
        $this->strength_things = $strength_things;
    }

}
