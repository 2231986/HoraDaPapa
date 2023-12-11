<?php

namespace backend\tests\unit;

use app\models\Helpticket;
use common\models\User;
use Yii;

class HelpticketTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testHelpticketValidation()
    {
        // Create a new user for testing
        $user = new User();
        $user->setAttributes([
            'id' => 1,
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password_hash' => 'hashedpassword',
        ]);
        $user->save();

        $helpticket = new Helpticket();

        // Test with valid data
        $helpticket->setAttributes([
            'user_id' => 1,
            'needHelp' => 1,
            'description' => 'Need assistance',
        ]);

        $this->assertTrue($helpticket->validate(), 'Validation passed with valid data');

        // Test with missing required data
        $helpticket->setAttributes([
            'user_id' => null,
            'needHelp' => null,
            'description' => null,
        ]);

        $this->assertFalse($helpticket->validate(), 'Validation failed with missing required data');
    }

    public function testHelpticketAttributes()
    {
        $helpticket = new Helpticket();

        // Test attribute assignments
        $helpticket->user_id = 1;
        $helpticket->needHelp = 1;
        $helpticket->description = 'Urgent help needed';

        $this->assertEquals(1, $helpticket->user_id, 'User ID attribute assigned correctly');
        $this->assertEquals(1, $helpticket->needHelp, 'NeedHelp attribute assigned correctly');
        $this->assertEquals('Urgent help needed', $helpticket->description, 'Description attribute assigned correctly');
    }

    public function testHelpticketGetTodayTickets()
    {
        // Create a new user for testing
        $user = new User();
        $user->setAttributes([
            'id' => 1,
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password_hash' => 'hashedpassword',
        ]);
        $user->save();

        // Create help tickets for today and yesterday
        $todayTicket = new Helpticket();
        $todayTicket->setAttributes([
            'user_id' => $user->id,
            'needHelp' => 1,
            'description' => 'Today ticket',
            'date_time' => date('Y-m-d H:i:s'),
        ]);
        $todayTicket->save();

        $yesterdayTicket = new Helpticket();
        $yesterdayTicket->setAttributes([
            'user_id' => $user->id,
            'needHelp' => 1,
            'description' => 'Yesterday ticket',
            'date_time' => date('Y-m-d', strtotime('-1 day')) . ' 12:00:00',
        ]);
        $yesterdayTicket->save();

        // Test the getTodayTickets method
        $todayTickets = $todayTicket->getTodayTickets();

        $this->assertCount(1, $todayTickets, 'Correct number of tickets for today');
        $this->assertEquals('Today ticket', $todayTickets[0]->description, 'Correct ticket retrieved for today');
    }
}
