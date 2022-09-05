<?php

namespace App\Form;

use App\Entity\Payement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PayementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Type_de_payement', ChoiceType::class, array(
                'label' => false,
                'choices'  => [
                    
                    'par cheque' => 'par cheque',
                    'especes' => 'especes',
                ], 
            ))
            ->add('Nature_de_payement', ChoiceType::class, array(
                'label' => false,
                'choices'  => [
                    
                    'par tranche' => 'par tranche',
                    'comptant' => 'comptant',
                ], 
            ))
            ->add('Nombre_de_tranche')
            ->add('Montantpayee')
            ->add('Date_de_payement')
            ->add('Reference_Facture')
            ->add('Code')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Payement::class,
        ]);
    }
}
