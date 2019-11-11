<?php

namespace App\Form;

use App\Entity\Recomendacion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecomendacionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('estudiante', ChoiceType::class, [
                'choices'  => [
                    'Si' => 'Si',
                    'No' => 'No',
                ],
            ])
            ->add('cantidad')
            ->add('desempeno',TextareaType::class, [
                'required'   => false,
            ])
            ->add('cualidades',TextareaType::class, [
                'required'   => false,
            ])
            ->add('recomendacion',TextareaType::class, [
                'required'   => false,
            ])
            ->add('otros',TextareaType::class, [
                'required'   => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recomendacion::class,
        ]);
    }
}
