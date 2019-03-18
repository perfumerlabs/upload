<?php

use Propel\Generator\Manager\MigrationManager;

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1552893904.
 * Generated on 2019-03-18 07:25:04 by root
 */
class PropelMigration_1552893904
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

  ALTER COLUMN "is_image" DROP DEFAULT,

  ALTER COLUMN "is_image" DROP NOT NULL,

  ALTER COLUMN "content_type" DROP DEFAULT;

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

  ALTER COLUMN "is_image" SET DEFAULT \'t\',

  ALTER COLUMN "is_image" SET NOT NULL,

  ALTER COLUMN "content_type" SET DEFAULT \'image/jpeg\';

COMMIT;
',
);
    }

}