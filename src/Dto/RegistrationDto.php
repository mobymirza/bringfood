<?php

namespace App\Dto;

class RegistrationDto
{
    public string $name;
    public string $lastname;
    public int $phonenumber;

    public function __construct(string $name, string $lastname, int $phonenumber)
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->phonenumber = $phonenumber;
    }
}