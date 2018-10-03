<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/1/6
 * Time: 22:09
 */
namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="medicine")
 */
class Medicine
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string",name="medicine_id") */
    private $mId;

    /** @ORM\Column(type="string",name="medicine_name") */
    private $mName;

    /** @ORM\Column(type="string",name="alias") */
    private $alias;

    /** @ORM\Column(type="string",name="medicine_img") */
    private $mImg;

    /** @ORM\Column(type="string",name="medicine_source") */
    private $mSource;

    /** @ORM\Column(type="string",name="reference") */
    private $reference;

    /** @ORM\Column(type="string",name="medicine_birthplace") */
    private $mBirthplace;

    /** @ORM\Column(type="string",name="Original_form") */
    private $originalForm;

    /** @ORM\Column(type="string",name="medicine_function") */
    private $mFunction;

    /** @ORM\Column(type="string",name="property_flavor") */
    private $mFlavor;

    /** @ORM\Column(type="string",name="fufang") */
    private $fuFang;


    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="MedicineSort", inversedBy="medicines")
     * @ORM\JoinColumn(name="ms_id", referencedColumnName="ms_id")
     */
    private $medicineSort;



    /**
     * @return mixed
     */
    public function getMId()
    {
        return $this->mId;
    }

    /**
     * @param mixed $mId
     */
    public function setMId($mId)
    {
        $this->mId = $mId;
    }

    /**
     * @return mixed
     */
    public function getMName()
    {
        return $this->mName;
    }

    /**
     * @param mixed $mName
     */
    public function setMName($mName)
    {
        $this->mName = $mName;
    }

    /**
     * @return mixed
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param mixed $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return mixed
     */
    public function getMImg()
    {
        return $this->mImg;
    }

    /**
     * @param mixed $mImg
     */
    public function setMImg($mImg)
    {
        $this->mImg = $mImg;
    }

    /**
     * @return mixed
     */
    public function getMSource()
    {
        return $this->mSource;
    }

    /**
     * @param mixed $mSource
     */
    public function setMSource($mSource)
    {
        $this->mSource = $mSource;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return mixed
     */
    public function getMBirthplace()
    {
        return $this->mBirthplace;
    }

    /**
     * @param mixed $mBirthplace
     */
    public function setMBirthplace($mBirthplace)
    {
        $this->mBirthplace = $mBirthplace;
    }

    /**
     * @return mixed
     */
    public function getOriginalForm()
    {
        return $this->originalForm;
    }

    /**
     * @param mixed $originalForm
     */
    public function setOriginalForm($originalForm)
    {
        $this->originalForm = $originalForm;
    }

    /**
     * @return mixed
     */
    public function getMFunction()
    {
        return $this->mFunction;
    }

    /**
     * @param mixed $mFunction
     */
    public function setMFunction($mFunction)
    {
        $this->mFunction = $mFunction;
    }

    /**
     * @return mixed
     */
    public function getMFlavor()
    {
        return $this->mFlavor;
    }

    /**
     * @param mixed $mFlavor
     */
    public function setMFlavor($mFlavor)
    {
        $this->mFlavor = $mFlavor;
    }

    /**
     * @return mixed
     */
    public function getFuFang()
    {
        return $this->fuFang;
    }

    /**
     * @param mixed $fuFang
     */
    public function setFuFang($fuFang)
    {
        $this->fuFang = $fuFang;
    }

    /**
     * @return mixed
     */
    public function getMedicineSort()
    {
        return $this->medicineSort;
    }

    /**
     * @param mixed $medicineSort
     */
    public function setMedicineSort($medicineSort)
    {
        $this->medicineSort = $medicineSort;
    }

}

