<?php

namespace App\Controller;

use App\Services\AuthService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdminController extends Controller
{
    private AuthService $authService;

    private UrlGeneratorInterface $urlGenerator;

    public function __construct(AuthService $authService, UrlGeneratorInterface $urlGenerator)
    {
        $this->authService = $authService;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        $credentials = $this->authService->getCredentials();

        if(!$credentials) {
            return $this->redirectToRoute('app_admin_login');
        }

        return $this->render('admin.html.twig', [
            'user' => $credentials->user
        ]);
    }

    /**
     * @Route("/login")
     */
    public function login(): Response
    {
        $authorizeUrl = $this->urlGenerator->generate('app_admin_authorize', [], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->redirect($this->authService->login($authorizeUrl));
    }

    /**
     * @Route("/logout")
     */
    public function logout(): Response
    {
        $homeUrl = $this->urlGenerator->generate('app_home_index', [], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->redirect($this->authService->logout($homeUrl));
    }

    /**
     * @Route("/authorize")
     */
    public function authorize(): Response
    {
        $authorizeUrl = $this->urlGenerator->generate('app_admin_authorize', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $this->authService->exchange($authorizeUrl);

        return $this->redirectToRoute('app_admin_index');
    }
}