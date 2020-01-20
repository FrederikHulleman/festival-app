<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Festival Entity
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string|null $description
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Date[] $dates
 * @property \App\Model\Entity\Stage[] $stages
 * @property \App\Model\Entity\Ticket[] $tickets
 * @property \App\Model\Entity\Timetable[] $timetables
 */
class Festival extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'title' => true,
        'slug' => false,
        'description' => true,
        'created' => true,
        'modified' => true,
        'dates' => true,
        'stages' => true,
        'tickets' => true,
        'timetables' => true,
    ];
}
