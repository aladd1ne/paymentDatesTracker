<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\SalesPayrollService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;
class PayrollController extends AbstractFOSRestController
{
    public function __construct(private readonly SalesPayrollService $payrollService)
    {
    }

    #[Rest\Post('/payroll', name: 'get_payroll')]
    #[OA\Response(response: 200, description: 'generate a CSV file containing the payment date')]
    public function generatePayments(): Response
    {
        $now = new \DateTimeImmutable();
        $year = $now->format('Y');
        $paymentDates = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $baseSalaryDate = $this->payrollService->getBaseSalaryDate($year, $month);
            $bonusDate = $this->payrollService->getBonusDate($year, $month);
            $paymentDates[] = [$monthName, $baseSalaryDate, $bonusDate];
        }

        $response = new Response();
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="payment-dates.csv"');

        $handle = fopen('php://output', 'w');
        fputcsv($handle, ['Month', 'Base Salary Payment Date', 'Bonus Payment Date']);

        foreach ($paymentDates as $paymentDate) {
            fputcsv($handle, $paymentDate);
        }

        fclose($handle);

        return $response;
    }
}


