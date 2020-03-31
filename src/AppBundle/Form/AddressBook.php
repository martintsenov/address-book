<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\AddressBook as AddressBookEntity;

class AddressBook extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('street')
            ->add('zipCode')
            ->add('city')
            ->add('country')
            ->add('phone')
            ->add('birthday', FormType\DateType::class, [
                'widget' => 'choice',
                'years' => range(date('Y')-80, date('Y')+20),
            ])
            ->add('email', FormType\EmailType::class)
            ->add('save', FormType\SubmitType::class, ['label' => 'Save'])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddressBookEntity::class,
        ]);
    }
}
