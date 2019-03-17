<?php

namespace Upload\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use Upload\Model\File as ChildFile;
use Upload\Model\FileQuery as ChildFileQuery;
use Upload\Model\Map\FileTableMap;

/**
 * Base class that represents a query for the 'file' table.
 *
 *
 *
 * @method     ChildFileQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFileQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildFileQuery orderByExtension($order = Criteria::ASC) Order by the extension column
 * @method     ChildFileQuery orderByDigest($order = Criteria::ASC) Order by the digest column
 * @method     ChildFileQuery orderByIsImage($order = Criteria::ASC) Order by the is_image column
 * @method     ChildFileQuery orderByContentType($order = Criteria::ASC) Order by the content_type column
 * @method     ChildFileQuery orderByDir($order = Criteria::ASC) Order by the dir column
 * @method     ChildFileQuery orderByTransform($order = Criteria::ASC) Order by the transform column
 * @method     ChildFileQuery orderBySourceId($order = Criteria::ASC) Order by the source_id column
 * @method     ChildFileQuery orderByPickedAt($order = Criteria::ASC) Order by the picked_at column
 * @method     ChildFileQuery orderByCompressedAt($order = Criteria::ASC) Order by the compressed_at column
 * @method     ChildFileQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildFileQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ChildFileQuery groupById() Group by the id column
 * @method     ChildFileQuery groupByName() Group by the name column
 * @method     ChildFileQuery groupByExtension() Group by the extension column
 * @method     ChildFileQuery groupByDigest() Group by the digest column
 * @method     ChildFileQuery groupByIsImage() Group by the is_image column
 * @method     ChildFileQuery groupByContentType() Group by the content_type column
 * @method     ChildFileQuery groupByDir() Group by the dir column
 * @method     ChildFileQuery groupByTransform() Group by the transform column
 * @method     ChildFileQuery groupBySourceId() Group by the source_id column
 * @method     ChildFileQuery groupByPickedAt() Group by the picked_at column
 * @method     ChildFileQuery groupByCompressedAt() Group by the compressed_at column
 * @method     ChildFileQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildFileQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ChildFileQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFileQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFileQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFileQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildFileQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildFileQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildFileQuery leftJoinSource($relationAlias = null) Adds a LEFT JOIN clause to the query using the Source relation
 * @method     ChildFileQuery rightJoinSource($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Source relation
 * @method     ChildFileQuery innerJoinSource($relationAlias = null) Adds a INNER JOIN clause to the query using the Source relation
 *
 * @method     ChildFileQuery joinWithSource($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Source relation
 *
 * @method     ChildFileQuery leftJoinWithSource() Adds a LEFT JOIN clause and with to the query using the Source relation
 * @method     ChildFileQuery rightJoinWithSource() Adds a RIGHT JOIN clause and with to the query using the Source relation
 * @method     ChildFileQuery innerJoinWithSource() Adds a INNER JOIN clause and with to the query using the Source relation
 *
 * @method     ChildFileQuery leftJoinFileRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the FileRelatedById relation
 * @method     ChildFileQuery rightJoinFileRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the FileRelatedById relation
 * @method     ChildFileQuery innerJoinFileRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the FileRelatedById relation
 *
 * @method     ChildFileQuery joinWithFileRelatedById($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the FileRelatedById relation
 *
 * @method     ChildFileQuery leftJoinWithFileRelatedById() Adds a LEFT JOIN clause and with to the query using the FileRelatedById relation
 * @method     ChildFileQuery rightJoinWithFileRelatedById() Adds a RIGHT JOIN clause and with to the query using the FileRelatedById relation
 * @method     ChildFileQuery innerJoinWithFileRelatedById() Adds a INNER JOIN clause and with to the query using the FileRelatedById relation
 *
 * @method     \Upload\Model\FileQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildFile findOne(ConnectionInterface $con = null) Return the first ChildFile matching the query
 * @method     ChildFile findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFile matching the query, or a new ChildFile object populated from the query conditions when no match is found
 *
 * @method     ChildFile findOneById(int $id) Return the first ChildFile filtered by the id column
 * @method     ChildFile findOneByName(string $name) Return the first ChildFile filtered by the name column
 * @method     ChildFile findOneByExtension(string $extension) Return the first ChildFile filtered by the extension column
 * @method     ChildFile findOneByDigest(string $digest) Return the first ChildFile filtered by the digest column
 * @method     ChildFile findOneByIsImage(boolean $is_image) Return the first ChildFile filtered by the is_image column
 * @method     ChildFile findOneByContentType(string $content_type) Return the first ChildFile filtered by the content_type column
 * @method     ChildFile findOneByDir(string $dir) Return the first ChildFile filtered by the dir column
 * @method     ChildFile findOneByTransform(string $transform) Return the first ChildFile filtered by the transform column
 * @method     ChildFile findOneBySourceId(int $source_id) Return the first ChildFile filtered by the source_id column
 * @method     ChildFile findOneByPickedAt(string $picked_at) Return the first ChildFile filtered by the picked_at column
 * @method     ChildFile findOneByCompressedAt(string $compressed_at) Return the first ChildFile filtered by the compressed_at column
 * @method     ChildFile findOneByCreatedAt(string $created_at) Return the first ChildFile filtered by the created_at column
 * @method     ChildFile findOneByUpdatedAt(string $updated_at) Return the first ChildFile filtered by the updated_at column *

 * @method     ChildFile requirePk($key, ConnectionInterface $con = null) Return the ChildFile by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOne(ConnectionInterface $con = null) Return the first ChildFile matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFile requireOneById(int $id) Return the first ChildFile filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByName(string $name) Return the first ChildFile filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByExtension(string $extension) Return the first ChildFile filtered by the extension column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByDigest(string $digest) Return the first ChildFile filtered by the digest column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByIsImage(boolean $is_image) Return the first ChildFile filtered by the is_image column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByContentType(string $content_type) Return the first ChildFile filtered by the content_type column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByDir(string $dir) Return the first ChildFile filtered by the dir column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByTransform(string $transform) Return the first ChildFile filtered by the transform column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneBySourceId(int $source_id) Return the first ChildFile filtered by the source_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByPickedAt(string $picked_at) Return the first ChildFile filtered by the picked_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByCompressedAt(string $compressed_at) Return the first ChildFile filtered by the compressed_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByCreatedAt(string $created_at) Return the first ChildFile filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFile requireOneByUpdatedAt(string $updated_at) Return the first ChildFile filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFile[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFile objects based on current ModelCriteria
 * @method     ChildFile[]|ObjectCollection findById(int $id) Return ChildFile objects filtered by the id column
 * @method     ChildFile[]|ObjectCollection findByName(string $name) Return ChildFile objects filtered by the name column
 * @method     ChildFile[]|ObjectCollection findByExtension(string $extension) Return ChildFile objects filtered by the extension column
 * @method     ChildFile[]|ObjectCollection findByDigest(string $digest) Return ChildFile objects filtered by the digest column
 * @method     ChildFile[]|ObjectCollection findByIsImage(boolean $is_image) Return ChildFile objects filtered by the is_image column
 * @method     ChildFile[]|ObjectCollection findByContentType(string $content_type) Return ChildFile objects filtered by the content_type column
 * @method     ChildFile[]|ObjectCollection findByDir(string $dir) Return ChildFile objects filtered by the dir column
 * @method     ChildFile[]|ObjectCollection findByTransform(string $transform) Return ChildFile objects filtered by the transform column
 * @method     ChildFile[]|ObjectCollection findBySourceId(int $source_id) Return ChildFile objects filtered by the source_id column
 * @method     ChildFile[]|ObjectCollection findByPickedAt(string $picked_at) Return ChildFile objects filtered by the picked_at column
 * @method     ChildFile[]|ObjectCollection findByCompressedAt(string $compressed_at) Return ChildFile objects filtered by the compressed_at column
 * @method     ChildFile[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildFile objects filtered by the created_at column
 * @method     ChildFile[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildFile objects filtered by the updated_at column
 * @method     ChildFile[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FileQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Upload\Model\Base\FileQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'upload', $modelName = '\\Upload\\Model\\File', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFileQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFileQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFileQuery) {
            return $criteria;
        }
        $query = new ChildFileQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFile|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FileTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = FileTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFile A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, name, extension, digest, is_image, content_type, dir, transform, source_id, picked_at, compressed_at, created_at, updated_at FROM file WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFile $obj */
            $obj = new ChildFile();
            $obj->hydrate($row);
            FileTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildFile|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FileTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FileTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FileTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FileTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%', Criteria::LIKE); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the extension column
     *
     * Example usage:
     * <code>
     * $query->filterByExtension('fooValue');   // WHERE extension = 'fooValue'
     * $query->filterByExtension('%fooValue%', Criteria::LIKE); // WHERE extension LIKE '%fooValue%'
     * </code>
     *
     * @param     string $extension The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByExtension($extension = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($extension)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_EXTENSION, $extension, $comparison);
    }

    /**
     * Filter the query on the digest column
     *
     * Example usage:
     * <code>
     * $query->filterByDigest('fooValue');   // WHERE digest = 'fooValue'
     * $query->filterByDigest('%fooValue%', Criteria::LIKE); // WHERE digest LIKE '%fooValue%'
     * </code>
     *
     * @param     string $digest The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByDigest($digest = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($digest)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_DIGEST, $digest, $comparison);
    }

    /**
     * Filter the query on the is_image column
     *
     * Example usage:
     * <code>
     * $query->filterByIsImage(true); // WHERE is_image = true
     * $query->filterByIsImage('yes'); // WHERE is_image = true
     * </code>
     *
     * @param     boolean|string $isImage The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByIsImage($isImage = null, $comparison = null)
    {
        if (is_string($isImage)) {
            $isImage = in_array(strtolower($isImage), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(FileTableMap::COL_IS_IMAGE, $isImage, $comparison);
    }

    /**
     * Filter the query on the content_type column
     *
     * Example usage:
     * <code>
     * $query->filterByContentType('fooValue');   // WHERE content_type = 'fooValue'
     * $query->filterByContentType('%fooValue%', Criteria::LIKE); // WHERE content_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $contentType The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByContentType($contentType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($contentType)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_CONTENT_TYPE, $contentType, $comparison);
    }

    /**
     * Filter the query on the dir column
     *
     * Example usage:
     * <code>
     * $query->filterByDir('fooValue');   // WHERE dir = 'fooValue'
     * $query->filterByDir('%fooValue%', Criteria::LIKE); // WHERE dir LIKE '%fooValue%'
     * </code>
     *
     * @param     string $dir The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByDir($dir = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($dir)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_DIR, $dir, $comparison);
    }

    /**
     * Filter the query on the transform column
     *
     * Example usage:
     * <code>
     * $query->filterByTransform('fooValue');   // WHERE transform = 'fooValue'
     * $query->filterByTransform('%fooValue%', Criteria::LIKE); // WHERE transform LIKE '%fooValue%'
     * </code>
     *
     * @param     string $transform The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByTransform($transform = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($transform)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_TRANSFORM, $transform, $comparison);
    }

    /**
     * Filter the query on the source_id column
     *
     * Example usage:
     * <code>
     * $query->filterBySourceId(1234); // WHERE source_id = 1234
     * $query->filterBySourceId(array(12, 34)); // WHERE source_id IN (12, 34)
     * $query->filterBySourceId(array('min' => 12)); // WHERE source_id > 12
     * </code>
     *
     * @see       filterBySource()
     *
     * @param     mixed $sourceId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterBySourceId($sourceId = null, $comparison = null)
    {
        if (is_array($sourceId)) {
            $useMinMax = false;
            if (isset($sourceId['min'])) {
                $this->addUsingAlias(FileTableMap::COL_SOURCE_ID, $sourceId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sourceId['max'])) {
                $this->addUsingAlias(FileTableMap::COL_SOURCE_ID, $sourceId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_SOURCE_ID, $sourceId, $comparison);
    }

    /**
     * Filter the query on the picked_at column
     *
     * Example usage:
     * <code>
     * $query->filterByPickedAt('2011-03-14'); // WHERE picked_at = '2011-03-14'
     * $query->filterByPickedAt('now'); // WHERE picked_at = '2011-03-14'
     * $query->filterByPickedAt(array('max' => 'yesterday')); // WHERE picked_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $pickedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByPickedAt($pickedAt = null, $comparison = null)
    {
        if (is_array($pickedAt)) {
            $useMinMax = false;
            if (isset($pickedAt['min'])) {
                $this->addUsingAlias(FileTableMap::COL_PICKED_AT, $pickedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($pickedAt['max'])) {
                $this->addUsingAlias(FileTableMap::COL_PICKED_AT, $pickedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_PICKED_AT, $pickedAt, $comparison);
    }

    /**
     * Filter the query on the compressed_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCompressedAt('2011-03-14'); // WHERE compressed_at = '2011-03-14'
     * $query->filterByCompressedAt('now'); // WHERE compressed_at = '2011-03-14'
     * $query->filterByCompressedAt(array('max' => 'yesterday')); // WHERE compressed_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $compressedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByCompressedAt($compressedAt = null, $comparison = null)
    {
        if (is_array($compressedAt)) {
            $useMinMax = false;
            if (isset($compressedAt['min'])) {
                $this->addUsingAlias(FileTableMap::COL_COMPRESSED_AT, $compressedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($compressedAt['max'])) {
                $this->addUsingAlias(FileTableMap::COL_COMPRESSED_AT, $compressedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_COMPRESSED_AT, $compressedAt, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(FileTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(FileTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(FileTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(FileTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FileTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related \Upload\Model\File object
     *
     * @param \Upload\Model\File|ObjectCollection $file The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFileQuery The current query, for fluid interface
     */
    public function filterBySource($file, $comparison = null)
    {
        if ($file instanceof \Upload\Model\File) {
            return $this
                ->addUsingAlias(FileTableMap::COL_SOURCE_ID, $file->getId(), $comparison);
        } elseif ($file instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(FileTableMap::COL_SOURCE_ID, $file->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterBySource() only accepts arguments of type \Upload\Model\File or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Source relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function joinSource($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Source');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Source');
        }

        return $this;
    }

    /**
     * Use the Source relation File object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Upload\Model\FileQuery A secondary query class using the current class as primary query
     */
    public function useSourceQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinSource($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Source', '\Upload\Model\FileQuery');
    }

    /**
     * Filter the query by a related \Upload\Model\File object
     *
     * @param \Upload\Model\File|ObjectCollection $file the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildFileQuery The current query, for fluid interface
     */
    public function filterByFileRelatedById($file, $comparison = null)
    {
        if ($file instanceof \Upload\Model\File) {
            return $this
                ->addUsingAlias(FileTableMap::COL_ID, $file->getSourceId(), $comparison);
        } elseif ($file instanceof ObjectCollection) {
            return $this
                ->useFileRelatedByIdQuery()
                ->filterByPrimaryKeys($file->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByFileRelatedById() only accepts arguments of type \Upload\Model\File or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the FileRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function joinFileRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('FileRelatedById');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'FileRelatedById');
        }

        return $this;
    }

    /**
     * Use the FileRelatedById relation File object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Upload\Model\FileQuery A secondary query class using the current class as primary query
     */
    public function useFileRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinFileRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'FileRelatedById', '\Upload\Model\FileQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFile $file Object to remove from the list of results
     *
     * @return $this|ChildFileQuery The current query, for fluid interface
     */
    public function prune($file = null)
    {
        if ($file) {
            $this->addUsingAlias(FileTableMap::COL_ID, $file->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the file table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FileTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FileTableMap::clearInstancePool();
            FileTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FileTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FileTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FileTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FileTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildFileQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(FileTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildFileQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(FileTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildFileQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(FileTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildFileQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(FileTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildFileQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(FileTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildFileQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(FileTableMap::COL_CREATED_AT);
    }

} // FileQuery
