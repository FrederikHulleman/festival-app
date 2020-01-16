<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TimetableFixture
 */
class TimetableFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'timetable';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'band_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'festival_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'date_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'stage_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'starttime' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'endtime' => ['type' => 'string', 'length' => 5, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'festival_key' => ['type' => 'index', 'columns' => ['festival_id'], 'length' => []],
            'date_key' => ['type' => 'index', 'columns' => ['date_id'], 'length' => []],
            'stage_key' => ['type' => 'index', 'columns' => ['stage_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['band_id', 'festival_id', 'date_id', 'stage_id'], 'length' => []],
            'timetable_ibfk_1' => ['type' => 'foreign', 'columns' => ['band_id'], 'references' => ['bands', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'timetable_ibfk_2' => ['type' => 'foreign', 'columns' => ['festival_id'], 'references' => ['festivals', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'timetable_ibfk_3' => ['type' => 'foreign', 'columns' => ['date_id'], 'references' => ['dates', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'timetable_ibfk_4' => ['type' => 'foreign', 'columns' => ['stage_id'], 'references' => ['stages', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
                'band_id' => 1,
                'festival_id' => 1,
                'date_id' => 1,
                'stage_id' => 1,
                'starttime' => 'Lor',
                'endtime' => 'Lor',
                'created' => '2020-01-16 11:30:01',
                'modified' => '2020-01-16 11:30:01',
            ],
        ];
        parent::init();
    }
}
