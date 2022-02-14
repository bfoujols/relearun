<?php

namespace App\Form;

use App\Entity\Version;
use App\Entity\Code;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class VersionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('createDate', DateTimeType::class, ['attr' => ['class'=>'form-control js-datepicker'], 'widget' => 'single_text', 'html5' => False, 'format' => 'yyyy-MM-dd',])
            ->add('code', EntityType::class, ['class'=>Code::class, 'choice_label' =>'name'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Version::class,
        ]);
    }
}
