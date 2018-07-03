<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Recomendacion;
use AppBundle\Entity\Registro;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Recomendacion controller.
 *
 * @Route("recomendacion")
 */
class RecomendacionController extends Controller
{
    /**
     * Lists all recomendacion entities.
     *
     * @Route("/", name="recomendacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');

        $em = $this->getDoctrine()->getManager();

        $recomendaciones = $em->getRepository('AppBundle:Recomendacion')->findAll();

        return $this->render('recomendacion/index.html.twig', array(
            'recomendaciones' => $recomendaciones,
        ));
    }

    /**
     * Creates a new recomendacion entity.
     *
     * @Route("/{slug}/{emailProfesor}/new", name="recomendacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, Registro $registro, $emailProfesor)
    {

        // Ya existe la recomendación.

        if($registro->getRecomendacion()) {
            return $this->redirectToRoute('recomendacion_show', array('slug' => $registro->getSlug()));
        }

        // TODO: Especificar fecha límite
        $now = new \DateTime();
        $deadline = new \DateTime('2018-07-09');
        if($now >= $deadline)
            return $this->render(':recomendacion:closed.html.twig');

        $recomendacion = new Recomendacion();
        $form = $this->createForm('AppBundle\Form\RecomendacionType', $recomendacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $recomendacion->setRegistro($registro);

            $em->persist($recomendacion);
            $em->flush();

            $this->addFlash(
                'notice',
                'Su recomendación ha sido recibida con éxito. Gracias!'
            );

            return $this->redirectToRoute('recomendacion_show', array('slug' => $registro->getSlug()));

        }

        return $this->render('recomendacion/new.html.twig', array(
            'recomendacion' => $recomendacion,
            'registro' => $registro,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a recomendacion entity.
     *
     * @Route("/{slug}", name="recomendacion_show")
     * @Method("GET")
     */
    public function showAction(Registro $registro)
    {

        return $this->render('recomendacion/show.html.twig', array(
            'registro' => $registro,
        ));
    }

}
