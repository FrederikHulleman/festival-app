<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timetable Entity
 *
 * @property int $band_id
 * @property int $festival_id
 * @property int $date_id
 * @property int $stage_id
 * @property string $starttime
 * @property string $endtime
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Band $band
 * @property \App\Model\Entity\Festival $festival
 * @property \App\Model\Entity\Date $date
 * @property \App\Model\Entity\Stage $stage
 */
class Timetable extends Entity
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
        'starttime' => true,
        'endtime' => true,
        'created' => true,
        'modified' => true,
        'band' => true,
        'festival' => true,
        'date' => true,
        'stage' => true,
    ];
}
