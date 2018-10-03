<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/7/7
 * Time: 11:24
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CHMEDICINERepository")
 * @ORM\Table(name="CHMEDICINE")
 */
class CHMEDICINE
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     *
     * See https://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;

    /**
     * @ORM\Id
     * @ORM\Column(type="string",name="id") */
    private $id;

    /** @ORM\Column(type="string",name="enterid") */
    private $enterid;

    /** @ORM\Column(type="string",name="breed") */
    private $breed;                                /*品种*/

    /** @ORM\Column(type="string",name="Dosage_form") */
    private $Dosage_form;                          /*剂型*/

    /** @ORM\Column(type="string",name="prescription") */
    private $prescription;                         /*处方*/

    /** @ORM\Column(type="string",name="Drug_source") */
    private $Drug_source;                          /*方源*/

    /** @ORM\Column(type="string",name="regional_drug") */
    private $regional_drug;                       /*道地药材*/

    /** @ORM\Column(type="string",name="sales_amount") */
    private $sales_amount;                        /*销售额*/

    /** @ORM\Column(type="string",name="Approval_number") */
    private $Approval_number;                     /*批准文号*/





    /**
     * @ORM\ManyToOne(targetEntity="MEENTREPRISE", inversedBy="chmedicines")
     * @ORM\JoinColumn(name="enterid", referencedColumnName="id")
     */
    private $meentreprise;

    /**
     * @return mixed
     */
    public function getMeentreprise(): MEENTREPRISE
    {
        return $this->meentreprise;
    }

    /**
     * @param mixed $meentreprise
     */
    public function setMeentreprise(MEENTREPRISE $meentreprise):self
    {
        $this->meentreprise = $meentreprise;
        return $this;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getEnterid()
    {
        return $this->enterid;
    }

    /**
     * @param mixed $enterid
     */
    public function setEnterid($enterid)
    {
        $this->enterid = $enterid;
    }

    /**
     * @return mixed
     */
    public function getBreed()
    {
        return $this->breed;
    }

    /**
     * @param mixed $breed
     */
    public function setBreed($breed)
    {
        $this->breed = $breed;
    }

    /**
     * @return mixed
     */
    public function getDosage_form()
    {
        return $this->Dosage_form;
    }

    /**
     * @param mixed $Dosage_form
     */
    public function setDosage_form($Dosage_form)
    {
        $this->Dosage_form = $Dosage_form;
    }

    /**
     * @return mixed
     */
    public function getPrescription()
    {
        return $this->prescription;
    }

    /**
     * @param mixed $prescription
     */
    public function setPrescription($prescription)
    {
        $this->prescription = $prescription;
    }

    /**
     * @return mixed
     */
    public function getDrug_Source()
    {
        return $this->Drug_source;
    }

    /**
     * @param mixed $Drug_source
     */
    public function setDrug_Source($Drug_source)
    {
        $this->Drug_source = $Drug_source;
    }

    /**
     * @return mixed
     */
    public function getRegional_Drug()
    {
        return $this->regional_drug;
    }

    /**
     * @param mixed $regional_drug
     */
    public function setRegional_Drug($regional_drug)
    {
        $this->regional_drug = $regional_drug;
    }

    /**
     * @return mixed
     */
    public function getSales_Amount()
    {
        return $this->sales_amount;
    }

    /**
     * @param mixed $sales_amount
     */
    public function setSales_Amount($sales_amount)
    {
        $this->sales_amount = $sales_amount;
    }

    /**
     * @return mixed
     */
    public function getApproval_Number()
    {
        return $this->Approval_number;
    }

    /**
     * @param mixed $Approval_number
     */
    public function setApproval_Number($Approval_number)
    {
        $this->Approval_number = $Approval_number;
    }


}