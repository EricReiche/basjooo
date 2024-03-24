<?php

namespace App\Controller\Admin;

use App\Entity\Plant;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;

class PlantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Plant::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['name'])
            ->setDefaultSort(['name' => 'ASC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(EntityFilter::new('bed'))
            ->add(EntityFilter::new('species'));
    }


    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('name');
        yield AssociationField::new('bed');
        yield TextField::new('text');
        yield AssociationField::new('species');
    }
}
