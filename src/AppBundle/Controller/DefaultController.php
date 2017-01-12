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
        $user = $this->container->get('security.context')->getToken()->getUser();
        $gitService = $this->get('git');
        $em = $this->getDoctrine()->getManager();
        $commentRepo = $em->getRepository('AppBundle:Comment');

        //get Github repo information
        $repo = $gitService->getOneRepo($gitUser, $repoId);

        //get comment for the selected repo
        $comments = $commentRepo->findBy(
            array('repoId' => $repoId),
            array('date' => 'desc')
        );

        // create form
        $comment = new Comment($repoId, $user);
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post = $form->getData();

            $em->persist($post);
            $em->flush();
        }

        return $this->render('AppBundle::addComment.html.twig', array(
            'form' => $form->createView(),
            'repo' => $repo,
            'comments' => $comments
        ));
    }
}
