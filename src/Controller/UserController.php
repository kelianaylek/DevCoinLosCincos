<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends AbstractController
{

    // Connexion
    /**
     * @Route("{path}/sign_up", name="sign_up")
     */
    public function sign_up($path, Request $request, EntityManagerInterface $em, UsersRepository $usersRepo): Response
    {
        $user = new Users;
        $userForm = $this->createFormBuilder($user)
            ->add("user_name", TextType::class, ["attr" => ["autofocus" => true]], ["attr" => ["id" => "email"]])
            ->add("user_email", TextType::class)
            ->add("user_password", TextType::class)
            ->getForm()
        ;
        $userForm->handleRequest($request);
        
        if($userForm -> isSubmitted() && $userForm->isValid()){
            $em->persist($user);
            $em->flush();

            $userName = $userForm["user_email"]->getData();
            $userExist = $usersRepo->findBy(array('user_email' => $userName));

            $paswword = $userExist[0]->getUserPassword();
            $userName = $userExist[0]->getUserName();
            $userId = $userExist[0]->getId();
            $userEmail = $userExist[0]->getUserName();

            $session = $request->getSession();
            $session->set("user", array( 
                'user_name' => $userName,
                'user_email' => $userEmail,
                'user_id' => $userId,
                'user_password' => $paswword,
                )
            );

            return $this->redirectToRoute($path);
        }
        return $this->render($path."/".$path.'.html.twig', [
            'controller_name' => 'QuestionController',
            "path" => $path,
            "userForm" => $userForm->createView(),
            // "user_name" =>  $_SESSION["user_name"],

        ]);
    }

    // Inscription
    /**
     * @Route("{path}/sign_in", name="sign_in")
     */
    public function sign_in($path, UsersRepository $usersRepo, Request $request): Response
    {
        $users = $usersRepo->findAll();

        $user = new Users;
        $userFormToConnect = $this->createFormBuilder($user)
            ->add("user_email", TextType::class, ["attr" => ["autofocus" => true]])
            ->add("user_password", TextType::class)
            ->getForm()
        ;
        $userFormToConnect->handleRequest($request);

        $userName = $userFormToConnect["user_email"]->getData();
        $userPassword = $userFormToConnect["user_password"]->getData();

        if($userFormToConnect -> isSubmitted() && $userFormToConnect->isValid()){

            $userExist = $usersRepo->findBy(array('user_email' => $userName));

            if($userExist !== []){
                $correctPassword = $userExist[0]->getUserPassword();
                $user = $userExist[0]->getUserName();
                $userId = $userExist[0]->getId();
                $userEmail = $userExist[0]->getUserName();

                if($userPassword == $correctPassword){
                    print_r("Bienvenue ". $user . "  " . $correctPassword);

                    $session = $request->getSession();
                    $session->set("user", array( 
                        'user_name' => $user,
                        'user_email' => $userEmail,
                        'user_id' => $userId,
                        'user_password' => $correctPassword,
                        )
                    );

                    return $this->redirectToRoute($path);

                }else{
                    print_r("nop");
                }
            }
            else{
                print_r("pas de mail comme ca");
            }

        }

        return $this->render($path."/".$path.'.html.twig', [
            'controller_name' => 'QuestionController',
            "userFormToConnect" => $userFormToConnect->createView(),
            "path" => $path,


        ]);
    }

    // Deconnexion
}
