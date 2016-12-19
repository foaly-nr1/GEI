<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Property;
use AppBundle\Entity\PropertyCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyCriteriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', Type\CountryType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'js-chosen-select',
                ],
            ])
            ->add('visaRequired', Type\CheckboxType::class, [
                'required' => false,
            ])
            ->add('minRent', RentalAmountType::class, [
                'required' => false,
                'attr' => [
                    'min' => 1,
                ],
            ])
            ->add('maxRent', RentalAmountType::class, [
                'required' => false,
                'attr' => [
                    'min' => 1,
                ],
            ])
            ->add('minBeds', Type\IntegerType::class, [
                'required' => false,
                'attr' => [
                    'min' => 1,
                ],
            ])
            ->add('maxBeds', Type\IntegerType::class, [
                'required' => false,
                'attr' => [
                    'min' => 1,
                ],
            ])
            ->add('minTerm', Type\IntegerType::class, [
                'required' => false,
                'attr' => [
                    'min' => 0,
                ],
            ])
            ->add('maxTerm', Type\IntegerType::class, [
                'required' => false,
                'attr' => [
                    'min' => 0,
                ],
            ])
            ->add('furnished', Type\CheckboxType::class, [
                'required' => false,
            ])
            ->add('propertyType', Type\ChoiceType::class, [
                'required' => false,
                'choices' => [
                    'property.type.flat' => Property::TYPE_FLAT,
                    'property.type.house' => Property::TYPE_HOUSE,
                    'property.type.other' => Property::TYPE_OTHER,
                ],
                'choice_translation_domain' => 'properties',
            ])
            ->add('outsideSpace', Type\CheckboxType::class, [
                'required' => false,
            ])
            ->add('parking', Type\CheckboxType::class, [
                'required' => false,
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertyCriteria::class,
        ]);
    }
}
