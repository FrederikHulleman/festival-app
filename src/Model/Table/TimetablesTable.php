<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Timetables Model
 *
 * @property \App\Model\Table\BandsTable&\Cake\ORM\Association\BelongsTo $Bands
 * @property \App\Model\Table\FestivalsTable&\Cake\ORM\Association\BelongsTo $Festivals
 * @property \App\Model\Table\DatesTable&\Cake\ORM\Association\BelongsTo $Dates
 * @property \App\Model\Table\StagesTable&\Cake\ORM\Association\BelongsTo $Stages
 *
 * @method \App\Model\Entity\Timetable get($primaryKey, $options = [])
 * @method \App\Model\Entity\Timetable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Timetable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Timetable|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timetable saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Timetable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Timetable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Timetable findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TimetablesTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('timetables');
        $this->setDisplayField('festival_id'.'-'.'date_id'.'-'.'starttime'.'-'.'band_id');
        $this->setPrimaryKey(['festival_id', 'date_id', 'starttime', 'band_id']);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Bands', [
            'foreignKey' => 'band_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Festivals', [
            'foreignKey' => 'festival_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Dates', [
            'foreignKey' => 'date_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Stages', [
            'foreignKey' => 'stage_id',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->time('starttime')
            ->requirePresence('starttime', 'create')
            ->notEmptyTime('starttime');

        $validator
            ->time('endtime')
            ->requirePresence('endtime', 'create')
            ->notEmptyTime('endtime');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['band_id'], 'Bands'));
        $rules->add($rules->existsIn(['festival_id'], 'Festivals'));
        $rules->add($rules->existsIn(['date_id'], 'Dates'));
        $rules->add($rules->existsIn(['stage_id'], 'Stages'));

        return $rules;
    }

}
