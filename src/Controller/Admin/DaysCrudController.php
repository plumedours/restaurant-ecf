<?php

namespace App\Controller\Admin;

use App\Entity\Days;
use Doctrine\DBAL\Types\BooleanType;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DaysCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Days::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            Field::new('day', 'Jours'),
            Field::new('open', 'Ouvert')
                ->setFormType(BooleanType::class)
                ->onlyOnIndex()
                ->setFormTypeOption('disabled', 'disabled'),
            Field::new('open', 'Jours')
                ->onlyWhenCreating(),
            Field::new('open', 'Jours')
                ->onlyWhenUpdating(),
        ];
    }
}
