<?php

namespace App\Controller;

use App\Entity\Answers;
use App\Form\AnswersType;
use App\Repository\AnswersRepository;
use App\Repository\QuestionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;


class AnswersController extends AbstractController
{
//    /**
//     * @Route("question/{id}", name="question", defaults={"id" = 0})
//     */
//    public function index(): Response
//    {
//        return $this->render('answers/index.html.twig', [
//            'controller_name' => 'AnswersController',
//        ]);
//    }

    /**
     * @Route("answer/{id}", name="test", defaults={"id" = 0})
     */
    public function create(RequestStack $requestStack, QuestionsRepository $questionsRepository, $id,  EntityManagerInterface $em): Response
    {
        $question = $questionsRepository->find($id);
        $questionAnswers = $question->getQuestionAnswers();
        $user = $this->getUser();


        $answer = new Answers;
        $form = $this->createForm(AnswersType::class, $answer);

        $form->handleRequest($requestStack->getParentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $answer->setAnswerTitle($question->getQuestionTitle());
//            $answer->setAnswerLikes(0);
            $answer->setAnswerAuthor($user->getUsername());
            $answer->setAnswerDate(new \DateTime());
            $answer->setQuestionId($question->addAnswer($answer));
            $question->setQuestionAnswers($questionAnswers + 1);
            $em->persist($answer);
            $em->flush();

            return $this->redirectToRoute("look_questions");
//            return $this->redirect($request->getUri());

        }

        return $this->render(
            'answers/answer.html.twig',
            [
                "newAnswer" => $form->createView(),

            ]
        );
    }
}
