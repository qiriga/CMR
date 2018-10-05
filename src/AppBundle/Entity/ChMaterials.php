<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/10/4
 * Time: 17:57
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="ChMaterials")
 */
class ChMaterials
{
    /**
     * Use constants to define configuration options that rarely change instead
     * of specifying them in app/config/config.yml.
     *
     * See https://symfony.com/doc/current/best_practices/configuration.html#constants-vs-configuration-options
     */
    const NUM_ITEMS = 10;

    /**
     * ID主键
     * @ORM\Id
     * @ORM\Column(type="string",name="id")
     */
    private $id;

    /**
     * 名称
     * @ORM\Column(type="string",name="name")
     */
    private $name;


    /**
     * 英文名称
     * @ORM\Column(type="string",name="en_name")
     */
    private $enName;



    /**
     * 道地药材
     * @ORM\Column(type="boolean",name="is_regional_drug")
     */
    private $isRegionalDrug;


    /**
     * 注释
     * @ORM\Column(type="string",name="note")
     */
    private $note;


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
     * @ORM\OneToMany(targetEntity="LinkChMedicineChMaterials",mappedBy="chMaterials",orphanRemoval=true)
     */
    private $linkChMedicineChMaterials;

    /**
     * @return ChMaterials|LinkChMedicineChMaterials[]
     */
    public function getLinkChMedicineChMaterials():Collection
    {
        return $this->linkChMedicineChMaterials;
    }


    /**
     * ChMaterials constructor.
     */
    public function __construct()
    {
        $this->linkChMedicineChMaterials = new ArrayCollection();
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
    public function getisRegionalDrug()
    {
        return $this->isRegionalDrug;
    }

    /**
     * @param mixed $isRegionalDrug
     */
    public function setIsRegionalDrug($isRegionalDrug)
    {
        $this->isRegionalDrug = $isRegionalDrug;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
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




}