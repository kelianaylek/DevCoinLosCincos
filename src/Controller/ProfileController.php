<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\QuestionsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/myProfile", name="myProfile")
     */
    public function showMyProfile(QuestionsRepository $questionsRepository): Response
    {

        $user = $this->getUser();
        $userName = $user->getUsername();

        $questions = $questionsRepository->findUserQuestions($userName);

        return $this->render('profile/myProfile.html.twig', [
            "user" => $user,
            "myQuestions" => $questions,

        ]);
    }
    /**
     * @Route("/profile/{user}", name="profile")
     */
    public function showProfile(UserRepository $userRepository, $user, QuestionsRepository $questionsRepository): Response
    {
        $questions = $questionsRepository->findUserQuestions($user);
        $user = $userRepository->findUserByName($user);
        $user = $user[0];

        return $this->render('profile/profile.html.twig', [
            "user" => $user,
            "myQuestions" => $questions,

        ]);
    }

    /**
     * @Route("/profile_edit", name="edit_profile")
     */
    public function edit(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(ProfileType::class, $user, ['method' => 'PUT',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUsername($user->getUsername());
            $user->setEmail($user->getEmail());
            $user->setPassword($user->getPassword());
            $user->setPlainPassword($user->getPlainPassword());
            $user->setStatus($user->getStatus());
            $user->setStudyYear($user->getStudyYear());
            $user->setDiscordTag($user->getDiscordTag());

//            $user->setImage($user->getImage());
//            dd($user->getImage());

            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("myProfile");
        }

        return $this->render('profile/edit.html.twig', [
            "user" => $user,
            "editProfile" => $form->createView(),


        ]);
    }
}
