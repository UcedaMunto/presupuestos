<?php

namespace App\Form;

use App\Entity\EstadoPresupuesto;
use App\Entity\Presupuesto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PresupuestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('montoTotal', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('fechaInicio', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('fechaFin', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('estado', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('id_estado', EntityType::class, [
                'class' => EstadoPresupuesto::class,
                'choice_label' => 'nombre', // Mostrar el nombre en lugar del ID
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Presupuesto::class,
        ]);
    }
}
