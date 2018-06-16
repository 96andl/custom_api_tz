<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 6/16/18
 * Time: 12:36 PM
 */

namespace App\console;


use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FakeResourceGenerator extends Command
{

    private $faker;
    const DEFAULT_RESOURCES_COUNT = 5;
    const RESOURCE_STUB_PATH = 'stubs/resources.json';

    public function __construct()
    {
        parent::__construct();
        $this->faker = Factory::create();
    }

    protected function configure()
    {
        $this->setName('app:resource')
            ->setDescription('creates a bunch of resources')
            ->setHelp("This command allows you to create a bunch of resources")
            ->addArgument('resources', InputArgument::OPTIONAL, "Count of resource", self::DEFAULT_RESOURCES_COUNT);
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
                "product_id" => $this->faker->randomNumber,
                'category' => $this->faker->name,
                'brand_name' => $this->faker->company,
                'product_name' => $this->faker->company,
                "name" => $this->faker->name,
                "description" => $this->faker->sentence,
                'price' => $this->faker->randomFloat,
                'image' => $this->faker->imageUrl($width = 640, $height = 480)
            );
        }


        file_put_contents(self::RESOURCE_STUB_PATH, json_encode($data));


        $output->writeln("created {$input->getArgument('resources')} resources");
    }
}