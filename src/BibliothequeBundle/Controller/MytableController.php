<?php

namespace BibliothequeBundle\Controller;

use BibliothequeBundle\Entity\Mytable;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Mytable controller.
 *
 */
class MytableController extends Controller
{
    /**
     * Lists all mytable entities.
     *
     */
    public function indexAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $liste = $em->getRepository('BibliothequeBundle:Mytable')->findAll();

        $mytables  = $this->get('knp_paginator')->paginate(
           $liste,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
           10/*nbre d'éléments par page*/
       );


        $support=$em->getRepository('BibliothequeBundle:Mytable')->support();
        $code_face=$em->getRepository('BibliothequeBundle:Mytable')->code_face();
        $emplacement=$em->getRepository('BibliothequeBundle:Mytable')->emplacement();
        $region=$em->getRepository('BibliothequeBundle:Mytable')->regie();

        return $this->render('@Bibliotheque/mytable/index.html.twig', array(
            'mytables' => $mytables,
            'support'=>$support,
            'code_face'=>$code_face,
            'emplacement'=>$emplacement,
            'region'=>$region

        ));
    }

    public function recherche(Request $request)
    {

        $region = $request->request->get('region');
        $format = $request->request->get('format');
        $emplacement = $request->request->get('emplacement');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT * FROM BibliothequeBundle:Mytable p
       WHERE p.region ==region or p.format==format or p.emplacement=emplacement')
            ->setParameter('region',$region , 'format',$format , 'emplacement',$emplacement) ;


        $res = $query->getResult();

        return $this->render('@Bibliotheque/mytable/index.html.twig', array(
            'res' => $res));


    }
    /**
     * Creates a new mytable entity.
     *
     */
    public function newAction(Request $request)
    {
        $mytable = new Mytable();
        $form = $this->createForm('BibliothequeBundle\Form\MytableType', $mytable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($mytable);
            $em->flush();

            return $this->redirectToRoute('mytable_show', array('idface' => $mytable->getIdface()));
        }

        return $this->render('@Bibliotheque/mytable/new.html.twig', array(
            'mytable' => $mytable,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a mytable entity.
     *
     */
    public function showAction(Mytable $mytable)
    {
        $deleteForm = $this->createDeleteForm($mytable);

        return $this->render('@Bibliotheque/mytable/show.html.twig', array(
            'mytable' => $mytable,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mytable entity.
     *
     */
    public function editAction(Request $request, Mytable $mytable)
    {
        $deleteForm = $this->createDeleteForm($mytable);
        $editForm = $this->createForm('BibliothequeBundle\Form\MytableType', $mytable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mytable_edit', array('idface' => $mytable->getIdface()));
        }

        return $this->render('@Bibliotheque/mytable/edit.html.twig', array(
            'mytable' => $mytable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a mytable entity.
     *
     */
    public function deleteAction(Request $request, Mytable $mytable)
    {
        $form = $this->createDeleteForm($mytable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mytable);
            $em->flush();
        }

        return $this->redirectToRoute('mytable_index');
    }

    /**
     * Creates a form to delete a mytable entity.
     *
     * @param Mytable $mytable The mytable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mytable $mytable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mytable_delete', array('idface' => $mytable->getIdface())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }




    public function searchAction(Request $request)
    {

        $data=[];
        $em=$this->getDoctrine()->getManager();
        $entity=$em->getRepository(Mytable::class)->search($request);
        if($entity)
        {
            foreach ($entity as $ent)
            {
                $data[]=[
                    'idface'=>$ent->getidface(),
                    'reseau'=>$ent->getReseau(),
                    'zone'=>$ent->getZone(),
                    'region'=>$ent->getRegion(),
                    'regie'=>$ent->getRegie(),
                    'support'=>$ent->getSupport(),
                    'format'=>$ent->getFormat(),
                    'type'=>$ent->getType(),
                    'code_face'=>$ent->getCodeFace(),
                    'departement'=>$ent->getDepartement(),
                    'adresse'=>$ent->getAdresse(),
                    'emplecement'=>$ent->getEmplacement(),
                    'traffic'=>$ent->getTrafficRoutier2017(),
                    'xpan'=>$ent->getXPanneau(),
                    'ypan'=>$ent->getYPanneau(),
                    'photo'=>'uploads/'.$ent->getPhoto(),
                ];
            }
        }
        $response = new JsonResponse();
        $response->setStatusCode(200);
        $response->setData(
            array(
                'response' => 'success',
                'data'=>$data
            )
        );

        return $response;
    }
}
