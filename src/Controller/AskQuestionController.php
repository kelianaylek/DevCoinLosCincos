<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AskQuestionController extends AbstractController
{
    /**
     * @Route("/ask_question", name="ask_question")
     */
    public function index(): Response
    {
        return $this->render('ask_question/ask_question.html.twig', [
            'controller_name' => 'AskQuestionController',
        ]);
    }
}
