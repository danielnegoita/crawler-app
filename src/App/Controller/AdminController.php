<?php

namespace App\Controller;

use App\Services\AuthService;
use App\Services\AdminService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Finder\Exception\AccessDeniedException;

class AdminController extends Controller
{
    private AuthService $authService;

    private AdminService $adminService;

    public function __construct(AuthService $authService, AdminService $adminService)
    {
        $this->authService = $authService;
        $this->adminService = $adminService;

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
     * @Route("/admin/stats")
     */
    public function stats(Request $request): Response
    {
        return new JsonResponse(
            $this->adminService->internalLinks($request->get('url'))
        );
    }

    /**
     * @Route("/admin/issues")
     */
    public function issues(): Response
    {
        return new JsonResponse(
            $this->adminService->issues()
        );
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
            $this->adminService->crawl($request->get('url'))
        );
    }

}