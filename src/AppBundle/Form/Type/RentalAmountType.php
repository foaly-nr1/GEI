<?php

namespace AppBundle\Form\Type;

use AppBundle\Entity\RentalAmount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentalAmountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            /** @var RentalAmount $rentalAmount */
            $rentalAmount = $event->getData();
            $currencyCode = $rentalAmount->getAmount()->getCurrency()->getCode();

            $form = $event->getForm();
            $form
                ->add('amount', Type\MoneyType::class, [
                    'required' => true,
                    'currency' => $currencyCode,
                ])
                ->add('type', Type\ChoiceType::class, [
                    'required' => true,
                    'choices' => [
                        'pw' => RentalAmount::TYPE_PW,
                        'pcm' => RentalAmount::TYPE_PCM,
                    ],
                ])
            ;
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentalAmount::class,
        ]);
    }
}
