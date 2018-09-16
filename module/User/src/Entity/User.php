<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a registered user.
 * @ORM\Entity()
 * @ORM\Table(name="user")
 */
class User 
{
    // User uGender constants.
    const STATUS_MAN         = 'Man'; // Man user.
    const STATUS_WOOMAN      = 'Wooman'; // Wooman user.
    
    //User uRace constants.
    const STATUS_Immortal = 'Бессмертный';
    const STATUS_Human = 'Человек';
    const STATUS_Goblin = 'Гоблин';
    const STATUS_Elf = 'Эльф';
    const STATUS_Orc = 'Орк';
    const STATUS_Werewolf = 'Оборотень';


    /**
     * @ORM\Id
     * @ORM\Column(name="id")
     * @ORM\GeneratedValue
     */
    protected $id;

    /** 
     * @ORM\Column(name="email")  
     */
    protected $email;
    
    /** 
     * @ORM\Column(name="full_name")  
     */
    protected $fullName;

    /** 
     * @ORM\Column(name="password")  
     */
    protected $password;

    /** 
     * @ORM\Column(name="uGender")  
     */
    protected $uGender;
    
    /**
     * @ORM\Column(name="date_created")  
     */
    protected $dateCreated;
        
    /**
     * @ORM\Column(name="pwd_reset_token")  
     */
    protected $passwordResetToken;
    
    /**
     * @ORM\Column(name="pwd_reset_token_creation_date")  
     */
    protected $passwordResetTokenCreationDate;
    
        /**
     * @ORM\Column(name="uImage")  
     */
    protected $uImage;
    
    
    /**
     * @ORM\Column(name="uFirstName")  
     */
    protected $uFirstName ;
    
    
    /**
     * @ORM\Column(name="uLastName")  
     */
    protected $uLastName ;


    
    /**
     * @ORM\Column(name="uMoney")  
     */    
    protected $uMoney;
    
    /**
     * @ORM\Column(name="uRace")  
     */
    protected $uRace;
    
    /**
     * @ORM\Column(name="uLevel")  
     */
    protected $uLevel;

    /**
     * @ORM\Column(name="uNextLevel")  
     */
    protected $uNextLevel;

    /**
     * @ORM\Column(name="uEXP")  
     */
    protected $uEXP;

    /**
     * Returns user ID.
     * @return integer
     */
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Sets user ID. 
     * @param int $id    
     */
    public function setId($id) 
    {
        $this->id = $id;
    }

    /**
     * Returns email.     
     * @return string
     */
    public function getEmail() 
    {
        return $this->email;
    }

    /**
     * Sets email.     
     * @param string $email
     */
    public function setEmail($email) 
    {
        $this->email = $email;
    }
    
    /**
     * Returns full name.
     * @return string     
     */
    public function getFullName() 
    {
        return $this->fullName;
    }       

    /**
     * Sets full name.
     * @param string $fullName
     */
    public function setFullName($fullName) 
    {
        $this->fullName = $fullName;
    }
    
    /**
     * Returns uGender.
     * @return string     
     */
    public function getuGender() 
    {
        return $this->uGender;
    }

    /**
     * Returns possible statuses as array.
     * @return array
     */
    public static function getuGenderList() 
    {
        return [
            self::STATUS_MAN => 'Man',
            self::STATUS_WOOMAN => 'Wooman'
        ];
    }    
    
    /**
     * Returns user status as string.
     * @return string
     */
    public function getuGenderAsString()
    {
        $list = self::getuGenderList();
        if (isset($list[$this->uGender]))
            return $list[$this->uGender];
        
        return 'Unknown';
    }    
    
    /**
     * Sets status.
     * @param int $uGender     
     */
    public function setuGender($uGender) 
    {
        $this->uGender = $uGender;
    }   
    ////////
    
        /**
     * Returns uRace.
     * @return string     
     */
    public function getuRace() 
    {
        return $this->uRace;
    }
    
