<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/10/8
 * Time: 18:38
 */

namespace AppBundle\Controller;

use AppBundle\Entity\ChMaterials;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/admin/chmaterials")
 * @Security("has_role('ROLE_ADMIN')")
 *
 * @author Han Qiriga <QirigaHAN@jxutcm.edu.cn>
 */
class ChMaterialsController extends Controller
{
    /**
     * @Route("/allshow",name="chmaterials_list")
     */
    function showListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $chmaterials= $em->getRepository(ChMaterials::class)->findAll();
        ///$chmedicines = $em->getRepository(ChMedicine::class)->findBy(array('meentreprise' => 'ASC'));
        //return new Response('Jarrvie.');
        //dump($meenterpris);
        return $this->render('/chmedicines/chmaterialslist.html.twig', array('chmaterials' => $chmaterials));
    }
}