<?php

namespace App\Controller\Admin;

use App\Entity\Desserts;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DessertsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Desserts::class;
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
