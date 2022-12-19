<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use Doctrine\DBAL\Types\IntegerType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BookingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Booking::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield Field::new('date', 'Jours'),
            yield Field::new('hour', 'Heure'),
            yield Field::new('email', 'Email'),
            yield Field::new('lastname', 'Nom'),
            yield Field::new('firstname', 'Prénom'),
            yield IntegerField::new('nbr_of_person', 'Nombre de personne'),
            yield Field::new('phone', 'Téléphone'),
            yield Field::new('allergies', 'Allergies'),
        ];
    }
}
