<?php

declare(strict_types=1);

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class FizzBuzzType extends AbstractType
{
    private const INI_FIELD = 'ini';
    private const END_FIELD = 'end';
    private const INI_LABEL = 'N° inicial';
    private const END_LABEL = 'N° de término';

    /**
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(self::INI_FIELD, IntegerType::class, [
                'label' => self::INI_LABEL,
                'required' => true,
            ])
            ->add(self::END_FIELD, IntegerType::class, [
                'label' => self::END_LABEL,
                'required' => true,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Generar FizzBuzz']);

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();

            if ($data[self::INI_FIELD] > $data[self::END_FIELD]) {
                $form->get(self::INI_FIELD)->addError(
                    new FormError(
                        sprintf(
                            'Campo %s debe ser menor que el campo %s',
                            self::INI_LABEL,
                            self::END_LABEL
                        )
                    )
                );
            }
        });
    }

    /**
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
