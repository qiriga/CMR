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
 * @ORM\Entity
 * @ORM\Table(name="MEENTREPRISE")
 */
class MEENTREPRISE
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string",name="id") */
    private $id;


    /** @ORM\Column(type="string",name="name") */
    private $name;


    /** @ORM\Column(type="string",name="address") */
    private $address;


    /** @ORM\Column(type="string",name="legalreprisentative") */
    private $legalreprisentative;



    /** @ORM\Column(type="string",name="tele") */
    private $tele;


    /** @ORM\Column(type="string",name="email") */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="CHMEDICINE", mappedBy="meentreprise")
     */
    private $chmedicines;

    public  function _construct()
    {
        $this->chmedicines = new ArrayCollection();
    }

    /**
     * @return MEENTREPRISE|CHMEDICINE[]
     */
    public function getChmedicine(): Collection
    {
        return $this->chmedicines;
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


}