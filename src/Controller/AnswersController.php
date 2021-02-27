<?php

namespace App\Controller;

use App\Entity\Answers;
use App\Form\AnswersType;
use App\Form\AskQuestionsType;
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

    /**
     * @Route("answer/delete/{question}/{id}", name="delete_answer")
     */
    public function delete(Request $request, $question, RequestStack $requestStack, QuestionsRepository $questionsRepository, AnswersRepository $answerRepository, $id,  EntityManagerInterface $em): Response
    {
        $answer = $answerRepository->find($id);

        $question = $questionsRepository->find($question);

        $form = $this->createForm(AskQuestionsType::class, $question, ['method' => 'PUT',
        ]);
        $form->handleRequest($request);
        $question->setQuestionAnswers($question->getQuestionAnswers() - 1);
        $em->persist($question);
        $em->flush();

        $em->remove($answer);
        $em->flush();

        return $this->redirectToRoute("look_questions");

    }

    /**
     * @Route("answer/edit/{id}", name="edit_answer")
     */
    public function edit(Request $request, AnswersRepository $answerRepository, $id,  EntityManagerInterface $em): Response
    {
        $answer = $answerRepository->find($id);


        $form = $this->createForm(AnswersType::class, $answer, ['method' => 'PUT',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $answer->setAnswerDescription($answer->getAnswerDescription());
            $answer->setAnswerCode1($answer->getAnswerCode1());
            $answer->setAnswerCode2($answer->getAnswerCode2());
            $answer->setAnswerCode3($answer->getAnswerCode3());
            $answer->setAnswerCode4($answer->getAnswerCode4());
            $answer->setAnswerCode5($answer->getAnswerCode5());

            $em->persist($answer);
            $em->flush();

            return $this->redirectToRoute("look_questions");
        }

        return $this->render(
            'answers/edit.html.twig',
            [
                "question" => $answer,
                "editAnswer" => $form->createView(),

            ]
        );

    }
}
