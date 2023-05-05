<?php

declare(strict_types=1);

namespace App\Service;

class SalesPayrollService
{
    /**
     * @param $year
     * @param $month
     * @return string
     */
    public function getBaseSalaryDate($year, $month): string
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
    public function getBonusDate($year, $month): string
    {
        $bonusDate = new \DateTimeImmutable("$year-$month-15");

        // If 15th is Sat or Sun
        if ($bonusDate->format('N') >= 6) {
            $bonusDate = $bonusDate->modify('next wednesday');
        }

        return $bonusDate->format('Y-m-d');
    }
}