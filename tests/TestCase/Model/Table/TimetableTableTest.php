<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimetableTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimetableTable Test Case
 */
class TimetableTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TimetableTable
     */
    public $Timetable;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Timetable',
        'app.Bands',
        'app.Festivals',
        'app.Dates',
        'app.Stages',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Timetable') ? [] : ['className' => TimetableTable::class];
        $this->Timetable = TableRegistry::getTableLocator()->get('Timetable', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Timetable);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
