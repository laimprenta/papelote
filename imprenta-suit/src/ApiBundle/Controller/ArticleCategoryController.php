<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\ArticleCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Articlecategory controller.
 *
 * @Route("category")
 */
class ArticleCategoryController extends Controller
{
    /**
     * Lists all articleCategory entities.
     *
     * @Route("/", name="category_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $articleCategories = $em->getRepository('ApiBundle:ArticleCategory')->findAll();

        return $this->render('articlecategory/index.html.twig', array(
            'articleCategories' => $articleCategories,
        ));
    }

    /**
     * Creates a new articleCategory entity.
     *
     * @Route("/new", name="category_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $articleCategory = new Articlecategory();
        $form = $this->createForm('ApiBundle\Form\ArticleCategoryType', $articleCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($articleCategory);
            $em->flush($articleCategory);

            return $this->redirectToRoute('category_show', array('id' => $articleCategory->getId()));
        }

        return $this->render('articlecategory/new.html.twig', array(
            'articleCategory' => $articleCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a articleCategory entity.
     *
     * @Route("/{id}", name="category_show")
     * @Method("GET")
     */
    public function showAction(ArticleCategory $articleCategory)
    {
        $deleteForm = $this->createDeleteForm($articleCategory);

        return $this->render('articlecategory/show.html.twig', array(
            'articleCategory' => $articleCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing articleCategory entity.
     *
     * @Route("/{id}/edit", name="category_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ArticleCategory $articleCategory)
    {
        $deleteForm = $this->createDeleteForm($articleCategory);
        $editForm = $this->createForm('ApiBundle\Form\ArticleCategoryType', $articleCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('category_edit', array('id' => $articleCategory->getId()));
        }

        return $this->render('articlecategory/edit.html.twig', array(
            'articleCategory' => $articleCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a articleCategory entity.
     *
     * @Route("/{id}", name="category_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ArticleCategory $articleCategory)
    {
        $form = $this->createDeleteForm($articleCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($articleCategory);
            $em->flush($articleCategory);
        }

        return $this->redirectToRoute('category_index');
    }

    /**
     * Creates a form to delete a articleCategory entity.
     *
     * @param ArticleCategory $articleCategory The articleCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ArticleCategory $articleCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('category_delete', array('id' => $articleCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
