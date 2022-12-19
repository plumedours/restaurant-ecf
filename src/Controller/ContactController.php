<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\DaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $em, DaysRepository $daysRepo, MailerInterface $mailer): Response
    {
        $days = $daysRepo->findAll();
        $contact = new Contact();

        if ($this->getUser()) {
            $contact->setFirstname($this->getUser()->getFirstname())
                ->setLastname($this->getUser()->getLastname())
                ->setEmail($this->getUser()->getEmail());
        }

        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if($formContact->isSubmitted() && $formContact->isValid()) {
            $contact = $formContact->getData();
            $em->persist($contact);
            $em->flush();

            //Envoie du mail
            $email = (new Email())
                ->from($contact->getEmail())
                ->to('bory.maxime@gmail.com')
                ->subject($contact->getSubject())
                ->text($contact->getContent());

            $mailer->send($email);
                $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $formContact->createView(),
            'days' => $days,
        ]);
    }
}
