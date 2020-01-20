<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimetablesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimetablesTable Test Case
 */
class TimetablesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TimetablesTable
     */
    public $Timetables;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Timetables',
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
        $config = TableRegistry::getTableLocator()->exists('Timetables') ? [] : ['className' => TimetablesTable::class];
        $this->Timetables = TableRegistry::getTableLocator()->get('Timetables', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Timetables);

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
