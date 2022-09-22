<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('permission_id')->unsigned()->nullable()->index();
            $table->bigInteger('role_id')->unsigned()->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('created_user_id')->nullable();
            $table->integer('updated_user_id')->nullable();
            $table->integer('deleted_user_id')->nullable();
        });

        /*Administrador*/
        DB::table('permission_role')->insert([
            'id'=>1,
            'role_id'=>1,
            'permission_id'=>1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>2,
            'role_id'=>1,
            'permission_id'=>12,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>3,
            'role_id'=>1,
            'permission_id'=>13,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>4,
            'role_id'=>1,
            'permission_id'=>14,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>5,
            'role_id'=>1,
            'permission_id'=>15,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>6,
            'role_id'=>1,
            'permission_id'=>16,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>7,
            'role_id'=>1,
            'permission_id'=>17,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>8,
            'role_id'=>1,
            'permission_id'=>18,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>9,
            'role_id'=>1,
            'permission_id'=>19,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        /******Promotor********/
        DB::table('permission_role')->insert([
            'id'=>10,
            'role_id'=>2,
            'permission_id'=>15,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>11,
            'role_id'=>2,
            'permission_id'=>16,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('permission_role')->insert([
            'id'=>12,
            'role_id'=>2,
            'permission_id'=>17,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);


        /********Vigilante**********/
        /*DB::table('permission_role')->insert([
            'id'=>13,
            'role_id'=>3,
            'permission_id'=>19,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
}
