<?php

namespace App\Controller;

use App\Services\AuthService;
use App\Services\LinkService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AdminController extends Controller
{
    private AuthService $authService;

    private LinkService $linkService;

    public function __construct(AuthService $authService, LinkService $linkService)
    {
        $this->authService = $authService;
        $this->linkService = $linkService;

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
    /**
     * @Route("/admin/crawl")
     *
     * @param Request $request
     * @return Response
     */
    public function crawl(Request $request): Response
    {
        return new JsonResponse(
            $this->linkService->pageInternalLinks($request->get('url'))
        );
    }

}