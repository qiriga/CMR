<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/10/4
 * Time: 18:16
 */

namespace AppBundle\Entity;



use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Link_ChMedicine_ChMaterials")
*/
class LinkChMedicineChMaterials
{
    const NUM_ITEMS = 10;

    /**
     * ID主键
     * @ORM\Id
     * @ORM\Column(type="string",name="id")
     */
    private $id;

    /**
     * 创建时间
     * @ORM\Column(type="string",name="material_id")
     */
    private $materialId;

    /**
     * 创建时间
     * @ORM\Column(type="string",name="medicine_id")
     */
    private $medicineId;

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
     * @ORM\ManyToOne(targetEntity="ChMedicine", inversedBy="linkChMedicineChMaterials")
     * @ORM\JoinColumn(name="medicine_id", referencedColumnName="id")
     */
    private $chMedicine;

    /**
     * @ORM\ManyToOne(targetEntity="ChMaterials", inversedBy="linkChMedicineChMaterials")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    private $chMaterials;

    /**
     * @return mixed
     */
    public function getChMedicine():ChMedicine
    {
        return $this->chMedicine;
    }

    /**
     * @param mixed $chMedicine
     */
    public function setChMedicine($chMedicine):self
    {
        $this->chMedicine = $chMedicine;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getChMaterials():ChMaterials
    {
        return $this->chMaterials;
    }

    /**
     * @param mixed $chMaterials
     */
    public function setChMaterials($chMaterials):self
    {
        $this->chMaterials = $chMaterials;
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
    public function getMaterialId()
    {
        return $this->materialId;
    }

    /**
     * @param mixed $materialId
     */
    public function setMaterialId($materialId)
    {
        $this->materialId = $materialId;
    }

    /**
     * @return mixed
     */
    public function getMedicineId()
    {
        return $this->medicineId;
    }

    /**
     * @param mixed $medicineId
     */
    public function setMedicineId($medicineId)
    {
        $this->medicineId = $medicineId;
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