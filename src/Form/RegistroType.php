<?php

namespace App\Form;

use App\Entity\Registro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RegistroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('sexo', ChoiceType::class, [
                'choices'  => [
                    'Femenino' => 'F',
                    'Masculino' => 'M',
                ],
            ])
            ->add('correo')
            ->add('universidad')
            ->add('semestre')
            ->add('promedio')
            ->add('historialFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'asset_helper' => true,
            ])
            ->add('profesor')
            ->add('correoProfesor')
            ->add('beca', ChoiceType::class, [
                'choices'  => [
                    'Beca de alimentos' => 'Beca de alimentos',
                    'Beca de alimentos y hospedaje' => 'Beca de alimentos y hospedaje',
                ],
            ])
            ->add('restricciones',TextareaType::class, [
                'required'   => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Registro::class,
             'validation_groups' => ['registro'],
        ]);
    }
}
