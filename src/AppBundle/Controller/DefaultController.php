<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $repos = array();
        $form = $this->createFormBuilder()
            ->add('name', TextType::class, array(
                'label' => 'Nom Github '
            ))
            ->add('Rechercher', SubmitType::class, array('label' => 'Rechercher','attr'  => array('class' => 'btn btn-default pull-right')))
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

    /**
     * @Route("/{gitUser}/{repoId}/comment", name="addComment")
     * @param string $gitUser
     * @param int $repoId
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addComment($gitUser, $repoId, Request $request)
    {
        $gitService = $this->get('git');
        $repo = $gitService->getOneRepo($gitUser, $repoId);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        return $this->render('AppBundle::addComment.html.twig', array(
            'form' => $form->createView(),
            'repo' => $repo,
        ));
    }
}
