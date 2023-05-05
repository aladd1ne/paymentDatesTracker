<?php

namespace App\Command;

use App\Service\SalesPayrollService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:generate-payments',
    description: 'Generate payment dates for the sales department',
)]
class GeneratePaymentsCommand extends Command
{
    public function __construct(private readonly SalesPayrollService $payrollService)
    {
        parent::__construct(self::getDefaultName());
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to generate a CSV file containing the payment dates for the sales department.')
            ->addArgument('year', InputArgument::OPTIONAL, 'The year for which to generate payment dates.', (new \DateTimeImmutable())->format('Y'));
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $now = new \DateTimeImmutable();
        $year = $input->getArgument('year') ?? $now->format('Y');

        $paymentDates = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $baseSalaryDate = $this->payrollService->getBaseSalaryDate($year, $month);
            $bonusDate = $this->payrollService->getBonusDate($year, $month);

            $paymentDates[] = [$monthName, $baseSalaryDate, $bonusDate];
        }

        $csvFile = fopen('payment-dates.csv', 'w');
        fputcsv($csvFile, ['Month', 'Base Salary Payment Date', 'Bonus Payment Date']);

        foreach ($paymentDates as $paymentDate) {
            fputcsv($csvFile, $paymentDate);
        }

        fclose($csvFile);

        $output->writeln('Payment dates have been generated in payment-dates.csv');

        return Command::SUCCESS;
    }
}

