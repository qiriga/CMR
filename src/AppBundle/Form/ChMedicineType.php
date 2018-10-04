<?php
/**
 * Created by PhpStorm.
 * User: QRG
 * Date: 2018/10/4
 * Time: 16:29
 */
namespace AppBundle\Form;

use AppBundle\Entity\ChMedicine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;



/**
 * Defines the form used to create and manipulate chinese medicines.
 *
 * @author Qiriga HAN <QirigaHAN@jxutcm.edu.cn>
 */
class ChMedicineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('summary', TextareaType::class)
            ->add('content', TextareaType::class)
            ->add('authorEmail', EmailType::class)
            ->add('publishedAt', DateTimeType::class)
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChMedicine::class,]);
    }
}