<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('password'),
            TextField::new('surname'),
            TextField::new('email'),
            AssociationField::new('programs')->hideOnForm(),
            ChoiceField::new('roles', 'Roles')
                    ->allowMultipleChoices()
                    ->autocomplete()
                    ->setChoices([  'ROLE_USER' => 'ROLE_USER',
                                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                                    'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN']
                                )
                    ->setPermission('ROLE_SUPER_ADMIN')      
        ];
    }
    
}
