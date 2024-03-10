<?php

namespace App\Controller;

use App\Dto\RegistrationDto;
use App\Services\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'registration',methods: 'POST')]
    public function register(RegisterService $registerService, Request $request): Response
    {
            $registrationDto = new RegistrationDto(
            $request->request->get('name'),
            $request->request->get('lastname'),
            $request->request->get('phonenumber'),
        );
        $registerService->register($registrationDto);

        return  $this->json(['message' => 'Registration was successful'],201);
    }

    /**
     * @throws \Exception
     */
    #[Route('/register/verify', name: 'verification',methods: 'GET')]

    public function verify(RegisterService $registerService, Request $request): JsonResponse
    {
        $phoneNumber= $request->query->get('phonenumber');
        $verificationCode= $request->query->get('verificationCode');
        $registerService->verify($phoneNumber,$verificationCode);
        return  $this->json(['message' => 'Verification was successful'],201);
    }




}
