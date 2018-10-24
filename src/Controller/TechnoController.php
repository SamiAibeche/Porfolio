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
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;



class TechnoController extends AbstractController
{
    /**
     * @Route("/admin/techno", name="admin_techno")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Techno::class);
        $technos = $repo->findBy(array(), array('name' => 'ASC'));

        return $this->render('admin/techno/index.html.twig', [
            'controller_name' => 'TechnoController',
            'technos' => $technos
        ]);
    }



    /**
     * @Route("/admin/techno/add", name="admin_techno_add")
     */
    public function add(Request $request, ValidatorInterface $validator)
    {
        $techno = new Techno();
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $errors = $validator->validate($techno);
            if (count($errors) > 0) {
                return $this->render('admin/techno/add.html.twig', [
                    'form'              => $form->createView(),
                    'controller_name' => 'TechnoController',
                    'errors' => $errors
                ]);
            }

            if($form->isValid()) {
                // get data in form
                $this->getDoctrine()->getManager()->persist($techno);
                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->set('success', 'The Technology has been successfully created !');
                return $this->redirectToRoute("admin_techno");
            }
        }


        return $this->render('admin/techno/add.html.twig', [
            'form'              => $form->createView(),
            'controller_name' => 'TechnoController'
        ]);
    }


    /**
     * @Route("/admin/techno/edit/{id}", name="admin_techno_edit")
     */
    public function edit(Request $request, ValidatorInterface $validator, $id)
    {
        $repo = $this->getDoctrine()->getRepository(Techno::class);
        $techno = $repo->find($id);
        $form = $this->createForm(TechnoType::class, $techno);
        $form->handleRequest($request);

        if($form->isSubmitted()) {

            $errors = $validator->validate($techno);
            if (count($errors) > 0) {
                return $this->render('admin/techno/add.html.twig', [
                    'form'              => $form->createView(),
                    'controller_name' => 'TechnoController',
                    'errors' => $errors
                ]);
            }

            if($form->isValid()){
                // get data in form
                $this->getDoctrine()->getManager()->persist($techno);
                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->set('success', 'The Technology has been successfully updated');
                return $this->render('admin/techno/add.html.twig', [
                    'form'            => $form->createView(),
                    'controller_name' => 'TechnoController'
                ]);
            }
        }


        return $this->render('admin/techno/add.html.twig', [
            'form'            => $form->createView(),
            'controller_name' => 'TechnoController',
        ]);
    }

    /**
     * @Route("/admin/techno/delete", name="admin_techno_delete")
     */
    public function delete(Request $request)
    {

        $id = $request->request->get("techno_id");
        $repo = $this->getDoctrine()->getRepository(Techno::class);
        $techno = $repo->find($id);


        // get data in form
        $this->getDoctrine()->getManager()->persist($techno);
        $this->getDoctrine()->getManager()->remove($techno);
        $this->getDoctrine()->getManager()->flush();
        $this->get('session')->getFlashBag()->set('deleted', 'The Technology has been successfully deleted');

        return $this->redirectToRoute("admin_techno");

    }
}
