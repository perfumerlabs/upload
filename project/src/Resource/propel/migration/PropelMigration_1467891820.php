<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1467891820.
 * Generated on 2016-07-07 11:43:40 by root
 */
class PropelMigration_1467891820
{
    public $comment = '';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'upload' => '
ALTER TABLE "file"

  ADD "picked_at" TIMESTAMP;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'upload' => '
ALTER TABLE "file"

  DROP COLUMN "picked_at";
',
);
    }

}