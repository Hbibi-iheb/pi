<?php

namespace App\Form;

use App\Entity\CategoryForum;
use App\Entity\PostForum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PostForumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('titre',TextType::class, array('label' => 'Titre de post','label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label'],'attr' => array( 'placeholder' => 'Titre de poste','class' => 'form-control')))
            ->add('contenu',TextareaType::class, array('label' => 'Contenu du Post','label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label'],'attr' => array( 'placeholder' => 'Contenu du post','class' => 'form-control')))
            ->add('categorie',null, array('label' => 'Nom du Categorie','label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label'],'attr' => array( 'class' => 'form-control','mapped' => true)))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PostForum::class,
        ]);
    }
}
