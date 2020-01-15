<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FestivalsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FestivalsTable Test Case
 */
class FestivalsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FestivalsTable
     */
    public $Festivals;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Festivals',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Festivals') ? [] : ['className' => FestivalsTable::class];
        $this->Festivals = TableRegistry::getTableLocator()->get('Festivals', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Festivals);

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
}
