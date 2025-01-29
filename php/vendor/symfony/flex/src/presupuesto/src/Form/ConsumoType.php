<?php

namespace App\Form;

use App\Entity\Consumo;
use App\Entity\Presupuesto;
use App\Entity\Producto;
use App\Entity\Servicio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsumoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('frecuencia', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('presupuesto', EntityType::class, [
                'class' => Presupuesto::class,
                'choice_label' => 'id',
                'attr' => ['class' => 'form-control']
            ])
            ->add('producto', EntityType::class, [
                'class' => Producto::class,
                'choice_label' => 'id',
                'attr' => ['class' => 'form-control']
            ])
            ->add('servicio', EntityType::class, [
                'class' => Servicio::class,
                'choice_label' => 'id',
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consumo::class,
        ]);
    }
}
