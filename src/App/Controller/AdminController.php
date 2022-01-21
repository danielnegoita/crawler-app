<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function index(): Response
    {
        return $this->render('admin.html.twig');
    }
}