<?php

namespace App\Controller;

use App\Repository\DaysRepository;
use App\Repository\GalleryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GalleryController extends AbstractController
{
    #[Route('/gallery', name: 'app_gallery')]
    public function index(DaysRepository $daysRepo, GalleryRepository $galleryRepo): Response
    {
        $days = $daysRepo->findAll();
        $photos = $galleryRepo->findAll();

        return $this->render('gallery/index.html.twig', [
            'controller_name' => 'GalleryController',
            'days' => $days,
            'photos' => $photos,
        ]);
    }
}
