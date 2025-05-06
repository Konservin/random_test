<?php

namespace Random\Command;

use Random\Generator\RandomStringGenerator;
use Random\Generator\RandomArrayGenerator;
use Random\Encoder\Rot13Encoder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRandomCommand extends Command
{
    public function __construct()
    {
        parent::__construct('random'); // ← sets the command name
    }
    protected function configure()
    {
        $this
            ->setDescription('Generate a random string and array and ROT13 encode them')
            ->addArgument('length', InputArgument::OPTIONAL, 'Length of string', 14)
            ->addArgument('count', InputArgument::OPTIONAL, 'Number of array items', 3);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $length = (int) $input->getArgument('length');
        $count = (int) $input->getArgument('count');

        try {
            $stringGen = new RandomStringGenerator($length);
            $arrayGen = new RandomArrayGenerator($stringGen, $count);
            $encoder = new Rot13Encoder();

            $string = $stringGen->generate();
            $array = $arrayGen->generate();

            $output->writeln("Original string: <info>$string</info>");
            $output->writeln("Encoded string : <info>" . $encoder->encode($string) . "</info>");
            $output->writeln("");

            $output->writeln("Original array:");
            foreach ($array as $item) {
                $output->writeln("- $item");
            }

            $output->writeln("");
            $output->writeln("Encoded array:");
            foreach ($encoder->encodeArray($array) as $item) {
                $output->writeln("- $item");
            }

            return Command::SUCCESS;

        } catch (\InvalidArgumentException $e) {
            $output->writeln("<error>Error: {$e->getMessage()}</error>");
            return Command::FAILURE;
        }
    }
}
