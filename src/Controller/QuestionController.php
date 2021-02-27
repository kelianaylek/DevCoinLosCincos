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
    public function show(QuestionsRepository $questionsRepository, $id): Response
    {
        $question = $questionsRepository->find($id);
        $answers = $question->getAnswers();


        return $this->render(
            'question/question.html.twig',
            [
                "question" => $question,
                "answers" => $answers,
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

    /**
     * @Route("question/edit/{id}", name="question_edit")
     */
    public function edit(Request $request, EntityManagerInterface $em, QuestionsRepository $questionsRepository, $id): Response
    {
        $user = $this->getUser();

        $question = $questionsRepository->find($id);

        $form = $this->createForm(AskQuestionsType::class, $question, ['method' => 'PUT',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setQuestionIsResolved($question->getQuestionIsResolved());
            $question->setQuestionAnswers($question->getQuestionAnswers());
            $question->setQuestionAuthor($user->getUsername());
            $question->setQuestionDate($question->getQuestionDate());

            $question->setQuestionTitle($question->getQuestionTitle());
            $question->setQuestionDescription($question->getQuestionDescription());
            $question->setQuestionCode1($question->getQuestionCode1());
            $question->setQuestionCode2($question->getQuestionCode2());
            $question->setQuestionCode3($question->getQuestionCode3());
            $question->setQuestionCode4($question->getQuestionCode4());
            $question->setQuestionCode5($question->getQuestionCode5());

            $em->persist($question);
            $em->flush();

            return $this->redirectToRoute("myProfile");
        }

        return $this->render(
            'question/edit.html.twig',
            [
                "question" => $question,
                "editQuestion" => $form->createView(),

            ]
        );
    }
}
