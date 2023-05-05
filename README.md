                    # Payment Dates Tracker
This  application that allows you to generate payment dates for employees based on their salary and bonus dates via Restful-API-Endpoint

Originally based on https://github.com/aladd1ne/paymentDatesTracker.git

Symfony 6.2
Php 8.1
## Installation

### Step #0: Clone code base
1. Clone this repo into your Projects directory

    ```
    https://github.com/aladd1ne/paymentDatesTracker.git
    cd paymentDatesTracker
    git checkout feature/generate-payments-controller
    ```
### Step
Run composer install to install the dependencies

Run symfony serve -d

### Usage

```
Navigate to 

http://127.0.0.1:8000/payroll
click downolad csv

```
This will render a twig file containing the payment dates for each month of the current year, including the base salary payment date and bonus payment date.


## Example
| Month     | Base Salary Payment Date | Bonus Payment Date |
|-----------|--------------------------|--------------------|
| January   | 2023-01-31               | 2023-01-18         |
| February  | 2023-02-28               | 2023-02-15         |
| March     | 2023-03-31               | 2023-03-15         |
| April     | 2023-04-28               | 2023-04-19         |
| May       | 2023-05-31               | 2023-05-15         |
| June      | 2023-06-30               | 2023-06-15         |
| July      | 2023-07-31               | 2023-07-19         |
| August    | 2023-08-31               | 2023-08-15         |
| September | 2023-09-29               | 2023-09-15         |
| October   | 2023-10-31               | 2023-10-18         |
| November  | 2023-11-30               | 2023-11-15         |
| December  | 2023-12-29               | 2023-12-15         |