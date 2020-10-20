<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 16/10/2020
 * Time: 20:35
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class DetailForm extends AbstractType
{
    private $minChoice = 1;
    private $maxChoice = 10;
    private $choice = [];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', CollectionType::class, [
                'entry_type' => ChoiceType::class,
                'entry_options' => [
                    'label' => 'Nombre :',
                    'choices' => $this->valuesInteger(),
                ],
                'allow_add' => true,
                'prototype' => true,
            ])
        ;
    }

    public function valuesInteger()
    {
        for ($int = $this->minChoice; $int <= $this->maxChoice; $int++) {
            $this->choice[$int] = $int;
        }

        return $this->choice;
    }
}