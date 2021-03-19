<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                "constraints"=>[
                    new Email([
                        "message"=>"L'adresse {{value}} n'est pas une adresse email valide"
                    ])
                ]
            ])
 
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mdp ne peut pas être vide',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mdp doit contenir au moins {{ limit }} caracteres',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add("nom", TextType::class,[
                "constraints"=>[
                    new Length([
                        "max"=>50,
                        "maxMessage"=>"le nom ne peut pas contenir plus de {{ limit }} caracteres",
                        "min"=>2,
                        "minMessage"=>"le nom doit contenir au moins {{ limit }} caracteres"
                    ]),
                        new NotBlank([
                            'message' => 'Le nom ne peut pas être vide',
                        ])
                ]
            ])
            ->add("prenom", TextType::class,[
                "constraints"=>[
                    new Length([
                        "max"=>50,
                        "maxMessage"=>"le prenom ne peut pas contenir plus de {{ limit }} caracteres",
                        "min"=>2,
                        "minMessage"=>"le prenom doit contenir au moins {{ limit }} caracteres"
                    ]),
                        new NotBlank([
                            'message' => 'Le prenom ne peut pas être vide',
                        ])
                        ],
                        "label"=>"prénom"
            ])
            ->add("adresse", TextareaType::class,[
                "constraints"=>[
                    new NotBlank([
                        'message' => 'L\'adresse ne peut pas être vide',
                    ]) 
                ]
            ])
            ->add("cp", TextType::class,[
                "label"=>"code postal",
                "constraints"=>[
                    new Regex([
                        "pattern"=> "/^((0[1-9])|([1-8][0-9])|(9[0-8]))[0-9]{3}$/",
                        "message"=> "le code postal n'est pas un code valide"
                    ])
                ]
            ])
            ->add("ville", TextType::class,[
                "constraints"=>[
                    new NotBlank([
                        'message' => 'Le champ ville ne peut pas être vide',
                    ]) 
                ]
            ])
            ->add("tel", TelType::class,[
                "label"=>"téléphone",
                "constraints"=>[
                    new Regex([
                        "pattern"=> "/^0[0-9]{9}$/",
                        "message"=> "Le N° de tel n'est pas valide"
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'=>"Accepter les CGU",
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les CGU',
                    ]),
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
