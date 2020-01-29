<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Utility\Text;

/**
 * Bands Model
 *
 * @property \App\Model\Table\Timetablestable&\Cake\ORM\Association\HasMany $Timetables
 *
 * @method \App\Model\Entity\Band get($primaryKey, $options = [])
 * @method \App\Model\Entity\Band newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Band[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Band|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Band saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Band patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Band[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Band findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BandsTable extends Table
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

        $this->setTable('bands');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Timetables', [
            'foreignKey' => 'band_id',
            'dependent' => true,
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
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name');

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

    public function createSlug($entity) {
        $slug = Text::slug($entity->name, '-');
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
        if($entity->isNew()) {
            //when adding a new entity: make sure the mandatory unique slug column is filled with a unique value
            //this because no ID is available here
            //the slug will be added after saving by the controller
            $entity->slug = uniqid();
        }
        else {
            $entity->slug = $this->createSlug($entity);
        }
    }

    public function findBySlug(Query $query, array $options)
    {
        $slug = $options['slug'];
        //also load nested assocations Dates & Stages, so band view can display date & stage info
        return $query->where(['bands.slug' => $slug])->contain(['Timetables' => ['Dates','Stages']]);
    }

}
