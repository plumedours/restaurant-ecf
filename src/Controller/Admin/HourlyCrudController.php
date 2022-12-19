<?php

namespace App\Controller\Admin;

use App\Entity\Hourly;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class HourlyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Hourly::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
