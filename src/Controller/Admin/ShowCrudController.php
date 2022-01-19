<?php

namespace App\Controller\Admin;

use App\Entity\Show;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class ShowCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Show::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('program'),
            TextField::new('name'),
            TextEditorField::new('description'),
            DateTimeField::new('start_at'),
            DateTimeField::new('end_at'),
            DateTimeField::new('created_at'),
        ];
    }
    
}
