<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/1/6
 * Time: 21:02
 */

namespace AppBundle\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="medicine_sort")
 */
class MedicineSort{

    /**
     * @ORM\Id
     * @ORM\Column(name="ms_id")
     */
    private $sortId;


    /** @ORM\Column(type="string",name="ms_name", length=100) */
    private $sortName ;


    /**
     * @var int
     *
     * @ORM\Column(type="integer",name="order") */
    private $order ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $createAt ;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime" )
     * @Assert\DateTime
     */
    private $changeAt ;



    /**
     * One Product has Many Features.
     * @ORM\OneToMany(targetEntity="Medicine", mappedBy="medicineSort")
     */
    private $medicines;


    /**
     * @return mixed
     */
    public function getMedicines()
    {
        return $this->medicines;
    }

    /**
     * @param mixed $medicines
     */
    public function setMedicines($medicines)
    {
        $this->medicines = $medicines;
    }



    public function  __construct()
    {
        $this->medicines = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getSortId()
    {
        return $this->sortId;
    }

    /**
     * @param mixed $sortId
     */
    public function setSortId($sortId)
    {
        $this->sortId = $sortId;
    }

    /**
     * @return mixed
     */
    public function getSortName()
    {
        return $this->sortName;
    }

    /**
     * @param mixed $sortName
     */
    public function setSortName($sortName)
    {
        $this->sortName = $sortName;
    }

    /**
     * @return mixed
     */
    public function getMedicine()
    {
        return $this->medicines;
    }

    /**
     * @param mixed $medicine
     */
    public function setMedicine($medicine)
    {
        $this->medicines = $medicine;
    }



    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param mixed $createAt
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;
    }

    /**
     * @return mixed
     */
    public function getChangeAt()
    {
        return $this->changeAt;
    }

    /**
     * @param mixed $changeAt
     */
    public function setChangeAt($changeAt)
    {
        $this->changeAt = $changeAt;
    }

}