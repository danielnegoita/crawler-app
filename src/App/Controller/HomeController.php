<?php

namespace App\Controller;

use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @Route("/")
     */
    public function index(): Response
    {
        return $this->render('home.html.twig', [
            'isAuthenticated' => null !== $this->authService->getCredentials()
        ]);
    }

    /**
     * @Route("/sitemap")
     */
    public function sitemap(): Response
    {
        return $this->render('sitemap.html.twig');
    }
}