<?php

namespace App\Controller;

use App\Entity\AnswerLike;
use App\Entity\Answers;
use App\Form\AnswersType;
use App\Form\AskQuestionsType;
use App\Repository\AnswerLikeRepository;
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
        $form = $this->createForm(AnswersType::class, $answer, array('action' => $this->generateUrl('question', ['id' => $id])));

        $form->handleRequest($requestStack->getParentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $answer->setAnswerTitle($question->getQuestionTitle());
            $answer->setAnswerAuthor($user->getUsername());
            $answer->setAnswerDate(new \DateTime());
            $answer->setQuestionId($question->addAnswer($answer));
            $question->setQuestionAnswers($questionAnswers + 1);
            $em->persist($answer);
            $em->flush();

        }

        return $this->render(
            'answers/answer.html.twig',
            [
                "newAnswer" => $form->createView(),

            ]
        );
    }

    /**
     * @Route("answer/delete/{questionId}/{id}", name="delete_answer")
     */
    public function delete(Request $request, $questionId, RequestStack $requestStack, QuestionsRepository $questionsRepository, AnswersRepository $answerRepository, $id,  EntityManagerInterface $em): Response
    {
        $answer = $answerRepository->find($id);

        $question = $questionsRepository->find($questionId);

        $form = $this->createForm(AskQuestionsType::class, $question, ['method' => 'PUT',
        ]);
        $form->handleRequest($request);
        $question->setQuestionAnswers($question->getQuestionAnswers() - 1);
        $em->persist($question);
        $em->flush();

        $em->remove($answer);
        $em->flush();

        return $this->redirectToRoute('question', ['id' => $questionId]);

    }

    /**
     * @Route("answer/edit/{questionId}/{id}", name="edit_answer")
     */
    public function edit(Request $request, $questionId, AnswersRepository $answerRepository, $id,  EntityManagerInterface $em): Response
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

            return $this->redirectToRoute('question', ['id' => $questionId]);
        }

        return $this->render(
            'answers/edit.html.twig',
            [
                "question" => $answer,
                "editAnswer" => $form->createView(),

            ]
        );

    }

    /**
     * @Route("answer/{id}/like", name="answer_like")
     */
    public function like($id, AnswerLikeRepository $likeRepository, AnswersRepository $answerRepository, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $answer = $answerRepository->find($id);


        if(!$user) return $this->json([
            "code" => 403,
            "message" => "Unauthorized"
        ], 403);

        if($answer->isLikedByUser($user)){
            $like = $likeRepository->findOneBy([
                "answer" => $answer,
                "user" => $user
            ]);

            $em->remove($like);
            $em->flush();

            return $this->json([
                "code" => 200,
                "message" => "Like supprimé",
                "likes" => $likeRepository->count(["answer" => $answer])
            ], 200);

        }

        $like = new AnswerLike();
        $like->setAnswer($answer);
        $like->setUser($user);

        $em->persist($like);
        $em->flush();

        return $this->json([
            "code =>200",
            "message" => "Like bien ajouté",
            "likes" => $likeRepository->count(["answer" => $answer])
            ], 200);
    }
}
