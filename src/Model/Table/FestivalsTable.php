<?php
namespace App\Model\Table;

use Cake\I18n\Date;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Festivals Model
 *
 * @property \App\Model\Table\DatesTable&\Cake\ORM\Association\HasMany $Dates
 * @property \App\Model\Table\StagesTable&\Cake\ORM\Association\HasMany $Stages
 * @property \App\Model\Table\TicketsTable&\Cake\ORM\Association\HasMany $Tickets
 * @property \App\Model\Table\Timetablestable&\Cake\ORM\Association\HasMany $Timetables
 *
 * @method \App\Model\Entity\Festival get($primaryKey, $options = [])
 * @method \App\Model\Entity\Festival newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Festival[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Festival|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Festival saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Festival patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Festival[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Festival findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FestivalsTable extends Table
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

        $this->setTable('festivals');
        $this->setDisplayField('title');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Dates', [
            'foreignKey' => 'festival_id',
        ]);
        $this->hasMany('Stages', [
            'foreignKey' => 'festival_id',
        ]);
        $this->hasMany('Tickets', [
            'foreignKey' => 'festival_id',
        ]);
        $this->hasMany('Timetables', [
            'foreignKey' => 'festival_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 255)
            ->requirePresence('title', 'create')
            ->notEmptyString('title');

        $validator
            ->scalar('slug')
            ->maxLength('slug', 191)
            //->requirePresence('slug', 'create')
            ->notEmptyString('slug')
            ->add('slug', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('description')
            ->allowEmptyString('description');

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
        $rules->add($rules->isUnique(['slug']));

        return $rules;
    }

    protected function createSlug($entity) {
        $slug = Text::slug($entity->title, '-');
        $slug = strtolower($slug);

        // trim slug to maximum length defined in schema (191)
        // taken into account that the id has to be added to the slug
        $slug = substr($slug, 0, 180);

        $params = array(
            'conditions' => array('slug' => $slug),
            'fields' => array('id', 'slug'));

        if (!empty($entity->id)) {
            $params['conditions']['not'] = array('id' => $entity->id);
        }

        $count_same_slug = $this->find('all', $params)->count();

        if (!empty($count_same_slug) && $count_same_slug > 0) {
            $slug = $slug . "-" . $entity->id;
        }

        return $slug;
    }

    public function beforeSave($event, $entity, $options)
    {
        $entity->slug = $this->createSlug($entity);
    }

    public function findBySlug(Query $query, array $options)
    {
        $slug = $options['slug'];
        return $query->where(['festivals.slug' => $slug])->contain(['Dates', 'Stages', 'Tickets', 'Timetables']);
    }

}
