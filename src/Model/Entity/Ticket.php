<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Ticket Entity
 *
 * @property int $festival_id
 * @property int $date_id
 * @property int $visitor_id
 * @property bool|null $confirmed
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Festival $festival
 * @property \App\Model\Entity\Date $date
 * @property \App\Model\Entity\Visitor $visitor
 */
class Ticket extends Entity
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
        'confirmed' => true,
        'created' => true,
        'modified' => true,
        'festival' => true,
        'date' => true,
        'visitor' => true,
    ];
}
