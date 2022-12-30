<?php

namespace App\Controller\Admin;

use App\Entity\Timeslots;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TimeslotsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Timeslots::class;
    }

    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         Field::new('start', 'Heure'),
    //         Field::new('end', 'Fin')
    //             ->hideOnForm(),
    //     ];
    // }
}
