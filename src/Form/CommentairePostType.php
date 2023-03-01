<?php

namespace App\Form;

use App\Entity\CommentairePost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentairePostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu',TextareaType::class, array('label' => 'Contenu du commentaire','label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label'],'attr' => array( 'placeholder' => 'Contenu du post','class' => 'form-control')))
            ->add('post',null, array('label' => 'Post','label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label'],'attr' => array( 'placeholder' => 'Choisir Post','class' => 'form-control')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CommentairePost::class,
        ]);
    }
}
