<?php

namespace App\Entity;

class PersonContainer
{
    public function __construct($person, $forms)
    {
        $this->person = $person;
        $this->forms = $forms;
    }

    /**
     * @var Person
     */
    public $person;

    /**
     * @var array
     */
    public $forms;

    /* workflow marking store */
    public $currentPlace;

}