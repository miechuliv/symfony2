<?php

namespace Miechuliv\ImageForumBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Miechuliv\ImageForumBundle\Entity\Post;
use Miechuliv\ImageForumBundle\Form\PostType;
use Symfony\Component\Form\FormError;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{

    private function _canEditPost($post)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        return ($this->get('security.context')->isGranted('ROLE_ADMIN') || $user->getId() == $post->getAuthor()->getId());
    }
    /**
     * Lists all Post entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = false;
        // przykladowe ograniczanie dostepu dla danej roli
       // if($this->get('security.context')->isGranted('ROLE_ADMIN'))
       // {
         $entities = $em->getRepository('MiechulivImageForumBundle:Post')->findAll();
       // }
        

        return $this->render('MiechulivImageForumBundle:Post:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Post entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Post();
        
        
        
        $this->_setDefaultValuesForNewPost($entity);
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            
            // trzeba zapisac tez odwrotne wersje
            $categories = $entity->getCategories();
            foreach($categories  as $category)
            {
                $category->addPost($entity);
                $em->persist($entity);
            }
            
            $em->flush();

            return $this->redirect($this->generateUrl('post_show', array('id' => $entity->getId())));
        }

        return $this->render('MiechulivImageForumBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    
    private function _setDefaultValuesForNewPost($entity)
    {
        $now = new \DateTime();
        $entity->setDateAdded($now);
        $entity->setDateModified($now);
        $entity->setActive(1);
    }

    /**
     * Creates a form to create a Post entity.
     *
     * @param Post $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Post entity.
     *
     */
    public function newAction()
    {
        $entity = new Post();
        $form   = $this->createCreateForm($entity);

        return $this->render('MiechulivImageForumBundle:Post:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Post entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiechulivImageForumBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MiechulivImageForumBundle:Post:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Post entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiechulivImageForumBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('MiechulivImageForumBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Post entity.
    *
    * @param Post $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Post $entity)
    {
        $form = $this->createForm(new PostType(), $entity, array(
            'action' => $this->generateUrl('post_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Post entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('MiechulivImageForumBundle:Post')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Post entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);
            $editForm = $this->createEditForm($entity);
            $editForm->handleRequest($request);
        
        
        
        // jesli nie jestes adminem albo nie jestes tworca tego postu to nie mozesz go edytowac
        if(!$this->_canEditPost($entity))
        {
           
            $editForm->get('title')->addError(new FormError(
                    $this->get('translator')->trans('This post is not yours and you cannot edit it')
            ));
            
        }
        else
        {
            

            if ($editForm->isValid()) {
                $em->flush();

                return $this->redirect($this->generateUrl('post_edit', array('id' => $id)));
            }
        }

        

        return $this->render('MiechulivImageForumBundle:Post:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
           
        ));
    }
    /**
     * Deletes a Post entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('MiechulivImageForumBundle:Post')->find($id);
        
        if (!$entity) {
                throw $this->createNotFoundException('Unable to find Post entity.');
            }

        if ($this->_canEditPost($entity) && $form->isValid()) {
            

            

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('post'));
    }

    /**
     * Creates a form to delete a Post entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('post_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
