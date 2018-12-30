<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;
use App\Entity\About;
use App\Entity\Project;
use App\Entity\Techno;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(TranslatorInterface $translator, $about=1)
    {

        $translated = $translator->trans('symfony.is.great');

        //About Datas
        $repo = $this->getDoctrine()->getRepository(About::class);
        $about = $repo->find($about);

        //Projects Datas
        $repo = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $projects = $repo;


        return $this->render('default/index.html.twig', [
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
