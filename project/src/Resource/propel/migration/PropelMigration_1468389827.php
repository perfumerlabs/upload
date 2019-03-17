<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1468389827.
 * Generated on 2016-07-13 06:03:47 by root
 */
class PropelMigration_1468389827
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

  ADD "dir" VARCHAR(255),

  DROP COLUMN "path";
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

  ADD "path" VARCHAR(255),

  DROP COLUMN "dir";
',
);
    }

}