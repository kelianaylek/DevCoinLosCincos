<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\AskQuestionsType;
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
     * @Route("/look_questions", name="look_questions")
     */
    public function index(QuestionsRepository $questionsRepository): Response
    {

        $questions = $questionsRepository->findAll();

        return $this->render('look_questions/look_questions.html.twig', compact("questions"));
    }


    /**
     * @Route("question/{id}", name="question", defaults={"id" = 0})
     */
    public function show(QuestionsRepository $questionsRepository, $id, AnswersRepository $answersRepository, EntityManagerInterface $em, Request $request): Response
    {
        $question = $questionsRepository->find($id);
        $questionAnswers = $question->getQuestionAnswers();
        $answers = $question->getAnswers();
        $user = $this->getUser();


        $answer = new Answers;
        $form = $this->createForm(AnswersType::class, $answer);
        $form->handleRequest($request);

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

    /**
     * @Route("/ask_question", name="ask_question")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {

        $user = $this->getUser();

        if ($user !== null) {

            $question = new Questions;

            $form = $this->createForm(AskQuestionsType::class, $question);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $question->setQuestionIsResolved(0);
                $question->setQuestionAnswers(0);
//                $question->setQuestionLikes(0);
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
