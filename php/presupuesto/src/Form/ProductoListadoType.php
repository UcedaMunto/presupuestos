<?php

namespace App\Form;

use App\Entity\Presupuesto;
use App\Entity\ProductoListado;
use App\Entity\Referencia;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductoListadoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            //->add('nombre')
            ->add('cantidad', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('idPresupuesto', EntityType::class, [
                'class' => Presupuesto::class,
                'choice_label' => 'id',
                'attr' => ['class' => 'form-control']
            ])
            ->add('idReferencia', EntityType::class, [
                'class' => Referencia::class,
                'choice_label' => 'codigo',
                'attr' => ['class' => 'form-control']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductoListado::class,
        ]);
    }
}
