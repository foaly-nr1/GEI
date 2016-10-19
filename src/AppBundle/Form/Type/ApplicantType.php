<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Tenant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ApplicantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', Type\ChoiceType::class, [
                'required' => true,
                'choices' => [
                    'Lettings Long' => Tenant::TYPE_LETTINGS_LONG,
                    'Lettings Short' => Tenant::TYPE_LETTINGS_SHORT,
                    'Licensee' => Tenant::TYPE_LICENSEE,
                    'Sales' => Tenant::TYPE_SALES,
                    'Lettings Commercial' => Tenant::TYPE_LETTINGS_COMMERCIAL,
                ],
            ])
            ->add('negotiator', EntityType::class, [
                'class' => 'AppBundle:User',
                'choice_label' => 'displayName',
            ])
            ->add('source', Type\ChoiceType::class, [
                'choices' => [
                    'Another applicant' => Tenant::SOURCE_APPLICANT,
                    'Outdoor ad' => Tenant::SOURCE_OUTDOOR,
                    'Embassy' => Tenant::SOURCE_EMBASSY,
                    'Find-a-Property' => Tenant::SOURCE_FIND_A_PROPERTY,
                    'GEI website' => Tenant::SOURCE_WEBSITE,
                    'Gumtree' => Tenant::SOURCE_GUMTREE,
                    'Lonres' => Tenant::SOURCE_LONRES,
                    'Prime Location' => Tenant::SOURCE_PRIME_LOCATION,
                    'Other website' => Tenant::SOURCE_OTHER_WEBSITE,
                    'SpareRoom' => Tenant::SOURCE_SPAREROOM,
                    'Telephone enquiry' => Tenant::SOURCE_TELEPHONE,
                    'University Referral' => Tenant::SOURCE_UNIVERSITY,
                    'Walk-in' => Tenant::SOURCE_WALK_IN,
                    'Rightmove' => Tenant::SOURCE_RIGHTMOVE,
                    'Zoopla' => Tenant::SOURCE_ZOOPLA,
                ],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Tenant',
        ]);
    }
}
