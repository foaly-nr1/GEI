<?php

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;
use AppBundle\Form\DataTransformer\MoneyTransformer;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class MoneyTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $dataTransformer = new MoneyTransformer($options['currency']);
        $builder->addModelTransformer($dataTransformer);
    }

    public function getExtendedType()
    {
        return MoneyType::class;
    }
}