    /**
     * Returns possible statuses as array.
     * @return array
     */
    public static function getuRaceList() 
    {
        return [
            self::STATUS_Immortal => 'Бессмертный',
            self::STATUS_Human => 'Человек',
            self::STATUS_Goblin => 'Гоблин',
            self::STATUS_Elf => 'Эльф',
            self::STATUS_Orc => 'Орк',
            self::STATUS_Werewolf => 'Оборотень'
        ];
    }    
    
    /**
     * Returns user status as string.
     * @return string
     */
    public function getuRaceAsString()
    {
        $list = self::getuRaceList();
        if (isset($list[$this->uRace]))
            return $list[$this->uRace];
        
        return 'Unknown';
    }    
    
    /**
     * Sets status.
     * @param int $uGender     
     */
    public function setuRace($uRace) 
    {
        $this->uRace = $uRace;
    }   

    //////////////////
    /**
     * Returns password.
     * @return string
     */
    public function getPassword() 
    {
       return $this->password; 
    }
    
    /**
     * Sets password.     
     * @param string $password
     */
    public function setPassword($password) 
    {
        $this->password = $password;
    }
    
    /**
     * Returns the date of user creation.
     * @return string     
     */
    public function getDateCreated() 
    {
        return $this->dateCreated;
    }
    
    /**
     * Sets the date when this user was created.
     * @param string $dateCreated     
     */
    public function setDateCreated($dateCreated) 
    {
        $this->dateCreated = $dateCreated;
    }    
    
    /**
     * Returns password reset token.
     * @return string
     */
    public function getResetPasswordToken()
    {
        return $this->passwordResetToken;
    }
    
    /**
     * Sets password reset token.
     * @param string $token
     */
    public function setPasswordResetToken($token) 
    {
        $this->passwordResetToken = $token;
    }
    
    /**
     * Returns password reset token's creation date.
     * @return string
     */
    public function getPasswordResetTokenCreationDate()
    {
        return $this->passwordResetTokenCreationDate;
    }
    
    /**
     * Sets password reset token's creation date.
     * @param string $date
     */
    public function setPasswordResetTokenCreationDate($date) 
    {
        $this->passwordResetTokenCreationDate = $date;
    }
    
    
    
    /**
     * Returns password reset token's creation date.
     * @return string
     */
    public function getuImage()
    {
        return $this->uImage;
    }
    
    
    /**
     * Sets image reset image.
     * @param string $uImage
     */
    public function setuImage($uImage) 
    {
        $this->uImage = $uImage;
    }
    
    /////////////
    /**
     * Returns FirstName reset token's creation date.
     * @return string
     */
    public function getuFirstName ()
    {
        return $this->uFirstName;
    }
    
    
    /**
     * Sets uFirstName  reset uFirstName .
     * @param string $uFirstName 
     */
    public function setuFirstName($uFirstName) 
    {
        $this->uFirstName = $uFirstName;
    }
    
    /////////////////////////
     /**
     * Returns uLastName reset token's creation date.
     * @return string
     */
    public function getuLastName()
    {
        return $this->uLastName;
    }
    
    
    /**
     * Sets uLastName   reset uLastName  .
     * @param string $uLastName 
     */
    public function setuLastName($uLastName) 
    {
        $this->uLastName = $uLastName;
    }
    
     /**
     * Returns uMoney reset token's creation date.
     * @return  decimal
     */    
    public function getuMoney(){
        return $this->uMoney;
    }
    
    /**
     * Sets uMoney   reset uMoney  .
     * @param decimal $uMoney 
     */
    public function setuMoney($uMoney){
        $this->uMoney = $uMoney;
    }
    
    public function getuLevel() {
        return $this->uLevel;
    }
    
    public function setuLevel($uLevel) {
        $this->uLevel = $uLevel;
    }
    
    public function getuNextLevel() {
        return $this->uNextLevel;
    }
    
    public function setuNextLevel($uNextLevel) {
        $this->uNextLevel = $uNextLevel;
    }
    
    public function getuEXP() {
        return $this->uEXP;
    }
    
    public function setuEXP($uEXP) {
        $this->uEXP = $uEXP;
    }
    
}



