<?php

namespace NDC\BlogBundle\Form;

use NDC\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{
    private $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', $this->user != null ? 'hidden' : 'text', array(
                'label' => false,
                'error_bubbling' => true,
                'attr' => array(
                    'placeholder' => 'Nom',
                ),
            ))
            ->add('email', $this->user != null ? 'hidden' : 'email', array(
                'label' => false,
                'error_bubbling' => true,
                'attr' => array(
                    'placeholder' => 'Adresse mail',
                ),
            ))
            ->add('message', 'textarea', array(
                'label' => false,
                'error_bubbling' => true,
                'attr' => array(
                    'placeholder' => 'Message',
                    'rows' => '6',
                ),
            ))
            ->add('Envoyer', 'submit', array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Message',
                    'class' => 'btn btn-bloc',
                    'data-type' => 'ajax',
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
