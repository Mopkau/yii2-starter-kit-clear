<?php
/**
 * This view is used by console/controllers/MigrateController.php.
 *
 * The following variables are available in this view:
 */
/* @var $className string the new migration class name without namespace */
/* @var $namespace string the new migration class namespace */
/* @var $table string the name table */
/* @var $fields array the fields */
/* @var $foreignKeys array the foreign keys */

echo "<?php\n";
if (!empty($namespace)) {
    echo "\nnamespace {$namespace};\n";
}
?>

use yii\db\Migration;

/**
* Handles the creation of table `<?= $table ?>`.

*/
class <?= $className ?> extends Migration
{
    /**
    * @inheritdoc
    */

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%<?= $table ?>_category}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(512)->notNull(),
            'body' => $this->text(),
            'parent_id' => $this->integer(),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);


        $this->createTable('{{%<?= $table ?>}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(512)->notNull(),
            'body' => $this->text()->notNull(),
            'view' => $this->string(),
            'category_id' => $this->integer(),
            'base_url' => $this->string(1024),
            'base_path' => $this->string(1024),
            'author_id' => $this->integer(),
            'updater_id' => $this->integer(),
            'status' => $this->string(255),
            'published_at' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%<?= $table ?>_attachment}}', [
            'id' => $this->primaryKey(),
            '<?= $table ?>_id' => $this->integer()->notNull(),
            'path' => $this->string()->notNull(),
            'base_url' => $this->string(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'created_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('{{%<?= $table ?>_lang}}',[
            'id'=>$this->primaryKey(),
            '<?= $table ?>_id'=>$this->integer()->notNull(),
            'language'=>$this->string(6)->notNull(),
            'title'=> $this->string(512)->notNull(),
            'body'=> $this->text()->notNull()
        ]);

        $this->addForeignKey('<?= $table ?>_and_<?= $table ?>_lang','{{%<?= $table ?>_lang}}','<?= $table ?>_id','{{%<?= $table ?>}}','id','CASCADE','CASCADE');
        $this->addForeignKey('fk_<?= $table ?>_attachment_<?= $table ?>', '{{%<?= $table ?>_attachment}}', '<?= $table ?>_id', '{{%<?= $table ?>}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_<?= $table ?>_author', '{{%<?= $table ?>}}', 'author_id', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_<?= $table ?>_updater', '{{%<?= $table ?>}}', 'updater_id', '{{%user}}', 'id', 'set null', 'cascade');
        $this->addForeignKey('fk_<?= $table ?>_category', '{{%<?= $table ?>}}', 'category_id', '{{%<?= $table ?>_category}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_<?= $table ?>_category_section', '{{%<?= $table ?>_category}}', 'parent_id', '{{%<?= $table ?>_category}}', 'id', 'cascade', 'cascade');
    }


    /**
    * @inheritdoc
    */
    public function down()
    {
        $this->dropForeignKey('<?= $table ?>_and_<?= $table ?>_lang','{{%<?= $table ?>_lang}}');
        $this->dropForeignKey('fk_<?= $table ?>_attachment_<?= $table ?>', '{{%<?= $table ?>_attachment}}');
        $this->dropForeignKey('fk_<?= $table ?>_author', '{{%<?= $table ?>}}');
        $this->dropForeignKey('fk_<?= $table ?>_updater', '{{%<?= $table ?>}}');
        $this->dropForeignKey('fk_<?= $table ?>_category', '{{%<?= $table ?>}}');
        $this->dropForeignKey('fk_<?= $table ?>_category_section', '{{%<?= $table ?>_category}}');
        $this->dropTable('{{%<?= $table ?>_attachment}}');
        $this->dropTable('{{%<?= $table ?>_lang}}');
        $this->dropTable('{{%<?= $table ?>}}');
        $this->dropTable('{{%<?= $table ?>_category}}');
    }
}
