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

    #[Rest\Get('/payroll', name: 'get_payroll')]
    #[OA\Response(response: 200, description: 'get payment date')]
    public function generatePayments(): Response
    {
        $paymentDates = $this->payrollService->generatePaymentDates();

        return $this->render('payroll/index.html.twig', [
            'paymentDates' => $paymentDates,
        ]);

    }

    #[Rest\Post('/generate-payroll', name: 'generate_payroll')]
    #[OA\Response(response: 200, description: 'generate a CSV file containing the payment date')]
    public function downloadPaymentsCsv(): Response
    {
        $paymentDates = $this->payrollService->generatePaymentDates();

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


