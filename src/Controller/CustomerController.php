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
        $this->addFlash('error', 'form.comment.content_not_blank');
        // dump($request->query->all());
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
            'search' => $request->query->get('search'),
            'page' => $request->query->get('page'),
            'local' => $request->getLocale(),
        ]);
    }
}
