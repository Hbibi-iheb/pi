<?php

namespace App\Form;

use App\Entity\CategoryForum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryForumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class, array('label' => 'Nom du Categorie','label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label'],'attr' => array( 'placeholder' => 'Categorie Nom','class' => 'form-control')))
            ->add('description',TextType::class, array('label' => 'Description du Categorie','label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label'],'attr' => array( 'placeholder' => 'Categorie Description','class' => 'form-control')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CategoryForum::class,
        ]);
    }
}
