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
            ->add('cantidad', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('precio_initario', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('sub_total', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('item_presupuesto_id', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('id_presupuesto', EntityType::class, [
                'class' => Presupuesto::class,
                'choice_label' => 'id',
                'attr' => ['class' => 'form-control']
            ])
            ->add('id_tipo_item', EntityType::class, [
                'class' => TipoProducto::class,
                'choice_label' => 'id',
                'attr' => ['class' => 'form-control']
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
