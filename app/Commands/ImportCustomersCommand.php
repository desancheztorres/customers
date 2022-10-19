<?php
namespace App\Commands;

use Monolog\Logger;
use mysqli;
use Src\Logger\Infrastructure\Monolog;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Src\Country\Infrastructure\CreateCountryController;
use Src\Country\Infrastructure\Repositories\MySQLCountryRepository;
use Src\Customer\Application\create\CreateCustomerRequest;
use Src\Customer\Infrastructure\CreateCustomerController;
use Src\Customer\Infrastructure\Repositories\MySQLCustomerRepository;

class ImportCustomersCommand extends Command
{
    public function __construct(
        private readonly mysqli $mysqli,
        private readonly Logger $logger,
        string $name = null
    )
    {
        parent::__construct($name);
    }

    protected function configure()
    {
        $this->setName('import-customers')
            ->setDescription('Import Customers from CSV file.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $csvFilePath = "data/customers-info.csv";

        $csv = array_map('str_getcsv', file($csvFilePath));

        $logs = new Monolog($this->logger);

        $progressBar = new ProgressBar($output, 50);
        $progressBar->start();
        $count = 0;
        foreach ($csv as $key => $row) {

            if ($count === 0) {
                $count++;
                continue;
            }

            $firstName = $csv[$key][0];
            $lastName = $csv[$key][1];
            $email = $csv[$key][2];
            $password = $csv[$key][3];
            $birthday = date("Y-m-d", strtotime($csv[$key][4]));
            $country = $csv[$key][5];
            $region = $csv[$key][6] ?? null;
            $city = $csv[$key][7];
            $postal_code = $csv[$key][8] ?? null;
            $street_suffix = $csv[$key][9];
            $street = $csv[$key][10];
            $street_number = $csv[$key][11];
            $telephone = $csv[$key][12] ?? null;

            $request = new CreateCustomerRequest(
                $firstName,
                $lastName,
                $email,
                $password,
                $birthday,
                $country,
                $region,
                $city,
                $postal_code,
                $street_suffix,
                $street,
                $street_number,
                $telephone
            );

            $customers = new MySQLCustomerRepository($this->mysqli);
            $countries = new MySQLCountryRepository($this->mysqli);
            $countryController = new CreateCountryController($countries);
            $countryController($request);
            $Customercontroller = new CreateCustomerController($customers, $countries, $logs);
            $Customercontroller($request);

            $progressBar->advance();
        }

        $progressBar->finish();

        return Command::SUCCESS;
    }
}