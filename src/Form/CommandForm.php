<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 27/11/2020
 * Time: 11:22
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;

class CommandForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nameClient', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'maxLength' => 30,
                ]
            ])
            ->add('cellphoneNumber', NumberType::class, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('dateWish', TimeType::class, [
                'label' => 'Heure de récupération'
            ])
        ;
    }
}