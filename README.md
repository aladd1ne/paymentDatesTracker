# Payment Dates Tracker
This is a command-line application that allows you to generate payment dates for employees based on their salary and bonus dates

Originally based on https://github.com/aladd1ne/paymentDatesTracker.git
 
Symfony 6.2
Php 8.1
## Installation

### Step #0: Clone code base
1. Clone this repo into your Projects directory

    ```
    https://github.com/aladd1ne/paymentDatesTracker.git
    cd paymentDatesTracker
    git checkout feature/generate-payments-command 
    ```
### Step #1 Run composer install to install the dependencies
### Usage

```
run php bin/console app:generate-payments
```
This will create a CSV file named payment-dates.csv in the root directory of the application. The file will contain the payment dates for each month of the current year, including the base salary payment date and bonus payment date.
###
You can also specify a different year by providing the --year option:
```
run php bin/console app:generate-payments 2024
```
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