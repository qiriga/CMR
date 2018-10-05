<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/7/7
 * Time: 11:24
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ChMedicineRepository")
 * @ORM\Table(name="ChMedicine")
 */
class ChMedicine
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
     * @ORM\Column(type="string",name="id")
     * */
    private $id;

    /**
     * 生产企业ID
     * @ORM\Column(type="string",name="enter_id")
     */
    private $enterId;

    /**
     * 品种
     * @ORM\Column(type="string",name="breed")
     */
    private $breed;

    /**
     * 剂型
     * @ORM\Column(type="string",name="Dosage_form")
     */
    private $Dosage_form;


    /**
     * 方源
     * @ORM\Column(type="string",name="Drug_source")
     */
    private $Drug_source;


    /**
     * 销售额
     * @ORM\Column(type="string",name="sales_amount")
     */
    private $sales_amount;

    /**
     * 批准文号
     * @ORM\Column(type="string",name="Approval_number")
     */
    private $Approval_number;

    /**
     * 创建时间
     * @ORM\Column(type="datetimetz",name="create_time")
     */
    private $createTime;

    /**
     * 更新时间
     * @ORM\Column(type="datetimetz",name="update_time")
     */
    private $updateTime;

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }


    /**
    * @ORM\OneToMany(targetEntity="LinkChMedicineChMaterials",mappedBy="chMedicine",orphanRemoval=true)
    */
    private $linkChMedicineChMaterials;


    /**
     * @return ChMedicine|LinkChMedicineChMaterials[]
     * []
     */
    public function getLinkChMedicineChMaterials(): ArrayCollection
    {
        return $this->linkChMedicineChMaterials;
    }


    /**
     * @ORM\ManyToOne(targetEntity="MeEnterprise", inversedBy="chMedicines")
     * @ORM\JoinColumn(name="enter_id", referencedColumnName="id")
     */
    private $meEnterprise;

    /**
     * ChMedicine constructor.
     */
    public function __construct()
    {
        $this->linkChMedicineChMaterials = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getMeEnterprise(): MeEnterprise
    {
        return $this->meEnterprise;
    }

    /**
     * @param mixed $meEnterprise
     */
    public function setMeEnterprise(MeEnterprise $meEnterprise):self
    {
        $this->meEnterprise= $meEnterprise;
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
    public function getEnterId()
    {
        return $this->enterId;
    }

    /**
     * @param mixed $enterId
     */
    public function setEnterid($enterId)
    {
        $this->enterId = $enterId;
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