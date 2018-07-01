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

        $this->createTable('{{%courses_<?= $table ?>}}', [
        'id' => $this->primaryKey(),
        'title'=> $this->string(255),
        'desc'=> $this->string(255),
        'course_id' => $this->integer(11),
        'created_at' => $this->integer(),
        'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->createTable('{{%courses_<?= $table ?>_strings}}', [
        'id' => $this->primaryKey(),
        'title'=> $this->string(255),
        'desc'=> $this->string(255),
        'courses_<?= $table ?>_id' => $this->integer(11),
        'created_at' => $this->integer(),
        'updated_at' => $this->integer(),
        ], $tableOptions);

        $this->addForeignKey('fk_courses_<?= $table ?>_courses', '{{%courses_<?= $table ?>}}', 'course_id', '{{%course}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_courses_<?= $table ?>_courses_<?= $table ?>_strings', '{{%courses_<?= $table ?>_strings}}', 'courses_<?= $table ?>_id', '{{%courses_<?= $table ?>}}', 'id', 'cascade', 'cascade');

}


    /**
    * @inheritdoc
    */
    public function down()
    {
        $this->dropTable('{{%courses_<?= $table ?>}}');
        $this->dropTable('{{%courses_<?= $table ?>_strings}}');
        $this->dropForeignKey('fk_courses_<?= $table ?>_courses');
        $this->dropForeignKey('fk_courses_<?= $table ?>_courses_pain_strings');
    }
}
