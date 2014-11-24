<?php

namespace Base;

use \Produkte as ChildProdukte;
use \ProdukteQuery as ChildProdukteQuery;
use \Exception;
use \PDO;
use Map\ProdukteTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'produkte' table.
 *
 * 
 *
 * @method     ChildProdukteQuery orderById($order = Criteria::ASC) Order by the ID column
 * @method     ChildProdukteQuery orderByName($order = Criteria::ASC) Order by the Name column
 * @method     ChildProdukteQuery orderByKategorie($order = Criteria::ASC) Order by the Kategorie column
 * @method     ChildProdukteQuery orderByBeschreibung($order = Criteria::ASC) Order by the Beschreibung column
 * @method     ChildProdukteQuery orderByPreis($order = Criteria::ASC) Order by the Preis column
 * @method     ChildProdukteQuery orderByBild($order = Criteria::ASC) Order by the Bild column
 *
 * @method     ChildProdukteQuery groupById() Group by the ID column
 * @method     ChildProdukteQuery groupByName() Group by the Name column
 * @method     ChildProdukteQuery groupByKategorie() Group by the Kategorie column
 * @method     ChildProdukteQuery groupByBeschreibung() Group by the Beschreibung column
 * @method     ChildProdukteQuery groupByPreis() Group by the Preis column
 * @method     ChildProdukteQuery groupByBild() Group by the Bild column
 *
 * @method     ChildProdukteQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildProdukteQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildProdukteQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildProdukte findOne(ConnectionInterface $con = null) Return the first ChildProdukte matching the query
 * @method     ChildProdukte findOneOrCreate(ConnectionInterface $con = null) Return the first ChildProdukte matching the query, or a new ChildProdukte object populated from the query conditions when no match is found
 *
 * @method     ChildProdukte findOneById(int $ID) Return the first ChildProdukte filtered by the ID column
 * @method     ChildProdukte findOneByName(string $Name) Return the first ChildProdukte filtered by the Name column
 * @method     ChildProdukte findOneByKategorie(string $Kategorie) Return the first ChildProdukte filtered by the Kategorie column
 * @method     ChildProdukte findOneByBeschreibung(string $Beschreibung) Return the first ChildProdukte filtered by the Beschreibung column
 * @method     ChildProdukte findOneByPreis(double $Preis) Return the first ChildProdukte filtered by the Preis column
 * @method     ChildProdukte findOneByBild(string $Bild) Return the first ChildProdukte filtered by the Bild column
 *
 * @method     ChildProdukte[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildProdukte objects based on current ModelCriteria
 * @method     ChildProdukte[]|ObjectCollection findById(int $ID) Return ChildProdukte objects filtered by the ID column
 * @method     ChildProdukte[]|ObjectCollection findByName(string $Name) Return ChildProdukte objects filtered by the Name column
 * @method     ChildProdukte[]|ObjectCollection findByKategorie(string $Kategorie) Return ChildProdukte objects filtered by the Kategorie column
 * @method     ChildProdukte[]|ObjectCollection findByBeschreibung(string $Beschreibung) Return ChildProdukte objects filtered by the Beschreibung column
 * @method     ChildProdukte[]|ObjectCollection findByPreis(double $Preis) Return ChildProdukte objects filtered by the Preis column
 * @method     ChildProdukte[]|ObjectCollection findByBild(string $Bild) Return ChildProdukte objects filtered by the Bild column
 * @method     ChildProdukte[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ProdukteQuery extends ModelCriteria
{
    
    /**
     * Initializes internal state of \Base\ProdukteQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'web_prog', $modelName = '\\Produkte', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildProdukteQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildProdukteQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildProdukteQuery) {
            return $criteria;
        }
        $query = new ChildProdukteQuery();
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
     * @return ChildProdukte|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = ProdukteTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ProdukteTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
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
     * @return ChildProdukte A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ID, Name, Kategorie, Beschreibung, Preis, Bild FROM produkte WHERE ID = :p0';
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
            /** @var ChildProdukte $obj */
            $obj = new ChildProdukte();
            $obj->hydrate($row);
            ProdukteTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildProdukte|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ProdukteTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ProdukteTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the ID column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE ID = 1234
     * $query->filterById(array(12, 34)); // WHERE ID IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE ID > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(ProdukteTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(ProdukteTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdukteTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the Name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE Name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE Name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProdukteTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the Kategorie column
     *
     * Example usage:
     * <code>
     * $query->filterByKategorie('fooValue');   // WHERE Kategorie = 'fooValue'
     * $query->filterByKategorie('%fooValue%'); // WHERE Kategorie LIKE '%fooValue%'
     * </code>
     *
     * @param     string $kategorie The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function filterByKategorie($kategorie = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($kategorie)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $kategorie)) {
                $kategorie = str_replace('*', '%', $kategorie);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProdukteTableMap::COL_KATEGORIE, $kategorie, $comparison);
    }

    /**
     * Filter the query on the Beschreibung column
     *
     * Example usage:
     * <code>
     * $query->filterByBeschreibung('fooValue');   // WHERE Beschreibung = 'fooValue'
     * $query->filterByBeschreibung('%fooValue%'); // WHERE Beschreibung LIKE '%fooValue%'
     * </code>
     *
     * @param     string $beschreibung The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function filterByBeschreibung($beschreibung = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($beschreibung)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $beschreibung)) {
                $beschreibung = str_replace('*', '%', $beschreibung);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProdukteTableMap::COL_BESCHREIBUNG, $beschreibung, $comparison);
    }

    /**
     * Filter the query on the Preis column
     *
     * Example usage:
     * <code>
     * $query->filterByPreis(1234); // WHERE Preis = 1234
     * $query->filterByPreis(array(12, 34)); // WHERE Preis IN (12, 34)
     * $query->filterByPreis(array('min' => 12)); // WHERE Preis > 12
     * </code>
     *
     * @param     mixed $preis The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function filterByPreis($preis = null, $comparison = null)
    {
        if (is_array($preis)) {
            $useMinMax = false;
            if (isset($preis['min'])) {
                $this->addUsingAlias(ProdukteTableMap::COL_PREIS, $preis['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($preis['max'])) {
                $this->addUsingAlias(ProdukteTableMap::COL_PREIS, $preis['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ProdukteTableMap::COL_PREIS, $preis, $comparison);
    }

    /**
     * Filter the query on the Bild column
     *
     * Example usage:
     * <code>
     * $query->filterByBild('fooValue');   // WHERE Bild = 'fooValue'
     * $query->filterByBild('%fooValue%'); // WHERE Bild LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bild The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function filterByBild($bild = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bild)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bild)) {
                $bild = str_replace('*', '%', $bild);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(ProdukteTableMap::COL_BILD, $bild, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildProdukte $produkte Object to remove from the list of results
     *
     * @return $this|ChildProdukteQuery The current query, for fluid interface
     */
    public function prune($produkte = null)
    {
        if ($produkte) {
            $this->addUsingAlias(ProdukteTableMap::COL_ID, $produkte->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the produkte table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ProdukteTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ProdukteTableMap::clearInstancePool();
            ProdukteTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ProdukteTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ProdukteTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            ProdukteTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            ProdukteTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ProdukteQuery
