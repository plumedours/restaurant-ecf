<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Entity\Days;
use App\Entity\Desserts;
use App\Entity\Drink;
use App\Entity\Formule;
use App\Entity\Gallery;
use App\Entity\MainCourses;
use App\Entity\Starters;
use App\Entity\Timeslots;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(StartersCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration');
    }

    public function configureMenuItems(): iterable
    {
        return [
            yield MenuItem::linkToRoute('Accueil', 'fa fa-home', 'app_home'),
            yield MenuItem::section('Carte'),
            yield MenuItem::linkToCrud('Entrées', 'fa fa-tags', Starters::class),
            yield MenuItem::linkToCrud('Plats', 'fa fa-tags', MainCourses::class),
            yield MenuItem::linkToCrud('Desserts', 'fa fa-tags', Desserts::class),
            yield MenuItem::linkToCrud('Boissons', 'fa fa-tags', Drink::class),
            yield MenuItem::section('Formules'),
            yield MenuItem::linkToCrud('Formules', 'fa fa-tags', Formule::class),
            yield MenuItem::section('Site'),
            yield MenuItem::linkToCrud('Clients', 'fa fa-tags', User::class),
            yield MenuItem::linkToCrud('Réservations', 'fa fa-tags', Booking::class),
            yield MenuItem::linkToCrud('Galerie', 'fa fa-tags', Gallery::class),
            yield MenuItem::linkToCrud('Jours d\'ouverture', 'fa fa-tags', Days::class),
            yield MenuItem::linkToCrud('Créneaux horaires', 'fa fa-tags', Timeslots::class),
        ];
    }
}
