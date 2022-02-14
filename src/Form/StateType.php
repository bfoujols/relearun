<?php

namespace App\Form;

use App\Entity\State;
use App\Entity\Env;
use App\Entity\Version;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class StateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('createdDate', DateTimeType::class, ['attr' => ['class'=>'form-control js-datepicker'], 'widget' => 'single_text', 'html5' => False, 'format' => 'yyyy-MM-dd',])
            ->add('name')
            ->add('env', EntityType::class, ['class'=>Env::class, 'choice_label'=>'name'])
            ->add('version', EntityType::class, ['class'=>Version::class, 'choice_label' => 'name'])
        ;
    }
   
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => State::class,
        ]);
    }
}
