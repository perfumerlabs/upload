<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1541565142.
 * Generated on 2018-11-07 04:32:22 by root
 */
class PropelMigration_1541565142
{
    public $comment = '';

    public function preUp(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postUp(MigrationManager $manager)
    {
        // add the post-migration code here
    }

    public function preDown(MigrationManager $manager)
    {
        // add the pre-migration code here
    }

    public function postDown(MigrationManager $manager)
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
BEGIN;

ALTER TABLE "file"

  ADD "is_image" BOOLEAN DEFAULT \'t\' NOT NULL,

  ADD "content_type" VARCHAR(255) DEFAULT \'image/jpeg\';

COMMIT;
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
BEGIN;

ALTER TABLE "file"

  DROP COLUMN "is_image",

  DROP COLUMN "content_type";

COMMIT;
',
        );
    }

}