<?php

namespace App\Controller;

use App\Repository\DaysRepository;
use App\Repository\DessertsRepository;
use App\Repository\DrinkRepository;
use App\Repository\FormuleRepository;
use App\Repository\MainCoursesRepository;
use App\Repository\StartersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name: 'app_menu')]
    public function index(DaysRepository $daysRepo, DessertsRepository $dessertsRepo, StartersRepository $startersRepo, MainCoursesRepository $maincoursesRepo, DrinkRepository $drinksRepo, FormuleRepository $formuleRepo): Response
    {
        $desserts = $dessertsRepo->findAll();
        $starters = $startersRepo->findAll();
        $maincourses = $maincoursesRepo->findAll();
        $drinks = $drinksRepo->findAll();
        $formules = $formuleRepo->findAll();
        $days = $daysRepo->findAll();
        
        return $this->render('menu/index.html.twig', [
            'desserts' => $desserts,
            'starters' => $starters,
            'maincourses' => $maincourses,
            'drinks' => $drinks,
            'formules' => $formules,
            'days' => $days,
        ]);
    }
}
