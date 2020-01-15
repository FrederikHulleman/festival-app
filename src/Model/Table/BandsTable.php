<?php

namespace App\Model\Table;

use Cake\ORM\Table;
//to be able to create a slug:
use Cake\Utility\Text;
// for validation purposes: 
use Cake\Validation\Validator;

class BandsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }

    public function beforeSave($event, $entity, $options)
    {
        if ($entity->isNew() && !$entity->slug) {
            $sluggedName = Text::slug($entity->name);
            // trim slug to maximum length defined in schema
            $entity->slug = substr($sluggedName, 0, 191);
        }
    }

    public function validationDefault(Validator $validator)
    {
        $validator
            ->allowEmptyString('name', false)
            ->minLength('name', 1)
            ->maxLength('name', 255)

            ->allowEmptyString('description', false)
            ->minLength('description', 10);

        return $validator;
    }
}