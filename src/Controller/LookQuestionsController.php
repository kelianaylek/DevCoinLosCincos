<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LookQuestionsController extends AbstractController
{
    /**
     * @Route("/look/questions", name="look_questions")
     */
    public function index(): Response
    {
        return $this->render('look_questions/index.html.twig', [
            'controller_name' => 'LookQuestionsController',
        ]);
    }
}
