<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileControllerController extends AbstractController
{
    /**
     * @Route("/profile", name="profile_controller")
     */
    public function index(): Response
    {
        return $this->render('profile_controller/profile.html.twig', [
            'controller_name' => 'ProfileControllerController',
        ]);
    }
}
