<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileControllerController extends AbstractController
{
    /**
     * @Route("/profile/controller", name="profile_controller")
     */
    public function index(): Response
    {
        return $this->render('profile_controller/index.html.twig', [
            'controller_name' => 'ProfileControllerController',
        ]);
    }
}
