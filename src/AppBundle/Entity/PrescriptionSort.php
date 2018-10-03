<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/1/7
 * Time: 14:09
 */


namespace AppBundle\Entity;




use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="prescription_sort")
 * */
 class PrescriptionSort{
     /**
      * @ORM\Id
      * @ORM\Column(type="string",name="ps_id")
      */
     private $psId;

     /**
      * @ORM\Column(type="string",name="ps_name")
      */
     private $psName;

     /**
      * One Product has Many Features.
      * @ORM\OneToMany(targetEntity="Prescription", mappedBy="pS")
      */
    private $prescriptions;

     public function __construct() {
         $this->prescriptions = new ArrayCollection();
     }

     /**
      * @return mixed
      */
     public function getPsId()
     {
         return $this->psId;
     }

     /**
      * @param mixed $psId
      */
     public function setPsId($psId)
     {
         $this->psId = $psId;
     }

     /**
      * @return mixed
      */
     public function getPsName()
     {
         return $this->psName;
     }

     /**
      * @param mixed $psName
      */
     public function setPsName($psName)
     {
         $this->psName = $psName;
     }


 }