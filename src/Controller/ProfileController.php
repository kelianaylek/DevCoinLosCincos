<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use App\Repository\AnswersRepository;
use App\Repository\QuestionsRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


class ProfileController extends AbstractController
{
    /**
     * @Route("/myProfile", name="myProfile")
     */
    public function showMyProfile(AnswersRepository $answersRepository, QuestionsRepository $questionsRepository): Response
    {

        $user = $this->getUser();
        $userName = $user->getUsername();

        $questions = $questionsRepository->findUserQuestions($userName);

        $myAnswers = $answersRepository->findUserAnswers($userName);
        $answersCount = count($myAnswers);

        return $this->render('profile/myProfile.html.twig', [
            "user" => $user,
            "myQuestions" => $questions,
            "answersCount" => $answersCount,

        ]);
    }
    /**
     * @Route("/profile/{user}", name="profile")
     */
    public function showProfile(AnswersRepository $answersRepository, UserRepository $userRepository, $user, QuestionsRepository $questionsRepository): Response
    {
        $myAnswers = $answersRepository->findUserAnswers($user);
        $answersCount = count($myAnswers);

        $questions = $questionsRepository->findUserQuestions($user);
        $user = $userRepository->findUserByName($user);
        $user = $user[0];




        return $this->render('profile/profile.html.twig', [
            "user" => $user,
            "myQuestions" => $questions,
            "answersCount" => $answersCount,

        ]);
    }

    /**
     * @Route("/profile_edit", name="edit_profile")
     */
    public function edit(SluggerInterface $slugger,Request $request, EntityManagerInterface $em): Response
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

            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imageFile->move(
                        $this->getParameter('profile'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $user->setImage($newFilename);
            }

//            $user->setImage($form->get('image')->getData("filename"));

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
