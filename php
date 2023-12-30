Codeception PHP Testing Framework v5.0.13 https://stand-with-ukraine.pp.ua

[1mBackend\tests.functional Tests (4) [22m------------------------------------------------------------------------------------------------------------------------------------
- [35;1mLoginCest:[39;22m Login admin[32;1m✔[39;22m [35;1mLoginCest:[39;22m Login admin[32m(1.49s)[39m
- [35;1mLoginCest:[39;22m Login cooker[32;1m✔[39;22m [35;1mLoginCest:[39;22m Login cooker[32m(1.43s)[39m
- [35;1mLoginCest:[39;22m Login waiter[32;1m✔[39;22m [35;1mLoginCest:[39;22m Login waiter[32m(1.43s)[39m
- [35;1mLoginCest:[39;22m Login client[32;1m✔[39;22m [35;1mLoginCest:[39;22m Login client[32m(1.39s)[39m
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------

[1mBackend\tests.unit Tests (10) [22m-----------------------------------------------------------------------------------------------------------------------------------------
- [35;1mDinnerTest:[39;22m Dinner validation[32;1m✔[39;22m [35;1mDinnerTest:[39;22m Dinner validation[32m(0.01s)[39m
- [35;1mDinnerTest:[39;22m Dinner attributes[32;1m✔[39;22m [35;1mDinnerTest:[39;22m Dinner attributes[32m(0.00s)[39m
- [35;1mDinnerTest:[39;22m Dinner crud[32;1m✔[39;22m [35;1mDinnerTest:[39;22m Dinner crud[32m(0.01s)[39m
- [35;1mHelpticketTest:[39;22m Helpticket validation[32;1m✔[39;22m [35;1mHelpticketTest:[39;22m Helpticket validation[32m(1.37s)[39m
- [35;1mHelpticketTest:[39;22m Helpticket attributes[32;1m✔[39;22m [35;1mHelpticketTest:[39;22m Helpticket attributes[32m(0.00s)[39m
- [35;1mHelpticketTest:[39;22m Helpticket crud[32;1m✔[39;22m [35;1mHelpticketTest:[39;22m Helpticket crud[32m(1.37s)[39m
- [35;1mHelpticketTest:[39;22m Helpticket get today tickets[31;1mE[39;22m [35;1mHelpticketTest:[39;22m Helpticket get today tickets[32m(0.00s)[39m
- [35;1mSupplierTest:[39;22m Supplier validation[32;1m✔[39;22m [35;1mSupplierTest:[39;22m Supplier validation[32m(0.01s)[39m
- [35;1mSupplierTest:[39;22m Supplier attributes[32;1m✔[39;22m [35;1mSupplierTest:[39;22m Supplier attributes[32m(0.00s)[39m
- [35;1mSupplierTest:[39;22m Supplier crud[32;1m✔[39;22m [35;1mSupplierTest:[39;22m Supplier crud[32m(0.00s)[39m
-----------------------------------------------------------------------------------------------------------------------------------------------------------------------
Time: 00:08.729, Memory: 24.00 MB

There was 1 error:
1) [35;1mHelpticketTest:[39;22m Helpticket get today tickets
[37;41;1m Test  [39;49;22mtests/unit/HelpTicketTest.php:testHelpticketGetTodayTickets
[37;41;1m                                                                                                                                                                                                                                                                                      [39;49;22m
[37;41;1m  [yii\db\Exception] SQLSTATE[HY000]: General error: 1364 Field 'auth_key' doesn't have a default value
The SQL being executed was: INSERT INTO `user` (`username`, `email`, `status`, `created_at`, `updated_at`) VALUES ('testuser', 'test@example.com', 9, 1703897611, 1703897611)  [39;49;22m
[37;41;1m                                                                                                                                                                                                                                                                                      [39;49;22m
#1  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/Schema.php:676
#2  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/Command.php:1320
#3  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/Command.php:1120
#4  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/Schema.php:431
#5  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/ActiveRecord.php:604
#6  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/ActiveRecord.php:570
#7  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/BaseActiveRecord.php:687
#8  /Applications/MAMP/htdocs/HoraDaPapa/backend/tests/unit/HelpTicketTest.php:114
#9  /Applications/MAMP/htdocs/HoraDaPapa/vendor/bin/codecept:119
#1  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/Command.php:1320
#2  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/Command.php:1120
#3  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/Schema.php:431
#4  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/ActiveRecord.php:604
#5  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/ActiveRecord.php:570
#6  /Applications/MAMP/htdocs/HoraDaPapa/vendor/yiisoft/yii2/db/BaseActiveRecord.php:687
#7  /Applications/MAMP/htdocs/HoraDaPapa/backend/tests/unit/HelpTicketTest.php:114
#8  /Applications/MAMP/htdocs/HoraDaPapa/vendor/bin/codecept:119

[37;41;1mERRORS![39;49;22m
[37;41;1mTests: 14, Assertions: 41, Errors: 1.[39;49;22m
