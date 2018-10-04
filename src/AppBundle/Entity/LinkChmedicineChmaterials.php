<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/10/4
 * Time: 18:16
 */

namespace AppBundle\Entity;


class LinkChmedicineChmaterials
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
}