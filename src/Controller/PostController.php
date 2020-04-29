<?php

namespace App\Controller;

use App\Entity\Posts;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;  // return new Response("working");  without template show in browser message

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PostController extends AbstractController
{
  /**
   * @Route("/", name="post_list") // name is optional
   * @Method({"GET"})
   */
  public function index()
  {
    $posts = $this->getDoctrine()->getRepository(Posts::class)->findAll();

    return $this->render('home.html.twig', array('posts' => $posts));
  }


  /**
   * @Route("/insert", name="insert") // name is optional
   * Method({"GET", "POST"})
   */
  public function insert(Request $request)
  {
    $posts = new Posts();
    $form = $this->createFormBuilder($posts)
      ->add('name', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
      ->add('email', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
      ->add('message', TextareaType::class, array(
        'required' => false,
        'attr' => array('class' => 'form-control')
      ))
      ->add('save', SubmitType::class, array(
        'label' => 'Insert',
        'attr' => array('class' => 'btn btn-primary mt-3')
      ))
      ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($posts);
      $entityManager->flush();
      return $this->redirectToRoute('post_list');
    }

    return $this->render('insert.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * @Route("/update/{id}", name="update_message") // name is optional
   * Method({"GET","POST"})
   */
  public function update(Request $request, $id)
  {

    $posts = new Posts();
    $posts = $this->getDoctrine()->getRepository(Posts::class)->find($id);

    $form = $this->createFormBuilder($posts)
      ->add('name', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
      ->add('email', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control')))
      ->add('message', TextareaType::class, array(
        'required' => false,
        'attr' => array('class' => 'form-control')
      ))
      ->add('save', SubmitType::class, array(
        'label' => 'Insert',
        'attr' => array('class' => 'btn btn-primary mt-3')
      ))
      ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager = $this->getDoctrine()->getManager();

      $entityManager->flush();
      return $this->redirectToRoute('post_list');
    }

    return $this->render('insert.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * @Route("/delete/{id}")
   * @Method({"DELETE"})
   */
  public function delete(Request $request, $id)
  {
    $post = $this->getDoctrine()->getRepository(Posts::class)->find($id);

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->remove($post);
    $entityManager->flush();

    return $this->redirectToRoute('post_list');
  }
}
