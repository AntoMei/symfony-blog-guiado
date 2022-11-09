<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Category;

class ImageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    $builder
        ->add('File')
        ->add('NumLikes', null, ['attr' => ['class'=>'form-control']])
        ->add('NumViews', null, ['attr' => ['class'=>'form-control']])
        ->add('NumDownloads', null, ['attr' => ['class'=>'form-control']])
        ->add('category', EntityType::class, array(
            'class' => Category::class,
            'choice_label' => 'name'))
        ->add('Send', SubmitType::class, ['attr' => ['class'=>'pull-right btn btn-lg sr-button']]);
    ;
}

    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
