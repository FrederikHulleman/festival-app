<?php
// src/Model/Table/FestivalsTable.php
namespace App\Model\Table;

use Cake\ORM\Table;

class FestivalsTable extends Table
{
    public function initialize(array $config)
    {
        $this->addBehavior('Timestamp');
    }
}