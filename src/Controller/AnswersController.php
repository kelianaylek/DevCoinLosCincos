<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnswersController extends AbstractController
{
    /**
     * @Route("question/{id}", name="question", defaults={"id" = 0})
     */
    public function index(): Response
    {
        return $this->render('answers/index.html.twig', [
            'controller_name' => 'AnswersController',
        ]);
    }

    public function create()
    {

    }
}
