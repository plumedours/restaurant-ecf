<?php

namespace App\Controller\Admin;

use App\Entity\Starters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class StartersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Starters::class;
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
