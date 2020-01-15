<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Date Entity
 *
 * @property int $id
 * @property int $festival_id
 * @property \Cake\I18n\FrozenTime $starttime
 * @property \Cake\I18n\FrozenTime $endtime
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Festival $festival
 * @property \App\Model\Entity\Ticket[] $tickets
 * @property \App\Model\Entity\Timetable[] $timetable
 */
class Date extends Entity
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
        'festival_id' => true,
        'starttime' => true,
        'endtime' => true,
        'created' => true,
        'modified' => true,
        'festival' => true,
        'tickets' => true,
        'timetable' => true,
    ];
}
