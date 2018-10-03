<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/1/15
 * Time: 8:04
 */


namespace AppBundle\Controller;

use AppBundle\Entity\Medicine;
use AppBundle\Entity\MedicineSort;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
* @Route("/admin/medicine")
* @Security("has_role('ROLE_ADMIN')")
*
* @author Ryan Weaver <qiriga@gmail.com>
*/
class MedicineController extends Controller
{
    /**
     * @Route("/medicinelist/{sortId}",name="list")
     * @ParamConverter("medicinesort", class="AppBundle:MedicineSort",options={"sortId" = "sortId"})
     * @Template()
     */
    public function listAction(MedicineSort $medicinesort)
    {
        $em = $this->getDoctrine()->getManager();
        //return new Response($medicinesort);
        $medicines = $em->getRepository(Medicine::class)->findBy(array('medicineSort' => $medicinesort));
        //return new Response('Jarrvie.');
        //$medicines = $this->getDoctrine()->getRepository(Medicine::class)->findBy();
        //dump($medicines);
        return $this->render('/medicine/medicineindex.html.twig',array('medicines' => $medicines));
    }

    /**
     * @Route("/medicinesearcheid/{id}")
     */
    public function ByIdAction($id)
    {
        $medicines = $this->getDoctrine()->getRepository(medicine::class)->findOneBy($id);
        //dump($medicines);
        return $this->render('/medicine/medicineindex.html.twig',array('medicines' => $medicines));
    }

    /**
     * @Route("/medicinecreate",name="createAction")
     */
    public function createAction()
    {
        $em = $this->getDoctrine()->getManager();

        $this->redirectToRoute('list');
        $medicine =  new medicine();
        $medicine->setSortId(com_create_guid());
        return new Response(com_create_guid());
        //$medicine->setsortid('273b8ae2-f413-11e7-8d2b-10604b5b84ce');
        $medicine->setSortName('abc');

        $em->persist($medicine);
        $em->flush();
        return $this->redirectToRoute('list');

    }


    /**
     * @Route("/medicineedit/{id}",name="updateAction")
     */
    public function editAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();

        $medicine = $em->getRepository(medicine::class)->find($id);
        if(!$medicine){
            throw $this->createNotFoundException('No medicine sort found for id.'.$id);
        }
        $form = $this->createFormBuilder($medicine)
            ->add('sortId', TextType::class)
            ->add('sortName', TextType::class)
            ->add('save', SubmitType::class, array('label' => '保 存'))
            ->getForm();


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $medicine = $form->getData();

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            $em->persist($medicine);
            $em->flush();

            return $this->redirectToRoute('list');
        }
        return $this->render('/medicine/medicineedit.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/medicineremove/{id}")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $medicines = $em->getRepository(medicine::class)->find($id);

        $em->remove($medicines);
        $em->flush();

        return $this->redirectToRoute('list');
    }
}