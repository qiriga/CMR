<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/1/8
 * Time: 21:44
 */

namespace AppBundle\Controller;

use AppBundle\Entity\MedicineSort;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @Route("/admin/msort")
 * @Security("has_role('ROLE_ADMIN')")
 *
 * @author Qiriga HAN <qiriga@gmail.com>
 */
class MedicineSortController extends Controller
{
    /**
     * @Route("/", name="msort_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $msorts = $em->getRepository(MedicineSort::class)->findBy( [],['order' => 'DESC']);
        //echo($msorts->string);
        return $this->render('medicinesort/index.html.twig', ['msorts' => $msorts]);
    }

    /**
     * @Route("/{id}")
     */
    public function ByIdAction($id)
    {
        $medicinesorts = $this->getDoctrine()->getRepository(MedicineSort::class)->findOneBy($id);
        //dump($medicinesorts);
        return $this->render('/medicinesort/medicinesortindex.html.twig',array('medicinesorts' => $medicinesorts));
    }

    /**
     * @Route("/medicinesortcreate",name="createAction")
     */
    public function createAction(Request $request)
    {
        if ($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();

            $medicinesort = new medicinesort();
            $id = trim(com_create_guid(),'{}');
            $sMedicinesortname=$request->get('msortname');
            //return new Response(trim(com_create_guid(),'{}'));
            //$medicinesort->setsortid('273b8ae2-f413-11e7-8d2b-10604b5b84ce');
            $medicinesort->setSortId($id);
            $medicinesort->setSortName($sMedicinesortname);

            $em->persist($medicinesort);
            $em->flush();
            return $this->redirectToRoute('list');
        }
        return $this->render('/medicinesort/medicinesortcreate.html.twig');
    }


    /**
     * @Route("/Edit/{id}",name="msort_edit")
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $medicinesort = $em->getRepository(MedicineSort::class)->find($id);
        if(!$medicinesort){
            throw $this->createNotFoundException('No medicine sort found for id.'.$id);
        }
        $form = $this->createFormBuilder($medicinesort)
            ->add('sortId', TextType::class)
            ->add('sortName', TextType::class)
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $medicinesort = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            $em->persist($medicinesort);
            $em->flush();

            return $this->redirectToRoute('list');
        }
        return $this->render('/medicinesort/medicinesortedit.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/medicinesortremove/{id}")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $medicinesorts = $em->getRepository(MedicineSort::class)->find($id);

        $em->remove($medicinesorts);
        $em->flush();

        return $this->redirectToRoute('list');
    }
}