<?php

namespace App\Form;

use App\Entity\DetallePresupuesto;
use App\Entity\Presupuesto;
use App\Entity\TipoProducto;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetallePresupuestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad')
            ->add('precio_initario')
            ->add('sub_total')
            ->add('item_presupuesto_id')
            ->add('id_presupuesto', EntityType::class, [
                'class' => Presupuesto::class,
                'choice_label' => 'id',
            ])
            ->add('id_tipo_item', EntityType::class, [
                'class' => TipoProducto::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetallePresupuesto::class,
        ]);
    }
}
