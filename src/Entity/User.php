<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;

    #[ORM\Column(length: 255)]
    private ?string $name;

    #[ORM\Column(length: 255)]
    private ?string $lastname;

    #[ORM\Column(length: 255)]
    private ?string $phonenumber;

    #[ORM\Column(length: 255, nullable: true)]
    private ?int $verification_code = null;

    #[ORM\Column]
    private ?int $verified = null;
    public function __construct(string $name,string $lastname,int $phonenumber,int $verification_code)
    {
        $this->name = $name;
        $this->lastname = $lastname;
        $this->phonenumber = $phonenumber;
        $this->verification_code = $verification_code;
        $this->verified = 0;
    }

    /**
     * @return int|null
     */
    public function getVerificationCode(): ?int
    {
        return $this->verification_code;
    }
    public function setVerified(int $verified): static
    {
        $this->verified = $verified;

        return $this;
    }

    public function verify(int $verificationCode): void
    {
        if ($this->verification_code !== $verificationCode) {
            throw  new \Exception('invalid verification code');
        }
        $this->verified = 1;
    }

}
