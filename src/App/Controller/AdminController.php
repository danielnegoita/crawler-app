<?php

namespace App\Controller;

use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AdminController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;

        // check if user is authenticated
        if(!$this->authService->isAuthenticated()) {
            throw new AccessDeniedException('You must login first to access this section');
        }
    }

    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        return $this->render('admin.html.twig', [
            'user' => $this->authService->getCredentials()->user
        ]);
    }
}