<?php

namespace App\Controller;

use Auth0\SDK\Auth0;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

//TODO: refactor
class AdminController extends Controller
{
    private Auth0 $auth0;

    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->auth0 = new Auth0([
            'domain' => $_ENV['AUTH0_DOMAIN'],
            'clientId' => $_ENV['AUTH0_CLIENT_ID'],
            'clientSecret' => $_ENV['AUTH0_CLIENT_SECRET'],
            'cookieSecret' => $_ENV['AUTH0_COOKIE_SECRET']
        ]);

        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        $session = $this->auth0->getCredentials();

        if(!$session) {
            return $this->redirectToRoute('app_admin_login');
        }

        return $this->render('admin.html.twig', [
            'user' => $session->user
        ]);
    }

    /**
     * @Route("/login")
     */
    public function login(): Response
    {
        $this->auth0->clear();

        $authorizeUrl = $this->urlGenerator->generate('app_admin_authorize', [], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->redirect($this->auth0->login($authorizeUrl));
    }

    /**
     * @Route("/logout")
     */
    public function logout(): Response
    {
        $homeUrl = $this->urlGenerator->generate('app_home_index', [], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->redirect($this->auth0->logout($homeUrl));
    }

    /**
     * @Route("/authorize")
     */
    public function authorize(): Response
    {
        $authorizeUrl = $this->urlGenerator->generate('app_admin_authorize', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $this->auth0->exchange($authorizeUrl);

        return $this->redirectToRoute('app_admin_index');
    }
}