<?php

namespace App\Controller;

use App\Form\DefaultType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\About;
use App\Entity\Project;
use App\Entity\Techno;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(TranslatorInterface $translator, Request $request, $about=1)
    {

        $form = $this->createForm(DefaultType::class);

        //Get current request
        $form->handleRequest($request);

        if($form->isSubmitted()){

            die();
        }


        $translated = $translator->trans('symfony.is.great');

        //About Datas
        $repo = $this->getDoctrine()->getRepository(About::class);
        $about = $repo->find($about);

        //Projects Datas
        $repo = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $projects = $repo;


        return $this->render('default/index.html.twig', [
            'form'              => $form->createView(),
            'controller_name' => 'DefaultController',
            'projects' => $projects,
            'about' => $about,
            'msg' => $translated
        ]);
    }

    /**
     * @Route("/admin")
     */
    public function admin()
    {
        return $this->render('admin/default/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
