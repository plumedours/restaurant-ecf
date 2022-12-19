<?php

namespace App\Controller;

use App\Repository\DaysRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(DaysRepository $daysRepo): Response
    {
        $days = $daysRepo->findAll();

        return $this->render('home/index.html.twig', [
            'days' => $days,
        ]);
    }
}
