<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1467699265.
 * Generated on 2016-07-05 06:14:25 by root
 */
class PropelMigration_1467699265
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
CREATE TABLE "file"
(
    "id" serial NOT NULL,
    "name" VARCHAR(255),
    "extension" VARCHAR(255),
    "digest" VARCHAR(255) NOT NULL,
    "path" VARCHAR(255),
    "transform" TEXT,
    "source_id" INTEGER,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    PRIMARY KEY ("id"),
    CONSTRAINT "file_u_8d92ef" UNIQUE ("digest")
);

ALTER TABLE "file" ADD CONSTRAINT "file_fk_88032f"
    FOREIGN KEY ("source_id")
    REFERENCES "file" ("id");
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
DROP TABLE IF EXISTS "file" CASCADE;
',
);
    }

}