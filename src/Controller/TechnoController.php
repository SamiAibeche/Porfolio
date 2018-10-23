<?php

namespace App\Controller;

use App\Entity\Techno;
use App\Form\TechnoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Form;
use Symfony\Component\Translation\TranslatorInterface;

class TechnoController extends AbstractController
{
    /**
     * @Route("/admin/techno", name="admin_techno")
     */
    public function index()
    {
        return $this->render('admin/techno/index.html.twig', [
            'controller_name' => 'TechnoController',
        ]);
    }



    /**
     * @Route("/admin/techno/add", name="admin_techno_add")
     */
    public function add(Request $request)
    {
        $techno = new Techno();
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // get data in form
            $this->getDoctrine()->getManager()->persist($techno);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute("admin_techno");
        }


        return $this->render('admin/techno/add.html.twig', [
            'form'              => $form->createView(),
            'controller_name' => 'TechnoController',
        ]);
    }
}
