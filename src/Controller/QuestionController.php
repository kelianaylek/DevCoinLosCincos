<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Repository\QuestionsRepository;

class QuestionController extends AbstractController
{
    /**
     * @Route("question/{id}", name="question", defaults={"id" = 0})
     */
    public function index(QuestionsRepository $questionsRepository, $id): Response
    {
        $question = $questionsRepository->find($id);

        return $this->render('question/question.html.twig', compact("question"));
    }
}
