<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\EditProfileType;
use App\Repository\DaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EditProfileController extends AbstractController
{
    /**
     * Permet de modifier le profile utilisateur
     * 
     * @param User $user
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    #[Route('/profile/edit/{id}', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(User $user, UserPasswordHasherInterface $hasher, Request $request, EntityManagerInterface $em, DaysRepository $daysRepo): Response
    {

        if(!$this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        if($this->getUser() !== $user) {
            return $this->redirectToRoute('app_home');
        }

        $days = $daysRepo->findAll();
        $formEditProfile = $this->createForm(EditProfileType::class, $user);
        $formEditProfile->handleRequest($request);
        
        if ($formEditProfile->isSubmitted() && $formEditProfile->isValid()) {
            if($hasher->isPasswordValid($user, $formEditProfile->getData()->getPlainPassword())) {
                $user = $formEditProfile->getData();

                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Vos informations ont bien été mises à jours.');

                // return $this->redirectToRoute('app_profile');
            } else {
                $this->addFlash('warning', 'Le mot de passe renseigné est incorrect.');
            }
        }

        return $this->render('profile/edit.html.twig', [
            'formEditProfile' => $formEditProfile->createView(),
            'days' => $days,
        ]);
    }
}
