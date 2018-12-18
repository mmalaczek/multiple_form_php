<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Person
{
    /**
     * @var array
     */
    public static $genderList = [
        'Kobieta',
        'Mężczyzna',
    ];

    /**
     * @var array
     */
    public static $colorList = [
        'biały',
        'czerwony',
        'niebieski',
        'zielony',
        'żółty',
        'czarny',
    ];

    /**
     * @var string
     * @Assert\Length(
     * min=2,
     * max=42,
     * minMessage = "Imię musi mieć minimum 2 znaki",
     * maxMessage = "Imię może zawierać max 42 znaki"
     * )
     * @Assert\Regex(pattern="/^[a-zÀ-ÿąćęłńóśźżĄĆĘŁŃÓŚŹŻẞĀāĂăČčĐđĎďĒēĕĖėĚěĢģĪīĮįĶķĹĺĻļĽľŅņŇňŌōŐőŒœŕŖŗŘřŞşŠšŢţťŰűŲųŸŽž\- ]+$/i",
     * htmlPattern = "^[a-zA-ZÀ-ÿąćęłńóśźżĄĆĘŁŃÓŚŹŻẞĀāĂăČčĐđĎďĒēĕĖėĚěĢģĪīĮįĶķĹĺĻļĽľŅņŇňŌōŐőŒœŕŖŗŘřŞşŠšŢţťŰűŲųŸŽž\- ]+$",
     * message="Nieprawidłowe znaki")
     */
    protected $name;

    /**
     * @var int
     */
    protected $gender;

    /**
     * @var int
     * @Assert\Range(min=1, max=100, maxMessage = "Wiek musi być w przedziale 1-100")
     */
    protected $age;

    protected $colors = [];

    /**
     * @var bool
     */
    protected $canSwim;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getGender(): ?int
    {
        return $this->gender;
    }

    /**
     * @param int $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return int
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    public function getColors()
    {
        return $this->colors;
    }

    public function setColors($colors): void
    {
        $this->colors = $colors;
    }

    public function getCountColors()
    {
        return \count($this->colors);
    }

    /**
     * @return bool
     */
    public function getCanSwim(): ?bool
    {
        return $this->canSwim;
    }

    /**
     * @param bool $canSwim
     */
    public function setCanSwim($canSwim): void
    {
        $this->canSwim = $canSwim;
    }

}