<?php

namespace App\Service;

use App\Entity\ProgramacionConsumoIngreso;
use App\Repository\ProgramacionConsumoIngresoRepository;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use App\Entity\Consumo;

class ProgramacionConsumoIngresoService
{
    private ProgramacionConsumoIngresoRepository $programacionRepo;
    private EntityManagerInterface $entityManager;

    public function __construct(ProgramacionConsumoIngresoRepository $programacionRepo, EntityManagerInterface $entityManager)
    {
        $this->programacionRepo = $programacionRepo;
        $this->entityManager = $entityManager;
    }

    public function procesarConsumosIngresos(): void
    {
        $hoy = new DateTime();

        // Obtener todas las programaciones activas cuyo fechaFin no ha pasado
        $programaciones = $this->programacionRepo->createQueryBuilder('p')
            ->where('p.fechaFin IS NULL OR p.fechaFin >= :hoy')
            ->setParameter('hoy', $hoy)
            ->getQuery()
            ->getResult();

        foreach ($programaciones as $programacion) {
            if ($this->esFechaEjecucion($hoy, $programacion)) {
                $this->ejecutarProgramacion($programacion);
            }
        }

        $this->entityManager->flush();
    }


    private function esFechaEjecucion(DateTime $hoy, ProgramacionConsumoIngreso $programacion): bool
    {
        $inicio = $programacion->getFechaInicio();
        $frecuencia = $programacion->getFrecuencia();

        if ($frecuencia === 'diaria') {
            return true;
        } elseif ($frecuencia === 'semanal' && $inicio->format('N') === $hoy->format('N')) {
            return true;
        } elseif ($frecuencia === 'mensual' && $inicio->format('d') === $hoy->format('d')) {
            return true;
        }

        return false;
    }

    private function ejecutarProgramacion(ProgramacionConsumoIngreso $programacion): void
    {
        
        if ($programacion->getTipo() === 'consumo') {
            // Crear un registro de consumo
            $consumo = new Consumo();
            $consumo->setPresupuesto($programacion->getPresupuesto());
            $consumo->setCantidad($programacion->getCantidad());

            if ($programacion->getProducto()) {
                $consumo->setProducto($programacion->getProducto());
                dump("Producto asociado:", $programacion->getProducto()->getId());
            } elseif ($programacion->getServicio()) {
                $consumo->setServicio($programacion->getServicio());
                dump("Servicio asociado:", $programacion->getServicio()->getId());
            }

            // Guarda el registro en la base de datos
            $this->entityManager->persist($consumo);
            

        } elseif ($programacion->getTipo() === 'ingreso') {
            // Aquí podrías registrar un ingreso similarmente
            dump("Registrando ingreso...");
            // Por ejemplo:
            // $ingreso = new Ingreso();
            // $ingreso->setPresupuesto($programacion->getPresupuesto());
            // $ingreso->setMonto($programacion->getCantidad());
            // $this->entityManager->persist($ingreso);
            dump("Ingreso registrado con cantidad:", $programacion->getCantidad());
        }
    }

    
}
