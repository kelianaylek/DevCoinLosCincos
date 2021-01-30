<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LookQuestionsController extends AbstractController
{
    /**
     * @Route("/look_questions", name="look_questions")
     */
    public function index(): Response
    {
        return $this->render('look_questions/look_questions.html.twig', [
            'controller_name' => 'LookQuestionsController',
        ]);
    }
}
