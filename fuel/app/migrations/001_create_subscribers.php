<?php

namespace Fuel\Migrations;

class Create_subscribers
{
    // 🌟 Añadimos "static" a la función up
    public static function up()
    {
        \DBUtil::create_table('subscribers', array(
            'id' => array('type' => 'int', 'unsigned' => true, 'null' => false, 'auto_increment' => true, 'constraint' => 11),
            'email' => array('constraint' => 255, 'null' => false, 'type' => 'varchar'),
            'created_at' => array('constraint' => 11, 'null' => true, 'type' => 'int', 'unsigned' => true),
            'updated_at' => array('constraint' => 11, 'null' => true, 'type' => 'int', 'unsigned' => true),
        ), array('id'));
    }

    // 🌟 Añadimos "static" a la función down
    public static function down()
    {
        \DBUtil::drop_table('subscribers');
    }
}