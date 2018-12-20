<?php

namespace App\Controller;

use App\Entity\About;
use App\Form\AboutType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Form;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;


class AboutController extends AbstractController
{
    /**
    @Route("/admin/about", name="admin_about")     */
    public function index(Request $request, ValidatorInterface $validator, $id=1)
    {
        $repo = $this->getDoctrine()->getRepository(About::class);
        $about = $repo->find($id);
        $form = $this->createForm(AboutType::class, $about);

        //Get current request
        $form->handleRequest($request);

        //On submit
        if($form->isSubmitted()){

            //Check if there are some errors
            $errors = $validator->validate($about);
            //If yes, show error message
            if (count($errors) > 0) {
                return $this->render('admin/about/index.html.twig', [
                    'form'              => $form->createView(),
                    'controller_name' => 'AboutController',
                    'errors' => $errors
                ]);
            }
            //If not, store/update the data
            if($form->isValid()) {

                // Get data in form
                $this->getDoctrine()->getManager()->persist($about);
                $this->getDoctrine()->getManager()->flush();
                $this->get('session')->getFlashBag()->set('success', 'The Bio has been successfully updated !');
                return $this->redirectToRoute("admin_about");
            }
        }

        //Render
        return $this->render('admin/about/index.html.twig', [
            'form'              => $form->createView(),
            'controller_name'   => 'AboutController'
        ]);

    }
}
