<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Repository\DaysRepository;
use App\Repository\TimeslotsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(TimeslotsRepository $hourRepo, DaysRepository $daysRepo, Request $request, EntityManagerInterface $em, MailerInterface $mailer): Response
    {
        $hours = $hourRepo->findAll('hour');
        $days = $daysRepo->findAll();
        $booking = new Booking();

        if ($this->getUser()) {
            $booking->setFirstname($this->getUser()->getFirstname())
                ->setLastname($this->getUser()->getLastname())
                ->setEmail($this->getUser()->getEmail());
        }

        $bookingForm = $this->createForm(BookingType::class, $booking);
        $bookingForm->handleRequest($request);

        if ($bookingForm->isSubmitted() && $bookingForm->isValid()) {
            $booking = $bookingForm->getData();
            $booking->setHour($bookingForm->get('hour')->getNormData()->getStart());
            $booking->setDate($bookingForm->get('date')->getData('date')->format('d M Y'));
            $em->persist($booking);
            $em->flush();

            //Envoie du mail
            $email = (new TemplatedEmail())
                ->from('quaiantique@plumedours.fr')
                ->to($booking->getEmail())
                ->subject('Votre réservation chez Quai Antique')
                // path of the Twig template to render
                ->htmlTemplate('emails/booking.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'booking' => $booking,
                ]);

            $mailer->send($email);

            $this->addFlash('success', 'Votre réservation a bien été prise en compte. Vous allez recevoir un email de confirmation.');

            return $this->redirectToRoute('app_book');
        }

        return $this->render('book/index.html.twig', [
            'bookingForm' => $bookingForm->createView(),
            'days' => $days,
            'hours' => $hours,
        ]);
    }
}
