<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/1/7
 * Time: 14:29
 */

namespace AppBundle\Entity;




use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="prescription")
 */
class Prescription{

    /**
     * @ORM\Id
     * @ORM\Column(type="string",name="prescription_id")
     */
    private $prescriptionId;

    /** @ORM\Column(type="string",name="prescription_name") */
    private $prescriptioname;

    /** @ORM\Column(type="string",name="compose") */
    private $compose;

    /** @ORM\Column(type="string",name="usage_method") */
    private $usageMethod;

    /** @ORM\Column(type="string",name="prescription_function") */
    private $prescriptionFunction;

    /** @ORM\Column(type="string",name="fangjie") */
    private $fangJie;

    /** @ORM\Column(type="string",name="fangge") */
    private $fangge;

    /** @ORM\Column(type="string",name="prescriptionNotice") */
    private $prescriptionotice;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="PrescriptionSort", inversedBy="prescriptions")
     * @ORM\JoinColumn(name="$psId", referencedColumnName="ps_id")
     */
    private $pS;

    /**
     * @return mixed
     */
    public function getPrescriptionId()
    {
        return $this->prescriptionId;
    }

    /**
     * @param mixed $prescriptiond
     */
    public function setPrescriptionId($prescriptionId)
    {
        $this->prescriptiond = $prescriptionId;
    }

    /**
     * @return mixed
     */
    public function getPrescriptioname()
    {
        return $this->prescriptioname;
    }

    /**
     * @param mixed $prescriptioname
     */
    public function setPrescriptioname($prescriptioname)
    {
        $this->prescriptioname = $prescriptioname;
    }

    /**
     * @return mixed
     */
    public function getCompose()
    {
        return $this->compose;
    }

    /**
     * @param mixed $compose
     */
    public function setCompose($compose)
    {
        $this->compose = $compose;
    }

    /**
     * @return mixed
     */
    public function getUsageMethod()
    {
        return $this->usageMethod;
    }

    /**
     * @param mixed $usageMethod
     */
    public function setUsageMethod($usageMethod)
    {
        $this->usageMethod = $usageMethod;
    }

    /**
     * @return mixed
     */
    public function getPrescriptionFunction()
    {
        return $this->prescriptionFunction;
    }

    /**
     * @param mixed $prescriptionFunction
     */
    public function setPrescriptionFunction($prescriptionFunction)
    {
        $this->prescriptionFunction = $prescriptionFunction;
    }

    /**
     * @return mixed
     */
    public function getFangJie()
    {
        return $this->fangJie;
    }

    /**
     * @param mixed $fangJie
     */
    public function setFangJie($fangJie)
    {
        $this->fangJie = $fangJie;
    }

    /**
     * @return mixed
     */
    public function getFangge()
    {
        return $this->fangge;
    }

    /**
     * @param mixed $fangge
     */
    public function setFangge($fangge)
    {
        $this->fangge = $fangge;
    }

    /**
     * @return mixed
     */
    public function getPrescriptionotice()
    {
        return $this->prescriptionotice;
    }

    /**
     * @param mixed $prescriptionotice
     */
    public function setPrescriptionotice($prescriptionotice)
    {
        $this->prescriptionotice = $prescriptionotice;
    }

    /**
     * @return mixed
     */
    public function getPS()
    {
        return $this->pS;
    }

    /**
     * @param mixed $pS
     */
    public function setPS($pS)
    {
        $this->pS = $pS;
    }

}