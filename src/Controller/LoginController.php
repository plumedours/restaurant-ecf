<?php

namespace App\Controller;

use App\Repository\DaysRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils, DaysRepository $daysRepo): Response
    {
        $days = $daysRepo->findAll();

                // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
                 // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'days' => $days,
        ]);
    }
}
