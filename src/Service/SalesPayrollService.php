<?php

declare(strict_types=1);

namespace App\Service;

class SalesPayrollService
{
    /**
     * @return array
     */
    public function generatePaymentDates(): array
    {
        $now = new \DateTimeImmutable();
        $year = $now->format('Y');
        $paymentDates = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthName = date('F', mktime(0, 0, 0, $month, 1));
            $baseSalaryDate = $this->getBaseSalaryDate($year, $month);
            $bonusDate = $this->getBonusDate($year, $month);
            $paymentDates[] = [$monthName, $baseSalaryDate, $bonusDate];
        }
        return $paymentDates;
    }

    /**
     * @param $year
     * @param $month
     * @return string
     */
    private function getBaseSalaryDate($year, $month): string
    {
        $lastDayOfMonth = new \DateTimeImmutable("last day of $year-$month");

        // If last day of month is Sat or Sun
        if ($lastDayOfMonth->format('N') >= 6) {
            $lastDayOfMonth = $lastDayOfMonth->modify('last friday');
        }

        return $lastDayOfMonth->format('Y-m-d');
    }

    /**
     * @param $year
     * @param $month
     * @return string
     */
    private function getBonusDate($year, $month): string
    {
        $bonusDate = new \DateTimeImmutable("$year-$month-15");

        // If 15th is Sat or Sun
        if ($bonusDate->format('N') >= 6) {
            $bonusDate = $bonusDate->modify('next wednesday');
        }

        return $bonusDate->format('Y-m-d');
    }
}