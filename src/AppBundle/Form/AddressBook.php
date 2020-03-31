<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\AddressBook as AddressBookEntity;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use HtmlPurifier;

class AddressBook extends AbstractType
{
    /**
     * @var HtmlPurifier
     */
    private $htmlPurifier;

    public function __construct(HtmlPurifier $htmlPurifier)
    {
        $this->htmlPurifier = $htmlPurifier;
    }

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
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                [$this, 'sanitizeData']
            )
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

    /**
     * @param FormEvent $event
     */
    public function sanitizeData(FormEvent $event)
    {
        $data = $event->getData();

        if (!$data) {
            return;
        }

        if (isset($data['firstName'])) {
            $data['firstName'] = $this->htmlPurifier->purify($data['firstName']);
        }
        if (isset($data['lastName'])) {
            $data['lastName'] = $this->htmlPurifier->purify($data['lastName']);
        }
        if (isset($data['street'])) {
            $data['street'] = $this->htmlPurifier->purify($data['street']);
        }
        if (isset($data['zipCode'])) {
            $data['zipCode'] = $this->htmlPurifier->purify($data['zipCode']);
        }
        if (isset($data['city'])) {
            $data['city'] = $this->htmlPurifier->purify($data['city']);
        }
        if (isset($data['phone'])) {
            $data['phone'] = $this->htmlPurifier->purify($data['phone']);
        }

        $event->setData($data);
    }
}
