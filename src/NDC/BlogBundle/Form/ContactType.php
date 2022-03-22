<?php

namespace NDC\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('from', 'email', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Adresse mail',
                ),
            ))
            ->add('message', 'textarea', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Message',
                    'rows' => '8',
                ),
            ))
            ->add('Envoyer', 'submit', array(
                'attr' => array(
                    'class' => 'btn btn-bloc',
                ),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NDC\BlogBundle\Entity\Contact'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ndc_blogbundle_contact';
    }
}
