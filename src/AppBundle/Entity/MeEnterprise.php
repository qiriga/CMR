<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/7/7
 * Time: 11:09
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MeEnterpriseRepository")
 * @ORM\Table(name="MeEnterprise")
 */
class MeEnterprise
{
    const NUM_ITEMS = 10;

    /**
     * @ORM\Id
     * @ORM\Column(type="string",name="id") */
    private $id;


    /** @ORM\Column(type="string",name="name") */
    private $name;

    /** @ORM\Column(type="string",name="en_name") */
    private $enName;


    /** @ORM\Column(type="string",name="address") */
    private $address;


    /** @ORM\Column(type="string",name="legalreprisentative") */
    private $legalreprisentative;



    /** @ORM\Column(type="string",name="tele") */
    private $tele;


    /** @ORM\Column(type="string",name="email") */
    private $email;


    /** @ORM\Column(type="datetime",name="Registration_time") */
    private $registrationTime;

    /** @ORM\Column(type="datetimetz",name="create_time") */
    private $createTime;

    /** @ORM\Column(type="datetimetz",name="update_time") */
    private $updateTime;


    /**
     * @ORM\OneToMany(targetEntity="ChMedicine", mappedBy="meEnterprise",orphanRemoval=true)
     */
    private $chMedicines;


    public  function _construct()
    {
        $this->chMedicines = new ArrayCollection();
    }

    /**
     * @return MeEnterprise|ChMedicine[]
     */
    public function getChMedicines(): Collection
    {
        return $this->chMedicines;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getLegalreprisentative()
    {
        return $this->legalreprisentative;
    }

    /**
     * @param mixed $legalreprisentative
     */
    public function setLegalreprisentative($legalreprisentative)
    {
        $this->legalreprisentative = $legalreprisentative;
    }

    /**
     * @return mixed
     */
    public function getTele()
    {
        return $this->tele;
    }

    /**
     * @param mixed $tele
     */
    public function setTele($tele)
    {
        $this->tele = $tele;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEnName()
    {
        return $this->enName;
    }

    /**
     * @param mixed $enName
     */
    public function setEnName($enName)
    {
        $this->enName = $enName;
    }

    /**
     * @return mixed
     */
    public function getRegistrationTime()
    {
        return $this->registrationTime;
    }

    /**
     * @param mixed $registrationTime
     */
    public function setRegistrationTime($registrationTime)
    {
        $this->registrationTime = $registrationTime;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param mixed $createTime
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @param mixed $updateTime
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;
    }




    public function addChMedicine(ChMedicine $chMedicine): self
    {
        if (!$this->chMedicines->contains($chMedicine)) {
            $this->chMedicines[] = $chMedicine;
            $chMedicine->setCategory($this);
        }
        return $this;
    }


    public function removeChMedicine(ChMedicine $chMedicine): self
    {
        if ($this->chMedicines->contains($chMedicine)) {
            $this->chMedicines->removeElement($chMedicine);
            // set the owning side to null (unless already changed)
            if ($chMedicine->getCategory() === $this) {
                $chMedicine->setCategory(null);
            }
        }

        return $this;
    }
}