<?php

namespace App\Form;

use App\Entity\Producto;
use App\Entity\TipoProducto;
use App\Entity\Referencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichFileType;


class ProductoConsumoType extends AbstractType
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
    
        $builder
            ->add('nombre', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('precio', null, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('tipoProducto', EntityType::class, [
                'class' => TipoProducto::class,
                'choice_label' => 'nombre',
                'attr' => ['class' => 'form-control']
            ])
            // Sección de imágenes
            ->add('foto1a', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'label' => 'Foto 1',
            ])
            ->add('foto2a', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => true,
                'label' => 'Foto 2',
            ])
            ->add('idReferencia', EntityType::class, [
                'class' => Referencia::class,
                'choice_label' => 'codigo', // Ajusta según la propiedad que quieras mostrar
                'placeholder' => 'Selecciona una referencia',
                'required' => true,
                'attr' => [
                    'class' => 'select2-referencias',
                    'data-ajax--url' => '/referencia/api',
                    'data-ajax--delay' => '250',
                    'data-placeholder' => 'Buscar referencia...',
                ],
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Producto::class,
            'csrf_protection' => true, // Habilitar CSRF
        ]);
    }
}
