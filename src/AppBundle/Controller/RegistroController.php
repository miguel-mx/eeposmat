<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Registro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Registro controller.
 *
 * @Route("registro")
 */
class RegistroController extends Controller
{
    /**
     * Lists all registro entities.
     *
     * @Route("/", name="registro_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $em = $this->getDoctrine()->getManager();

        $registros = $em->getRepository('AppBundle:Registro')->findAll();

        return $this->render('registro/index.html.twig', array(
            'registros' => $registros,
        ));
    }

    /**
     * Creates a new registro entity.
     *
     * @Route("/new", name="registro_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        // TODO: Especificar fecha límite
        $now = new \DateTime();
        $deadline = new \DateTime('2018-06-30');
        if($now >= $deadline)
            return $this->render(':registro:closed.html.twig');

        $registro = new Registro();
        $form = $this->createForm('AppBundle\Form\RegistroType', $registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($registro);
            $em->flush();

            $mailer = $this->container->get('mailer');
            $message = \Swift_Message::newInstance()
                ->setSubject('Registro - Encuentro Nacional de Estudiantes de Posgrado en Matemáticas 2018')
                ->setFrom('eeposmat@matmor.unam.mx')
                ->setTo(array($registro->getEmail()))
                ->setBcc(array('miguel@matmor.unam.mx'))
                ->setBody($this->container->get('templating')->render('registro/confirmacion-email.txt.twig', array('registro' => $registro)))
            ;
            $mailer->send($message);

            if($registro->getBeca()) {
                // Email recomendacion
                $subject = 'Solicitud de recomendación para ' . $registro->getApaterno() . ' ' .$registro->getAmaterno() . ' ' .$registro->getNombre() ;
                // Envía correo de solicitud de recomendación 1
                $message = \Swift_Message::newInstance()
                    ->setSubject($subject)
                    ->setFrom('eeposmat@matmor.unam.mx')
                    ->setTo(array($registro->getEmailProfesor()))
                    ->setBcc(array('miguel@matmor.unam.mx'))
                    ->setBody($this->renderView('registro/solicitud-recomendacion.txt.twig', array(
                            'registro' => $registro)
                    ))
                ;
                $mailer->send($message);
            }

            return $this->render('registro/confirmacion.html.twig');
        }

        return $this->render('registro/new.html.twig', array(
            'registro' => $registro,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a registro entity.
     *
     * @Route("/{slug}", name="registro_show")
     * @Method("GET")
     */
    public function showAction(Registro $registro)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $deleteForm = $this->createDeleteForm($registro);

        return $this->render('registro/show.html.twig', array(
            'registro' => $registro,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Platicas
     *
     * @Route("/platicas/", name="registro_platicas")
     * @Method("GET")
     */
    public function platicasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ponentes = $em->getRepository('AppBundle:Registro')->findAllPlaticas();

        return $this->render('registro/platicas.html.twig', array(
            'ponentes' => $ponentes,
        ));
    }
    
    /**
     * Displays a form to edit an existing registro entity.
     *
     * @Route("/{slug}/edit", name="registro_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Registro $registro)
    {
        $deleteForm = $this->createDeleteForm($registro);
        $editForm = $this->createForm('AppBundle\Form\RegistroType', $registro);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('registro_edit', array('slug' => $registro->getSlug()));
        }

        return $this->render('registro/edit.html.twig', array(
            'registro' => $registro,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a registro entity.
     *
     * @Route("/{id}", name="registro_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Registro $registro)
    {
        $form = $this->createDeleteForm($registro);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($registro);
            $em->flush();
        }

        return $this->redirectToRoute('registro_index');
    }

    /**
     * Creates a form to delete a registro entity.
     *
     * @param Registro $registro The registro entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Registro $registro)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('registro_delete', array('id' => $registro->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
