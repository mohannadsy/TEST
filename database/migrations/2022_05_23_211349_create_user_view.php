<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


class CreateUserView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement($this->dropView());

        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement($this->dropView());
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function createView(): string
    {
//        return <<<SQL
        \DB::statement("
            CREATE VIEW  view_user_data AS
                SELECT
                    users.id,
                    users.name,
                    users.email,
                    (SELECT count(*) FROM posts
                                WHERE posts.user_id = users.id
                            ) AS total_posts
                FROM users");
//                  SQL;
    }
    //                    (SELECT count(*) FROM comments
//                                WHERE comments.user_id = users.id
//                            ) AS total_comments

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    private function dropView(): string
    {

        return <<<SQL
DROP VIEW IF EXISTS `view_user_data`;
SQL;
    }
}
