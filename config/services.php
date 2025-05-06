<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Random\Generator\RandomStringGenerator;
use Random\Generator\RandomArrayGenerator;
use Random\Encoder\Rot13Encoder;
use Random\Controller\RandomController;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$container = new ContainerBuilder();

// Generators and encoder
$container
    ->register(RandomStringGenerator::class, RandomStringGenerator::class)
    ->addArgument(14);

$container
    ->register(RandomArrayGenerator::class, RandomArrayGenerator::class)
    ->addArgument(new Reference(RandomStringGenerator::class))
    ->addArgument(3);

$container
    ->register(Rot13Encoder::class, Rot13Encoder::class);

// Twig loader and environment
$container
    ->register(FilesystemLoader::class, FilesystemLoader::class)
    ->addArgument(__DIR__ . '/../templates');

$container
    ->register(Environment::class, Environment::class)
    ->addArgument(new Reference(FilesystemLoader::class));

// Controller
$container
    ->register(RandomController::class, RandomController::class)
    ->addArgument(new Reference(Environment::class))
    ->addArgument(new Reference(RandomStringGenerator::class))
    ->addArgument(new Reference(RandomArrayGenerator::class))
    ->addArgument(new Reference(Rot13Encoder::class));

return $container;
