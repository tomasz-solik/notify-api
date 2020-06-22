<?php

namespace App\Controller\Api;

use App\Services\Auth\LoginService;
use App\Services\Auth\RegistrationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UsersController
 * @package App\Controller\Api
 * @Route("/api/users")
 */
class AuthController extends AbstractController
{
    /**
     * @Route("/registration", name="api_users_registration", methods={"POST"})
     * @param Request $request
     * @param RegistrationService $registrationService
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function registration(Request $request, RegistrationService $registrationService)
    {
        return $registrationService->registration($request);
    }

    /**
     * @Route("/login", name="api_users_login", methods={"POST"})
     * @param Request $request
     * @param LoginService $loginService
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function login(Request $request, LoginService $loginService)
    {
        return $loginService->login($request);
    }
}
