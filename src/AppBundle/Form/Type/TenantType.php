<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\Tenant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TenantType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', Type\ChoiceType::class, [
                'required' => true,
                'placeholder' => 'Select an option',
                'choices' => [
                    'Lettings Long' => Tenant::TYPE_LETTINGS_LONG,
                    'Lettings Short' => Tenant::TYPE_LETTINGS_SHORT,
                    'Licensee' => Tenant::TYPE_LICENSEE,
                    'Sales' => Tenant::TYPE_SALES,
                    'Lettings Commercial' => Tenant::TYPE_LETTINGS_COMMERCIAL,
                ],
                'attr' => [
                    'class' => 'js-chosen-select',
                ],
            ])
            ->add('negotiator', EntityType::class, [
                'required' => false,
                'class' => 'AppBundle:User',
                'choice_label' => 'displayName',
                'placeholder' => 'Select an option',
                'attr' => [
                    'class' => 'js-chosen-select',
                ],
            ])
            ->add('createdAt', Type\DateTimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'disabled' => true,
            ])
            ->add('source', Type\ChoiceType::class, [
                'required' => false,
                'placeholder' => 'Select an option',
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
                'attr' => [
                    'class' => 'js-chosen-select',
                ],
            ])
            ->add('firstName', Type\TextType::class, [
                'required' => true,
            ])
            ->add('lastName', Type\TextType::class, [
                'required' => true,
            ])
            ->add('nationality', Type\CountryType::class, [
                'required' => false,
                'preferred_choices' => [
                    'GB',
                    'US',
                ],
                'attr' => [
                    'class' => 'js-chosen-select',
                ],
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $form = $event->getForm();
            /** @var Tenant $tenant */
            $tenant = $event->getData();

            $this->addSubTypeChoices($form, $tenant->getType());
        });
        $builder->get('type')->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm()->getParent();

            $this->addSubTypeChoices($form, $event->getForm()->getData());
        });
    }

    /**
     * @param FormInterface $form
     * @param int|null $type
     */
    private function addSubTypeChoices(FormInterface $form, int $type = null)
    {
        switch ($type) {
            default:
                $form->remove('subType');
                return;

            case Tenant::TYPE_LETTINGS_LONG:
                $choices = [
                    'tenant.subtype.employed' => Tenant::STATUS_EMPLOYED,
                    'tenant.subtype.self_employed' => Tenant::STATUS_SELF_EMPLOYED,
                    'tenant.subtype.student' => Tenant::STATUS_STUDENT,
                    'tenant.subtype.retired' => Tenant::STATUS_RETIRED,
                    'tenant.subtype.hb' => Tenant::STATUS_HB,
                    'tenant.subtype.sharer' => Tenant::STATUS_SHARER,
                    'tenant.subtype.room_let' => Tenant::STATUS_ROOM_LET,
                    'tenant.subtype.company' => Tenant::STATUS_COMPANY,
                    'tenant.subtype.commercial' => Tenant::STATUS_COMMERCIAL,
                ];
                break;

            case Tenant::TYPE_LETTINGS_SHORT:
                $choices = [
                    'tenant.subtype.holiday' => Tenant::STATUS_HOLIDAY,
                    'tenant.subtype.medical' => Tenant::STATUS_MEDICAL,
                    'tenant.subtype.complimentary' => Tenant::STATUS_COMPLIMENTARY,
                    'tenant.subtype.other' => Tenant::STATUS_OTHER,
                ];
                break;

            case Tenant::TYPE_SALES:
                $choices = [
                    'tenant.subtype.ftb' => Tenant::STATUS_FTB,
                    'tenant.subtype.investor' => Tenant::STATUS_INVESTOR,
                    'tenant.subtype.cash_buyer' => Tenant::STATUS_CASH,
                    'tenant.subtype.sold_sstc' => Tenant::STATUS_SSTC,
                    'tenant.subtype.property_to_sell' => Tenant::STATUS_TO_SELL,
                ];
                break;
        }

        $form->add('subType', Type\ChoiceType::class, [
            'required' => false,
            'label' => 'Status',
            'placeholder' => 'Select an option',
            'choices' => $choices,
            'choice_translation_domain' => 'contacts',
            'attr' => [
                'class' => 'js-chosen-select',
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tenant::class,
        ]);
    }
}
