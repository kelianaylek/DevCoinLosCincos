<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AnswersType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\QuestionsRepository;
use App\Repository\AnswersRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Answers;




class QuestionController extends AbstractController
{
    /**
     * @Route("question/{id}", name="question", defaults={"id" = 0})
     */
    public function index(QuestionsRepository $questionsRepository, $id, AnswersRepository $answersRepository, EntityManagerInterface $em, Request $request): Response
    {
        $question = $questionsRepository->find($id);
        $questionAnswers = $question->getQuestionAnswers();

        $answers = $question->getAnswers();

        // dd($questionAnswers);
        $user = $this->getUser();


        $answer = new Answers;
        $form = $this->createForm(AnswersType::class, $answer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $answer->setAnswerTitle($question->getQuestionTitle());
            $answer->setAnswerLikes(0);
            $answer->setAnswerAuthor($user->getUsername());
            $answer->setAnswerDate(new \DateTime());
            $answer->setQuestionId($question->addAnswer($answer));

            $question->setQuestionAnswers($questionAnswers + 1);


            $em->persist($answer);
            $em->flush();

            return $this->redirectToRoute("look_questions");
        }



        return $this->render(
            'question/question.html.twig',
            [
                "question" => $question,
                "answers" => $answers,
                "newAnswer" => $form->createView(),
            ]
        );
    }
}
