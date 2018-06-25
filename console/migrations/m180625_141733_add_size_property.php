<?php

use yii\db\Migration;

class m180625_141733_add_size_property extends Migration
{
    public function up()
    {
        $this->addColumn('{{%shop_products}}', 'size', $this->text());

    }

    public function down()
    {
        $this->dropColumn('{{%shop_products}}', 'size');
    }
}
