<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\Customer;

class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'customer')]
    public function index(Request $request): Response
    {
        $customer = new Customer();
        $form = $this->createFormBuilder($customer)
            ->add('name', TextType::class)
            ->add('age', TextType::class)
            ->add('address', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Valider'])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $customer = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();
            echo 'Envoyé';
        }

        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
            'form' => $form->createView(),
        ]);
    }
}
