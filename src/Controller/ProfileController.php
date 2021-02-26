<?php

namespace App\Controller;

use App\Repository\QuestionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/myProfile", name="myProfile")
     */
    public function show(QuestionsRepository $questionsRepository): Response
    {

        $user = $this->getUser();
        $userName = $user->getUsername();

        $questions = $questionsRepository->findUserQuestions($userName);

        return $this->render('profile/myProfile.html.twig', [
            "user" => $user,
            "myQuestions" => $questions,

        ]);
    }
}
