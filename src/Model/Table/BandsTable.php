<?php

namespace App\Model\Table;

use Cake\ORM\Table;
//to be able to create a slug:
use Cake\Utility\Text;

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
}