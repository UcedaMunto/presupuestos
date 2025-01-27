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
            ->add('nombre')
            ->add('montoTotal')
            ->add('fechaInicio', null)
            ->add('fechaFin', null)
            ->add('estado')
            ->add('created_at', null)
            ->add('fecha_aprobacion', null)
            ->add('total')
            ->add('id_estado', EntityType::class, [
                'class' => EstadoPresupuesto::class,
                'choice_label' => 'id',
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
