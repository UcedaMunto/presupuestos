<?php

namespace App\Form;

use App\Entity\ReferenciaCompra;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ReferenciaCompraType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('proveedor', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Proveedor'
            ])
            ->add('descripcion', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Descripción'
            ])
            ->add('referencia', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Referencia'
            ])
            ->add('cantidad', IntegerType::class, [
                'attr' => ['class' => 'form-control', 'min' => 1],
                'label' => 'Cantidad'
            ])
            ->add('actualizadoEn', DateTimeType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'label' => 'Fecha de Actualización'
            ])

            // Sección de imágenes
            ->add('foto1a', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'label' => 'Foto 1'
            ])
            ->add('foto2a', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'label' => 'Foto 2'
            ])
            ->add('foto3a', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'label' => 'Foto 3'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReferenciaCompra::class,
        ]);
    }
}
