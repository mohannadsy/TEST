<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTrigger extends Migration
{

    public function up()
    {
        DB::unprepared('CREATE TRIGGER add_User_name AFTER INSERT ON `users` FOR EACH ROW
                BEGIN

                    INSERT INTO `posts`(`id`,`title` ,`body`,`user_id`) VALUES (2,\'RABI\', \'CHANDRA\'," SELECT `LAST_INSERT_ID()` from  `users`");
                END');
    }
//                     SET user_id =  "  SELECT user_id FROM users ";
//SET id = ` SELECT LAST_INSERT_ID() from `users` `  ;
//                   INSERT INTO `users` (`name`) VALUES (`clauda`);

//INSERT INTO  `posts`(`id`,`title` ,`body`) VALUES (2,null,null);
    public function down()
    {
//        DB::unprepared('DROP TRIGGER `add_User_name`');
    }
}

;
