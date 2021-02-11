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
use Symfony\Component\HttpFoundation\Session\Session;
use App\Form\AskQuestionsType;


class AskQuestionController extends AbstractController
{
    /**
     * @Route("/ask_question", name="ask_question")
     */
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $user = $this->getUser();

        if ($user !== null) {

            $question = new Questions;

            $form = $this->createForm(AskQuestionsType::class, $question);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $question->setQuestionIsResolved(0);
                $question->setQuestionAnswers(0);
                $question->setQuestionLikes(0);
                $question->setQuestionAuthor($user->getUsername());
                $question->setQuestionDate(new \DateTime());
                $em->persist($question);
                $em->flush();

                return $this->redirectToRoute("look_questions");
            }
            return $this->render('ask_question/ask_question.html.twig', [
                "newQuestion" => $form->createView(),
            ]);
        } else {
            return $this->redirectToRoute("app_login");
        }
    }
}
