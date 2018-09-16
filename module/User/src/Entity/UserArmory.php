<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="userarmory")
 */
class UserArmory {

    /**
     * @var integer
     *
     * @ORM\Column(name="armory_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $armory_id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $user_email;

    /**
     * @var string
     *
     * @ORM\Column(name="id_things", type="integer")
     */
    private $id_things;

    /**
     * @ORM\Column(name="count_armory")  
     */
    private $count_armory;
    
    

     public function getArmory_id(){
         return $this->armory_id;
     }
     
     public function setArmory_id($armory_id){
         $this->armory_id = $armory_id;
     }
     
     public function getUser_email(){
         return $this->user_email;
     }
     public function setUser_email($user_email){
         $this->user_email = $user_email;
     }
     
     public function getId_things(){
         return $this->id_things;
     }
     public function setId_things($id_things){
         $this->id_things = $id_things;
     }
     
     public function getCount_armory() {
         return $this->count_armory;
     }
     public function setCount_armory($count_armory) {
         $this->count_armory = $count_armory;
     }
     

}
