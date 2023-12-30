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
        $user = new User();
        $user->username = "client";
        $user->email = "client@horadapapa.com";
        $user->setPassword("12345678");
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $this->assertTrue($user->save(), 'User criado');

        $helpticket = new Helpticket();

        // Test with valid data
        $helpticket->setAttributes([
            'user_id' => $user->id,
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

    public function testHelpticketCRUD()
    {
        $user = new User();
        $user->username = "client";
        $user->email = "client@horadapapa.com";
        $user->setPassword("12345678");
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        $this->assertTrue($user->save(), 'User criado');

        // Create a new helpticket
        $helpticket = new Helpticket([
            'user_id' =>  $user->id,
            'needHelp' => 1,
            'description' => 'New Help Request',
        ]);

        $this->assertTrue($helpticket->save(), 'Helpticket saved successfully');

        // Read the helpticket from the database
        $savedHelpticket = Helpticket::findOne($helpticket->id);

        $this->assertNotNull($savedHelpticket, 'Helpticket found in the database');
        $this->assertEquals('New Help Request', $savedHelpticket->description, 'Description is correct');

        // Update the helpticket
        $savedHelpticket->description = 'Updated Help Request';
        $savedHelpticket->save();

        // Read the updated helpticket from the database
        $updatedHelpticket = Helpticket::findOne($savedHelpticket->id);

        $this->assertEquals('Updated Help Request', $updatedHelpticket->description, 'Helpticket description updated successfully');

        // Delete the helpticket
        $updatedHelpticket->delete();

        // Try to find the deleted helpticket
        $deletedHelpticket = Helpticket::findOne($updatedHelpticket->id);

        $this->assertNull($deletedHelpticket, 'Helpticket deleted successfully');
    }

    public function testHelpticketGetTodayTickets()
    {
        // Create a new user for testing with auth_key set manually
        $user = new User();
        $user->username = 'testuser';
        $user->email = 'test@example.com';
        $user->password_hash = 'hashed-password';
        $user->auth_key = Yii::$app->security->generateRandomString(32); // Set auth_key manually here
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
