<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\YearPickerType;
use App\Service\SalesPayrollService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints as Assert;

class PayrollController extends AbstractFOSRestController
{
    public function __construct(private readonly SalesPayrollService $payrollService)
    {
    }

    #[Rest\Post('/payroll', name: 'get_payroll')]
    #[Rest\QueryParam(name: 'year', requirements: new Assert\Regex(pattern: '/^[1-2][0-9]{3}$/'), description: 'Selected year', strict: true)]
    #[OA\Response(response: 200, description: 'generate a CSV file containing the payment date')]
    public function generatePayments(Request $request): View|Response
    {
        $params = $request->query->all();
        $form = $this->createForm(YearPickerType::class);
        $form->submit($params);
        if ($form->isSubmitted() && $form->isValid()) {
            $year = $form->getData()['year']->format('Y');
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

        } else {
            return $this->view($form, Response::HTTP_BAD_REQUEST);
        }
        return $response;
    }
}


