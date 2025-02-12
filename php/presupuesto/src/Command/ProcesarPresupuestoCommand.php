<?php

namespace App\Command;
use App\Service\ProgramacionConsumoIngresoService;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'presupuesto:procesar')]
class ProcesarPresupuestoCommand extends Command
{
    private ProgramacionConsumoIngresoService $service;

    public function __construct(ProgramacionConsumoIngresoService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->service->procesarConsumosIngresos();
        $output->writeln('Consumos e ingresos procesados correctamente.');
        return Command::SUCCESS;
    }
}