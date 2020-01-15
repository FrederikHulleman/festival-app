<?php
// src/Model/Entity/Festival.php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Festival extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}