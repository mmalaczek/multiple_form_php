<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Person
{
    /**
     * @var string
     * @Assert\Length(
     * min=2,
     * max=42,
     * minMessage = "superadmin.lastname.too.short",
     * maxMessage = "superadmin.lastname.too.long"
     * )
     * @Assert\Regex(pattern="/^[a-zÀ-ÿąćęłńóśźżĄĆĘŁŃÓŚŹŻẞĀāĂăČčĐđĎďĒēĕĖėĚěĢģĪīĮįĶķĹĺĻļĽľŅņŇňŌōŐőŒœŕŖŗŘřŞşŠšŢţťŰűŲųŸŽž\- ]+$/i",
     * htmlPattern = "^[a-zA-ZÀ-ÿąćęłńóśźżĄĆĘŁŃÓŚŹŻẞĀāĂăČčĐđĎďĒēĕĖėĚěĢģĪīĮįĶķĹĺĻļĽľŅņŇňŌōŐőŒœŕŖŗŘřŞşŠšŢţťŰűŲųŸŽž\- ]+$",
     * message="card.lastname.onlyalpha")
     */
    protected $name;

    protected $gender;

    /**
     * @var int
     * @Assert\Length(min=1, max=100, maxMessage = "Wiek musi być w przedziale 1-100")
     */
    protected $age;

    protected $colors;

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
     * @return string
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
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