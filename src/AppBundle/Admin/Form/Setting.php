<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace AppBundle\Admin\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use JMS\DiExtraBundle\Annotation\FormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @FormType
 */
class Setting extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        $builder->add('name')
                ->add('email')
                ->add('city')
                ->add('state', 'choice', ['choices' => 
                    [
                            'AL'=>'Alabama',
                            'AK'=>'Alaska',
                            'AZ'=>'Arizona',
                            'AR'=>'Arkansas',
                            'CA'=>'California',
                            'CO'=>'Colorado',
                            'CT'=>'Connecticut',
                            'DE'=>'Delaware',
                            'DC'=>'District of Columbia',
                            'FL'=>'Florida',
                            'GA'=>'Georgia',
                            'HI'=>'Hawaii',
                            'ID'=>'Idaho',
                            'IL'=>'Illinois',
                            'IN'=>'Indiana',
                            'IA'=>'Iowa',
                            'KS'=>'Kansas',
                            'KY'=>'Kentucky',
                            'LA'=>'Louisiana',
                            'ME'=>'Maine',
                            'MD'=>'Maryland',
                            'MA'=>'Massachusetts',
                            'MI'=>'Michigan',
                            'MN'=>'Minnesota',
                            'MS'=>'Mississippi',
                            'MO'=>'Missouri',
                            'MT'=>'Montana',
                            'NE'=>'Nebraska',
                            'NV'=>'Nevada',
                            'NH'=>'New Hampshire',
                            'NJ'=>'New Jersey',
                            'NM'=>'New Mexico',
                            'NY'=>'New York',
                            'NC'=>'North Carolina',
                            'ND'=>'North Dakota',
                            'OH'=>'Ohio',
                            'OK'=>'Oklahoma',
                            'OR'=>'Oregon',
                            'PA'=>'Pennsylvania',
                            'RI'=>'Rhode Island',
                            'SC'=>'South Carolina',
                            'SD'=>'South Dakota',
                            'TN'=>'Tennessee',
                            'TX'=>'Texas',
                            'UT'=>'Utah',
                            'VT'=>'Vermont',
                            'VA'=>'Virginia',
                            'WA'=>'Washington',
                            'WV'=>'West Virginia',
                            'WI'=>'Wisconsin',
                            'WY'=>'Wyoming'

                    ]]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['validation_groups' => 'admin', 'data_class' => 'AppBundle\Entity\AdminObject\Setting']);
    }
    
    
    public function getName() 
    {
        return 'setting';
    }


}
