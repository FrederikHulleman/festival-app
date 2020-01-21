<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TicketsFixture
 */
class TicketsFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'festival_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'date_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'visitor_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'confirmed' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => '0', 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'festival_key' => ['type' => 'index', 'columns' => ['festival_id'], 'length' => []],
            'date_key' => ['type' => 'index', 'columns' => ['date_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['visitor_id', 'festival_id', 'date_id'], 'length' => []],
            'tickets_ibfk_1' => ['type' => 'foreign', 'columns' => ['festival_id'], 'references' => ['festivals', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'tickets_ibfk_2' => ['type' => 'foreign', 'columns' => ['date_id'], 'references' => ['dates', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'tickets_ibfk_3' => ['type' => 'foreign', 'columns' => ['visitor_id'], 'references' => ['visitors', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'festival_id' => 1,
                'date_id' => 1,
                'visitor_id' => 1,
                'confirmed' => 1,
                'created' => '2020-01-21 09:15:52',
                'modified' => '2020-01-21 09:15:52',
            ],
        ];
        parent::init();
    }
}
