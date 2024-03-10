<?php

namespace App\Services;

use App\Entity\User;
use App\Dto\RegistrationDto;
use App\Repository\UserRepository;

class RegisterService
{
    private UserRepository $userRepository;
    private SmsService $smsService;

    public function __construct(
        UserRepository $userRepository,
        SmsService $smsService
    )
    {
        $this->userRepository = $userRepository;
        $this->smsService = $smsService;
    }

    public function register(RegistrationDto $registrationDto): void
    {
        $verification_code = rand(1, 1000);
        $user = new User(
            $registrationDto->name,
            $registrationDto->lastname,
            $registrationDto->phonenumber,
            $verification_code
        );
        $this->userRepository->save($user);
        $this->smsService->send('',$user->getPhoneNumber());
    }

    /**
     * @throws \Exception
     */
    public function verify(string $phonenumber, int $verificationCode): void
    {
        // tell, don't ask
        // anemic model, rich model
        $user = $this->userRepository->findOneBy(['phonenumber' => $phonenumber]);
        if (!is_null($user)) {
            $user->verify($verificationCode);
        }
        $this->userRepository->save($user);
    }
}