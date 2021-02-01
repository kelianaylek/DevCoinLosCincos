<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Questions;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\QuestionsRepository;

class LookQuestionsController extends AbstractController
{
    /**
     * @Route("/look_questions", name="look_questions")
     */
    public function index(QuestionsRepository $questionsRepository): Response
    {

        $questions = $questionsRepository->findAll();

        return $this->render('look_questions/look_questions.html.twig', compact("questions"));
    }
}
