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
use App\Entity\AnswersLikes;
use App\Repository\AnswersLikesRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionController extends AbstractController
{
    /**
     * @Route("question/{id}", name="question", defaults={"id" = 0})
     */
    public function index(QuestionsRepository $questionsRepository, $id, AnswersRepository $answersRepository, EntityManagerInterface $em, Request $request, AnswersLikesRepository $answersLikesRepository): Response
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
            // $answer->setAnswerLikes(0);
            $answer->setAnswerAuthor($user->getUsername());
            $answer->setAnswerDate(new \DateTime());
            $answer->setQuestionId($question->addAnswer($answer));
            $question->setQuestionAnswers($questionAnswers + 1);
            $em->persist($answer);
            $em->flush();

            return $this->redirectToRoute("look_questions");
        }

        // Likes 
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $isAnswerAlreadyLiked = $em->getRepository(AnswersLikes::class)->countByAnswersAndUser($answers, $user);

        // dd($isAnswerAlreadyLiked);

        if ($request->getMethod() === 'POST' && $request->isXmlHttpRequest()) {
            $em = $this->getDoctrine()->getManager();

            $answerId = $request->request->get("entityId");

            $answers = $em->getRepository(Answers::class)->findOneBy(array('id' => $answerId));

            if (!$answers) {
                return new JsonResponse();
            }

            $submittedToken = $request->request->get("csrfToken");

            if ($this->isCsrfTokenValid("answers" . $answers->getId(), $submittedToken)) {
                $user = $this->getUser();

                $answerAlreadyLiked = $em->getRepository(AnswersLikes::class)->findOneBy(array("user" => $user, "answers" => $answers));


                if ($answerAlreadyLiked) {
                    $em->remove($answerAlreadyLiked);
                    $em->flush();
                    return new JsonResponse();
                } else {
                    $like = new AnswersLikes();
                    $like->setUser($user);
                    $like->setAnswers($answers);
                    $em->persist($like);
                    $em->flush();
                }
            }
        }
        // return new JsonResponse();

        return $this->render(
            'question/question.html.twig',
            [
                "id" => $id,
                "question" => $question,
                "answers" => $answers,
                "newAnswer" => $form->createView(),
                "isAnswerAlreadyLiked" => $isAnswerAlreadyLiked
            ]
        );
    }
}
