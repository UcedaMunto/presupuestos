<?php

namespace App\Form;

use App\Entity\Presupuesto;
use App\Entity\Producto;
use App\Entity\ProgramacionConsumoIngreso;
use App\Entity\Servicio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramacionConsumoIngresoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad')
            ->add('tipo')
            ->add('frecuencia')
            ->add('fechaInicio', null, [
                'widget' => 'single_text',
            ])
            ->add('fechaFin', null, [
                'widget' => 'single_text',
            ])
            ->add('presupuesto', EntityType::class, [
                'class' => Presupuesto::class,
                'choice_label' => 'id',
            ])
            ->add('producto', EntityType::class, [
                'class' => Producto::class,
                'choice_label' => 'id',
            ])
            ->add('servicio', EntityType::class, [
                'class' => Servicio::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProgramacionConsumoIngreso::class,
        ]);
    }
}
