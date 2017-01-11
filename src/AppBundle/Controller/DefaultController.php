<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $repos = array();
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, array(
                'label' => 'Nom Github '
            ))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gitUserName = $form->getData();

            $gitService = $this->get('git');
            $repos = $gitService->getRepos($gitUserName['name']);
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
            'repos' => $repos,
        ));
    }
}
