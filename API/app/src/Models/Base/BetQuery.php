<?php

namespace ApostaAiApi\Models\Base;

use \Exception;
use \PDO;
use ApostaAiApi\Models\Bet as ChildBet;
use ApostaAiApi\Models\BetQuery as ChildBetQuery;
use ApostaAiApi\Models\Map\BetTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'bet' table.
 *
 * 
 *
 * @method     ChildBetQuery orderByUserId($order = Criteria::ASC) Order by the user_id column
 * @method     ChildBetQuery orderByChosenParticipantId($order = Criteria::ASC) Order by the chosen_participant_id column
 * @method     ChildBetQuery orderByChosenResult($order = Criteria::ASC) Order by the chosen_result column
 * @method     ChildBetQuery orderByMedal($order = Criteria::ASC) Order by the medal column
 *
 * @method     ChildBetQuery groupByUserId() Group by the user_id column
 * @method     ChildBetQuery groupByChosenParticipantId() Group by the chosen_participant_id column
 * @method     ChildBetQuery groupByChosenResult() Group by the chosen_result column
 * @method     ChildBetQuery groupByMedal() Group by the medal column
 *
 * @method     ChildBetQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBetQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBetQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBetQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBetQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBetQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBetQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildBetQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildBetQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildBetQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildBetQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildBetQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildBetQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildBetQuery leftJoinParticipant($relationAlias = null) Adds a LEFT JOIN clause to the query using the Participant relation
 * @method     ChildBetQuery rightJoinParticipant($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Participant relation
 * @method     ChildBetQuery innerJoinParticipant($relationAlias = null) Adds a INNER JOIN clause to the query using the Participant relation
 *
 * @method     ChildBetQuery joinWithParticipant($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Participant relation
 *
 * @method     ChildBetQuery leftJoinWithParticipant() Adds a LEFT JOIN clause and with to the query using the Participant relation
 * @method     ChildBetQuery rightJoinWithParticipant() Adds a RIGHT JOIN clause and with to the query using the Participant relation
 * @method     ChildBetQuery innerJoinWithParticipant() Adds a INNER JOIN clause and with to the query using the Participant relation
 *
 * @method     \ApostaAiApi\Models\UserQuery|\ApostaAiApi\Models\ParticipantQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBet findOne(ConnectionInterface $con = null) Return the first ChildBet matching the query
 * @method     ChildBet findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBet matching the query, or a new ChildBet object populated from the query conditions when no match is found
 *
 * @method     ChildBet findOneByUserId(int $user_id) Return the first ChildBet filtered by the user_id column
 * @method     ChildBet findOneByChosenParticipantId(int $chosen_participant_id) Return the first ChildBet filtered by the chosen_participant_id column
 * @method     ChildBet findOneByChosenResult(string $chosen_result) Return the first ChildBet filtered by the chosen_result column
 * @method     ChildBet findOneByMedal(int $medal) Return the first ChildBet filtered by the medal column *

 * @method     ChildBet requirePk($key, ConnectionInterface $con = null) Return the ChildBet by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBet requireOne(ConnectionInterface $con = null) Return the first ChildBet matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBet requireOneByUserId(int $user_id) Return the first ChildBet filtered by the user_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBet requireOneByChosenParticipantId(int $chosen_participant_id) Return the first ChildBet filtered by the chosen_participant_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBet requireOneByChosenResult(string $chosen_result) Return the first ChildBet filtered by the chosen_result column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBet requireOneByMedal(int $medal) Return the first ChildBet filtered by the medal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBet[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBet objects based on current ModelCriteria
 * @method     ChildBet[]|ObjectCollection findByUserId(int $user_id) Return ChildBet objects filtered by the user_id column
 * @method     ChildBet[]|ObjectCollection findByChosenParticipantId(int $chosen_participant_id) Return ChildBet objects filtered by the chosen_participant_id column
 * @method     ChildBet[]|ObjectCollection findByChosenResult(string $chosen_result) Return ChildBet objects filtered by the chosen_result column
 * @method     ChildBet[]|ObjectCollection findByMedal(int $medal) Return ChildBet objects filtered by the medal column
 * @method     ChildBet[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BetQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \ApostaAiApi\Models\Base\BetQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\ApostaAiApi\\Models\\Bet', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBetQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBetQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBetQuery) {
            return $criteria;
        }
        $query = new ChildBetQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$user_id, $chosen_participant_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBet|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BetTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])])))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BetTableMap::DATABASE_NAME);
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
     * @return ChildBet A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT user_id, chosen_participant_id, chosen_result, medal FROM bet WHERE user_id = :p0 AND chosen_participant_id = :p1';
        try {
            $stmt = $con->prepare($sql);            
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);            
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBet $obj */
            $obj = new ChildBet();
            $obj->hydrate($row);
            BetTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBet|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BetTableMap::COL_USER_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BetTableMap::COL_CHOSEN_PARTICIPANT_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BetTableMap::COL_USER_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BetTableMap::COL_CHOSEN_PARTICIPANT_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the user_id column
     *
     * Example usage:
     * <code>
     * $query->filterByUserId(1234); // WHERE user_id = 1234
     * $query->filterByUserId(array(12, 34)); // WHERE user_id IN (12, 34)
     * $query->filterByUserId(array('min' => 12)); // WHERE user_id > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function filterByUserId($userId = null, $comparison = null)
    {
        if (is_array($userId)) {
            $useMinMax = false;
            if (isset($userId['min'])) {
                $this->addUsingAlias(BetTableMap::COL_USER_ID, $userId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userId['max'])) {
                $this->addUsingAlias(BetTableMap::COL_USER_ID, $userId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BetTableMap::COL_USER_ID, $userId, $comparison);
    }

    /**
     * Filter the query on the chosen_participant_id column
     *
     * Example usage:
     * <code>
     * $query->filterByChosenParticipantId(1234); // WHERE chosen_participant_id = 1234
     * $query->filterByChosenParticipantId(array(12, 34)); // WHERE chosen_participant_id IN (12, 34)
     * $query->filterByChosenParticipantId(array('min' => 12)); // WHERE chosen_participant_id > 12
     * </code>
     *
     * @see       filterByParticipant()
     *
     * @param     mixed $chosenParticipantId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function filterByChosenParticipantId($chosenParticipantId = null, $comparison = null)
    {
        if (is_array($chosenParticipantId)) {
            $useMinMax = false;
            if (isset($chosenParticipantId['min'])) {
                $this->addUsingAlias(BetTableMap::COL_CHOSEN_PARTICIPANT_ID, $chosenParticipantId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($chosenParticipantId['max'])) {
                $this->addUsingAlias(BetTableMap::COL_CHOSEN_PARTICIPANT_ID, $chosenParticipantId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BetTableMap::COL_CHOSEN_PARTICIPANT_ID, $chosenParticipantId, $comparison);
    }

    /**
     * Filter the query on the chosen_result column
     *
     * Example usage:
     * <code>
     * $query->filterByChosenResult('fooValue');   // WHERE chosen_result = 'fooValue'
     * $query->filterByChosenResult('%fooValue%'); // WHERE chosen_result LIKE '%fooValue%'
     * </code>
     *
     * @param     string $chosenResult The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function filterByChosenResult($chosenResult = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($chosenResult)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $chosenResult)) {
                $chosenResult = str_replace('*', '%', $chosenResult);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BetTableMap::COL_CHOSEN_RESULT, $chosenResult, $comparison);
    }

    /**
     * Filter the query on the medal column
     *
     * @param     mixed $medal The value to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function filterByMedal($medal = null, $comparison = null)
    {
        $valueSet = BetTableMap::getValueSet(BetTableMap::COL_MEDAL);
        if (is_scalar($medal)) {
            if (!in_array($medal, $valueSet)) {
                throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $medal));
            }
            $medal = array_search($medal, $valueSet);
        } elseif (is_array($medal)) {
            $convertedValues = array();
            foreach ($medal as $value) {
                if (!in_array($value, $valueSet)) {
                    throw new PropelException(sprintf('Value "%s" is not accepted in this enumerated column', $value));
                }
                $convertedValues []= array_search($value, $valueSet);
            }
            $medal = $convertedValues;
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BetTableMap::COL_MEDAL, $medal, $comparison);
    }

    /**
     * Filter the query by a related \ApostaAiApi\Models\User object
     *
     * @param \ApostaAiApi\Models\User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBetQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \ApostaAiApi\Models\User) {
            return $this
                ->addUsingAlias(BetTableMap::COL_USER_ID, $user->getId(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BetTableMap::COL_USER_ID, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \ApostaAiApi\Models\User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ApostaAiApi\Models\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\ApostaAiApi\Models\UserQuery');
    }

    /**
     * Filter the query by a related \ApostaAiApi\Models\Participant object
     *
     * @param \ApostaAiApi\Models\Participant|ObjectCollection $participant The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBetQuery The current query, for fluid interface
     */
    public function filterByParticipant($participant, $comparison = null)
    {
        if ($participant instanceof \ApostaAiApi\Models\Participant) {
            return $this
                ->addUsingAlias(BetTableMap::COL_CHOSEN_PARTICIPANT_ID, $participant->getId(), $comparison);
        } elseif ($participant instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BetTableMap::COL_CHOSEN_PARTICIPANT_ID, $participant->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByParticipant() only accepts arguments of type \ApostaAiApi\Models\Participant or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Participant relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function joinParticipant($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Participant');

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
            $this->addJoinObject($join, 'Participant');
        }

        return $this;
    }

    /**
     * Use the Participant relation Participant object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ApostaAiApi\Models\ParticipantQuery A secondary query class using the current class as primary query
     */
    public function useParticipantQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinParticipant($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Participant', '\ApostaAiApi\Models\ParticipantQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBet $bet Object to remove from the list of results
     *
     * @return $this|ChildBetQuery The current query, for fluid interface
     */
    public function prune($bet = null)
    {
        if ($bet) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BetTableMap::COL_USER_ID), $bet->getUserId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BetTableMap::COL_CHOSEN_PARTICIPANT_ID), $bet->getChosenParticipantId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the bet table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BetTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BetTableMap::clearInstancePool();
            BetTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BetTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BetTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            
            BetTableMap::removeInstanceFromPool($criteria);
        
            $affectedRows += ModelCriteria::delete($con);
            BetTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BetQuery
