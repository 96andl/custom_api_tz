<?php

namespace App\Console;

use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/14/18
 * Time: 2:19 AM
 */
class GenerateFakeUsersCommand extends Command
{
    private $faker;
    const DEFAULT_RESOURCES_COUNT = 1000;
    const RESOURCE_STUB_PATH = 'stubs/users.json';

    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
    }

    protected function configure()
    {
        $this->setName('app:users')
            ->setDescription('creates a bunch of users')
            ->setHelp("This command allows you to create a bunch of users")
            ->addArgument('users', InputArgument::OPTIONAL, "Count of users", self::DEFAULT_RESOURCES_COUNT);
    }

    public function execute(InputInterface $input, OutputInterface $output, $data = [], $index = 0)
    {
        if (file_exists(self::RESOURCE_STUB_PATH)) {
            $data = json_decode(file_get_contents(self::RESOURCE_STUB_PATH));
            $index = $data[count($data) - 1]->id;
        }

        $resourcesCount = $input->getArgument('resources') + $index;

        for (; $index < $resourcesCount; $index++) {
            $data[] = (object)array(
                "id" => $index,
                "name" => $this->faker->name,
                "description" => $this->faker->sentence
            );
        }


        file_put_contents(self::RESOURCE_STUB_PATH, json_encode($data));


        $output->writeln("created {$input->getArgument('resources')} resources");
    }
}