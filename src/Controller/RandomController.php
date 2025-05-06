<?php

namespace Random\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Random\Generator\RandomStringGenerator;
use Random\Generator\RandomArrayGenerator;
use Random\Encoder\Rot13Encoder;
use InvalidArgumentException;

class RandomController
{
    private Environment $twig;
    private RandomStringGenerator $stringGenerator;
    private RandomArrayGenerator $arrayGenerator;
    private Rot13Encoder $encoder;

    public function __construct(
        Environment $twig,
        RandomStringGenerator $stringGenerator,
        RandomArrayGenerator $arrayGenerator,
        Rot13Encoder $encoder
    ) {
        $this->twig = $twig;
        $this->stringGenerator = $stringGenerator;
        $this->arrayGenerator = $arrayGenerator;
        $this->encoder = $encoder;
    }

    public function handle(Request $request): Response
    {
        $string = $encodedString = null;
        $array = $encodedArray = [];
        $error = null;

        $length = (int)($request->request->get('length', 14));
        $arrLength = (int)($request->request->get('arr_length', 3));
        // We can silence the errors here, if need be:
        //$length = max(1, min($length, RandomStringGenerator::MAX_LENGTH)); // limit to X chars
        //$arrLength = max(1, min($arrLength, RandomArrayGenerator::MAX_COUNT)); // limit to X

        if ($request->isMethod('POST')) {
            try {
                $stringGen = new RandomStringGenerator($length);
                $arrayGen = new RandomArrayGenerator($stringGen, $arrLength);
                $encoder = new Rot13Encoder();

                $string = $stringGen->generate();
                $encodedString = $encoder->encode($string);
                $array = $arrayGen->generate();
                $encodedArray = $encoder->encodeArray($array);
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage(); // ← This gets passed to Twig
            }
        }

        return new Response($this->twig->render('random.twig', [
            'length' => $length,
            'arr_length' => $arrLength,
            'max_length' => RandomStringGenerator::MAX_LENGTH,
            'max_arr_length' => RandomArrayGenerator::MAX_COUNT,
            'string' => $string,
            'array' => $array,
            'encoded_string' => $encodedString,
            'encoded_array' => $encodedArray,
            'error' => $error
        ]));
    }
}
