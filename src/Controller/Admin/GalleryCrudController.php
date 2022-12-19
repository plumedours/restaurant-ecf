<?php

namespace App\Controller\Admin;

use App\Entity\Gallery;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class GalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gallery::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            Field::new('title', 'Titre'),
            DateTimeField::new('updated_at', 'Dernière mise à jour')
                ->hideOnForm()
                ->setFormat('dd/MM/yy \'à\' HH:mm'),
            Field::new('imageName', 'Image')
                ->onlyOnIndex(),
            Field::new('imageFile', 'Image')
                ->setFormType(VichImageType::class)
                ->onlyWhenCreating(),
            Field::new('imageFile', 'Image')
                ->setFormType(VichImageType::class)
                ->onlyWhenUpdating(),
        ];
    }
}