<?php

namespace App\Form;

use App\Entity\Consumo;
use App\Entity\Presupuesto;
use App\Entity\Producto;
use App\Entity\Servicio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ConsumoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('presupuesto', EntityType::class, [
                'class' => Presupuesto::class,
                'choice_label' => 'nombre', // Ajusta según el campo del modelo
                'data' => $options['presupuesto'],
                'disabled' => true,
            ])
            ->add('servicio', EntityType::class, [
                'class' => Servicio::class,
                'choice_label' => 'nombre',
                'required' => false,
                'disabled' => true,
                'label' => 'Servicio',
                'attr' => ['class' => 'form-control']
            ])
            ->add('cantidad', IntegerType::class, [
                'label' => 'Cantidad',
                'attr' => ['class' => 'form-control']
            ])
            ->add('total', MoneyType::class, [
                'required' => true,
                'label' => 'Total $',
                'attr' => ['class' => 'form-control'],
                'currency' => False
            ])
            ->add('descripcion', TextareaType::class, [
                'required' => false,
                'label' => 'Descripción',
                'attr' => ['class' => 'form-control']
            ])
            ->add('fecha', DateType::class, [
                'widget' => 'single_text', // Esto renderiza un input de tipo date en HTML5
                'required' => true,
                'html5' => true,
                'attr' => [
                    'class' => 'form-control', // Añadir clases de Bootstrap si lo necesitas
                ],
            ]);

            if ($options['producto_consumido']) {
                $builder->add('producto', ProductoConsumoType::class, [
                    'label' => 'Producto'
                ]);

                $builder->remove('servicio');
            }else{
                $builder->add('producto', EntityType::class, [
                'class' => Producto::class,
                'choice_label' => 'nombre',
                'required' => false,
                'label' => 'Producto',
                'attr' => ['class' => 'form-control']
                ]);
            }
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consumo::class,
            'csrf_protection' => true, // Habilitar CSRF
            'presupuesto' => null, // Define el presupuesto como opción
            'producto_consumido' => false, 
            
        ]);
    }
}