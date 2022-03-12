<?php

namespace NDC\BlogBundle\Form;

use NDC\BlogBundle\Entity\Demo;
use NDC\BlogBundle\Repository\ArticleRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DemoType extends AbstractType
{
    /** @var  Demo */
    private $demo;

    public function __construct(Demo $demo)
    {
        $this->demo = $demo;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', null, array(
                'label' => 'Nom',
            ))
            ->add('article', null, array(
                'query_builder' => function(ArticleRepository $repo) {
                    return $repo->queryArticleWithoutDemo($this->demo);
                },
            ))
            ->add('dependency', 'choice', array(
                'label' => 'Raccourcis de dépendences',
                'choices'   => array(
                    'https://raw.github.com/necolas/normalize.css/master/normalize.css' => 'CSS Normalize',
                    'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css,https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js' => 'Bootstrap',
                    'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' => 'Font Awesome',
                    'https://raw.github.com/julianshapiro/velocity/master/velocity.min.js' => 'Velocity',
                ),
                'attr' => array(
                    'class' => 'checkbox-inline button-dependency',
                ),
                'multiple'  => true,
                'expanded'  => true,
                'mapped' => false,
            ))
            ->add('dependencies', null, array(
                'label' => 'Dépendences (jQuery inclus par défaut)',
                'required' => false,
                'attr' => array(
                    'rows' => '12',
                    'data-role' => 'dependencies-list',
                    'data-ajax' => 'dependencies',
                    'placeholder' => 'Liens des dépendences en .css ou .js, une par ligne',
                ),
            ))
            ->add('html', null, array(
                'label' => 'HTML',
                'required' => false,
                'attr' => array(
                    'rows' => '12',
                    'data-ajax' => 'html',
                ),
            ))
            ->add('css', null, array(
                'label' => 'CSS',
                'required' => false,
                'attr' => array(
                    'rows' => '12',
                    'data-ajax' => 'css',
                ),
            ))
            ->add('js', null, array(
                'label' => 'JS',
                'required' => false,
                'attr' => array(
                    'rows' => '12',
                    'data-ajax' => 'js',
                ),
            ))
            ->add('Enregistrer', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'NDC\BlogBundle\Entity\Demo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ndc_blogbundle_demo';
    }
}
