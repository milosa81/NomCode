<?php

namespace NDC\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Nom',
                ),
            ))
            ->add('email', 'email', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Adresse mail',
                ),
            ))
            ->add('message', 'textarea', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Message',
                    'rows' => '6',
                ),
            ))
            ->add('Envoyer', 'submit', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Message',
                    'rows' => '6',
                    'class' => 'btn',
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
            'data_class' => 'NDC\BlogBundle\Entity\Comment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ndc_blogbundle_comment';
    }
}
