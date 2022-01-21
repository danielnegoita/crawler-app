<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class Controller extends AbstractController
{
    /**
     * @inheritDoc
     */
    public static function getSubscribedServices(): array
    {
        return AbstractController::getSubscribedServices();
    }
}