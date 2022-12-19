<?php

namespace App\Controller;

use App\Repository\BookingRepository;
use App\Repository\DaysRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    #[IsGranted('ROLE_USER')]
    public function index(DaysRepository $daysRepo, BookingRepository $bookingRepo): Response
    {
        $days = $daysRepo->findAll();
        $userBooks = $this->getUser()->getEmail();

        $books = $bookingRepo->findBy(
            ['email' => $userBooks]
        );

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'days' => $days,
            'userBooks' => $books,
        ]);
    }
}
