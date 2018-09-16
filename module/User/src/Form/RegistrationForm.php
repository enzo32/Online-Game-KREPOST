<?php

namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use User\Validator\UserExistsValidator;
use User\Validator\LoginExistsValidator;

/**
 * This form is used to collect user's email, full name, password and status. The form 
 * can work in two scenarios - 'create' and 'update'. In 'create' scenario, user
 * enters password, in 'update' scenario he/she doesn't enter password.
 */
class RegistrationForm extends Form {

    /**
     * Scenario ('create' or 'update').
     * @var string 
     */
    private $scenario;

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager = null;

    /**
     * Current user.
     * @var User\Entity\User 
     */
    private $user = null;

    /**
     * Constructor.     
     */
    public function __construct($scenario = 'create', $entityManager = null, $user = null) {
        // Define form name
        parent::__construct('registration-form');

        // Set POST method for this form
        $this->setAttribute('method', 'post');
        
        // Save parameters for internal use.
        $this->scenario = $scenario;
        $this->entityManager = $entityManager;
        $this->user = $user;

        $this->addElements();
        $this->addInputFilter();
    }

    /**
     * This method adds elements to form (input fields and submit button).
     */
    protected function addElements() {

        // Add "email" field
        $this->add([
            'type' => 'text',
            'name' => 'email',
            'options' => [
                'label' => 'Ваш e-mail',
            ],
        ]);

        // Add "full_name" field
        $this->add([
            'type' => 'text',
            'name' => 'full_name',
            'options' => [
                'label' => 'Имя',
            ],
        ]);

            // Add "password" field
            $this->add([
                'type' => 'password',
                'name' => 'password',
                'options' => [
                    'label' => 'Пароль',
                ],
            ]);

            // Add "confirm_password" field
            $this->add([
                'type' => 'password',
                'name' => 'confirm_password',
                'options' => [
                    'label' => 'Повторите еще раз пароль',
                ],
            ]);
        
        // Add "FirstName" field
        $this->add([
            'type' => 'text',
            'name' => 'uFirstName',
            'options' => [
                'label' => 'First Name',
            ],
        ]);
        
        // Add "Last Name" field
        $this->add([
            'type' => 'text',
            'name' => 'uLastName',
            'options' => [
                'label' => 'Last Name',
            ],
        ]);
        
         // Add "status" field
        $this->add([
            'type' => 'select',
            'name' => 'uGender',
            'options' => [
                'label' => 'Gender',
                'value_options' => [
                    1 => 'Man',
                    2 => 'Wooman',
                ]
            ],
        ]);
        
        $this->add([
            'type' => 'select',
            'name' => 'uRace',
            'options' => [
                'label' => 'Расса',
                'value_options' => [
                    1 => 'Бессмертный',
                    2 => 'Человек',
                    3 => 'Гоблин',
                    4 => 'Эльф',
                    5 => 'Орк',
                    6 => 'Оборотень'
                ]
            ],
        ]);
        

        // Add the Submit button
        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Зарегестрироватся'
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter() {
        // Create main input filter
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        // Add input for "email" field
        $inputFilter->add([
            'name' => 'email',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 128
                    ],
                ],
                [
                    'name' => 'EmailAddress',
                    'options' => [
                        'allow' => \Zend\Validator\Hostname::ALLOW_DNS,
                        'useMxCheck' => false,
                    ],
                ],
                [
                    'name' => UserExistsValidator::class,
                    'options' => [
                        'entityManager' => $this->entityManager,
                        'user' => $this->user
                    ],
                ],
            ],
        ]);

        // Add input for "full_name" field
        $inputFilter->add([
            'name' => 'full_name',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 512
                    ],
                ],
                [
                    'name' => LoginExistsValidator::class,
                    'options' => [
                        'entityManager' => $this->entityManager,
                        'user' => $this->user
                    ],
                ],
            ],
        ]);
        ////////////////////
        $inputFilter->add([
            'name' => 'uFirstName',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 512
                    ],
                ],
            ],
        ]);
        
        $inputFilter->add([
            'name' => 'uLastName',
            'required' => true,
            'filters' => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 512
                    ],
                ],
            ],
        ]);
        
         // Add input for "status" field
        $inputFilter->add([
            'name' => 'uGender',
            'required' => true,
            'filters' => [
                ['name' => 'ToInt'],
            ],
            'validators' => [
                ['name' => 'InArray', 'options' => ['haystack' => [1, 2]]]
            ],
        ]);
        
        
         // Add input for "status" field
        $inputFilter->add([
            'name' => 'uRace',
            'required' => true,
            'filters' => [
                ['name' => 'ToInt'],
            ],
            'validators' => [
                ['name' => 'InArray', 'options' => ['haystack' => [1, 2,3,4,5,6]]]
            ],
        ]);

            // Add input for "password" field
            $inputFilter->add([
                'name' => 'password',
                'required' => true,
                'filters' => [
                ],
                'validators' => [
                    [
                        'name' => 'StringLength',
                        'options' => [
                            'min' => 6,
                            'max' => 64
                        ],
                    ],
                ],
            ]);

            // Add input for "confirm_password" field
            $inputFilter->add([
                'name' => 'confirm_password',
                'required' => true,
                'filters' => [
                ],
                'validators' => [
                    [
                        'name' => 'Identical',
                        'options' => [
                            'token' => 'password',
                        ],
                    ],
                ],
            ]);
        

        // Add input for "status" field
//        $inputFilter->add([
//            'name' => 'status',
//            'required' => true,
//            'filters' => [
//                ['name' => 'ToInt'],
//            ],
//            'validators' => [
//                ['name' => 'InArray', 'options' => ['haystack' => [1, 2]]]
//            ],
//        ]);
    }

}
