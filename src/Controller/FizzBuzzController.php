<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\Type\FizzBuzzType;
use App\Service\FizzBuzzGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FizzBuzzController extends AbstractController
{
    #[Route(
        path: '/desafio/fizz/buzz',
        name: 'fizz_buzz',
        methods: ['GET', 'POST']
    )]
    public function __invoke(Request $request, FizzBuzzGenerator $fizzBuzzGenerator): Response
    {
        $fizzBuzz = null;
        $form = $this->createForm(FizzBuzzType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $fizzBuzz = $fizzBuzzGenerator->__invoke($data['ini'], $data['end']);
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'fizz_buzz' => $fizzBuzz
        ]);
    }
}
