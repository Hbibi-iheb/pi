<?php

namespace App\Form;

use App\Entity\PostLike;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostLikeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('type',CheckboxType::class, array('label' => 'Like / Dislike ',    'required' => false,'label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label']))
            ->add('post',null, array('label' => 'Poste','label_attr'=>['class' => 'col-md-4 col-lg-3 col-form-label'],'attr' => array( 'placeholder' => 'Poste','class' => 'form-control')))

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PostLike::class,
        ]);
    }
}
