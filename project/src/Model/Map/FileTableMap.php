<?php

namespace Upload\Model\Map;

use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;
use Upload\Model\File;
use Upload\Model\FileQuery;


/**
 * This class defines the structure of the 'file' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FileTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.FileTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'upload';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'file';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Upload\\Model\\File';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'File';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 13;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 13;

    /**
     * the column name for the id field
     */
    const COL_ID = 'file.id';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'file.name';

    /**
     * the column name for the extension field
     */
    const COL_EXTENSION = 'file.extension';

    /**
     * the column name for the digest field
     */
    const COL_DIGEST = 'file.digest';

    /**
     * the column name for the is_image field
     */
    const COL_IS_IMAGE = 'file.is_image';

    /**
     * the column name for the content_type field
     */
    const COL_CONTENT_TYPE = 'file.content_type';

    /**
     * the column name for the dir field
     */
    const COL_DIR = 'file.dir';

    /**
     * the column name for the transform field
     */
    const COL_TRANSFORM = 'file.transform';

    /**
     * the column name for the source_id field
     */
    const COL_SOURCE_ID = 'file.source_id';

    /**
     * the column name for the picked_at field
     */
    const COL_PICKED_AT = 'file.picked_at';

    /**
     * the column name for the compressed_at field
     */
    const COL_COMPRESSED_AT = 'file.compressed_at';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'file.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'file.updated_at';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Id', 'Name', 'Extension', 'Digest', 'IsImage', 'ContentType', 'Dir', 'Transform', 'SourceId', 'PickedAt', 'CompressedAt', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'name', 'extension', 'digest', 'isImage', 'contentType', 'dir', 'transform', 'sourceId', 'pickedAt', 'compressedAt', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(FileTableMap::COL_ID, FileTableMap::COL_NAME, FileTableMap::COL_EXTENSION, FileTableMap::COL_DIGEST, FileTableMap::COL_IS_IMAGE, FileTableMap::COL_CONTENT_TYPE, FileTableMap::COL_DIR, FileTableMap::COL_TRANSFORM, FileTableMap::COL_SOURCE_ID, FileTableMap::COL_PICKED_AT, FileTableMap::COL_COMPRESSED_AT, FileTableMap::COL_CREATED_AT, FileTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'name', 'extension', 'digest', 'is_image', 'content_type', 'dir', 'transform', 'source_id', 'picked_at', 'compressed_at', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Name' => 1, 'Extension' => 2, 'Digest' => 3, 'IsImage' => 4, 'ContentType' => 5, 'Dir' => 6, 'Transform' => 7, 'SourceId' => 8, 'PickedAt' => 9, 'CompressedAt' => 10, 'CreatedAt' => 11, 'UpdatedAt' => 12, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'name' => 1, 'extension' => 2, 'digest' => 3, 'isImage' => 4, 'contentType' => 5, 'dir' => 6, 'transform' => 7, 'sourceId' => 8, 'pickedAt' => 9, 'compressedAt' => 10, 'createdAt' => 11, 'updatedAt' => 12, ),
        self::TYPE_COLNAME       => array(FileTableMap::COL_ID => 0, FileTableMap::COL_NAME => 1, FileTableMap::COL_EXTENSION => 2, FileTableMap::COL_DIGEST => 3, FileTableMap::COL_IS_IMAGE => 4, FileTableMap::COL_CONTENT_TYPE => 5, FileTableMap::COL_DIR => 6, FileTableMap::COL_TRANSFORM => 7, FileTableMap::COL_SOURCE_ID => 8, FileTableMap::COL_PICKED_AT => 9, FileTableMap::COL_COMPRESSED_AT => 10, FileTableMap::COL_CREATED_AT => 11, FileTableMap::COL_UPDATED_AT => 12, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'name' => 1, 'extension' => 2, 'digest' => 3, 'is_image' => 4, 'content_type' => 5, 'dir' => 6, 'transform' => 7, 'source_id' => 8, 'picked_at' => 9, 'compressed_at' => 10, 'created_at' => 11, 'updated_at' => 12, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('file');
        $this->setPhpName('File');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Upload\\Model\\File');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        $this->setPrimaryKeyMethodInfo('file_id_seq');
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', false, 255, null);
        $this->addColumn('extension', 'Extension', 'VARCHAR', false, 255, null);
        $this->addColumn('digest', 'Digest', 'VARCHAR', true, 255, null);
        $this->addColumn('is_image', 'IsImage', 'BOOLEAN', false, null, null);
        $this->addColumn('content_type', 'ContentType', 'VARCHAR', false, 255, null);
        $this->addColumn('dir', 'Dir', 'VARCHAR', false, 255, null);
        $this->addColumn('transform', 'Transform', 'LONGVARCHAR', false, null, null);
        $this->addForeignKey('source_id', 'SourceId', 'INTEGER', 'file', 'id', false, null, null);
        $this->addColumn('picked_at', 'PickedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('compressed_at', 'CompressedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Source', '\\Upload\\Model\\File', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':source_id',
    1 => ':id',
  ),
), null, null, null, false);
        $this->addRelation('FileRelatedById', '\\Upload\\Model\\File', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':source_id',
    1 => ':id',
  ),
), null, null, 'FilesRelatedById', false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? FileTableMap::CLASS_DEFAULT : FileTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (File object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FileTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FileTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FileTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FileTableMap::OM_CLASS;
            /** @var File $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FileTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = FileTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FileTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var File $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FileTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(FileTableMap::COL_ID);
            $criteria->addSelectColumn(FileTableMap::COL_NAME);
            $criteria->addSelectColumn(FileTableMap::COL_EXTENSION);
            $criteria->addSelectColumn(FileTableMap::COL_DIGEST);
            $criteria->addSelectColumn(FileTableMap::COL_IS_IMAGE);
            $criteria->addSelectColumn(FileTableMap::COL_CONTENT_TYPE);
            $criteria->addSelectColumn(FileTableMap::COL_DIR);
            $criteria->addSelectColumn(FileTableMap::COL_TRANSFORM);
            $criteria->addSelectColumn(FileTableMap::COL_SOURCE_ID);
            $criteria->addSelectColumn(FileTableMap::COL_PICKED_AT);
            $criteria->addSelectColumn(FileTableMap::COL_COMPRESSED_AT);
            $criteria->addSelectColumn(FileTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(FileTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.extension');
            $criteria->addSelectColumn($alias . '.digest');
            $criteria->addSelectColumn($alias . '.is_image');
            $criteria->addSelectColumn($alias . '.content_type');
            $criteria->addSelectColumn($alias . '.dir');
            $criteria->addSelectColumn($alias . '.transform');
            $criteria->addSelectColumn($alias . '.source_id');
            $criteria->addSelectColumn($alias . '.picked_at');
            $criteria->addSelectColumn($alias . '.compressed_at');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(FileTableMap::DATABASE_NAME)->getTable(FileTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FileTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FileTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FileTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a File or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or File object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FileTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Upload\Model\File) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FileTableMap::DATABASE_NAME);
            $criteria->add(FileTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = FileQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FileTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FileTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the file table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FileQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a File or Criteria object.
     *
     * @param mixed               $criteria Criteria or File object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FileTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from File object
        }

        if ($criteria->containsKey(FileTableMap::COL_ID) && $criteria->keyContainsValue(FileTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FileTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = FileQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FileTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FileTableMap::buildTableMap();
