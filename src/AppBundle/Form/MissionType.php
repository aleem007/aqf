<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\User;

class MissionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serviceDate', 'datetime')
            ->add('productName')
            ->add('quantity')
            ->add('destinationCountry')
            ->add('vendorName')
            ->add('vendorEmail')
            ->add('createdAt', 'datetime')
            ->add('updatedAt', 'datetime')
            ->add('client',EntityType::class,[
                // looks for choices from this entity
                'class' => User::class,
                'choice_label' => 'username',
            ])
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mission'
        ));
    }
}
