<?php

namespace App\Controller;

use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        $credentials = $this->authService->getCredentials();

        if(!$credentials) {
            return $this->redirectToRoute('app_security_login');
        }

        return $this->render('admin.html.twig', [
            'user' => $credentials->user
        ]);
    }
}