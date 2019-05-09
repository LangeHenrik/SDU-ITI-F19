<?php

namespace App\Core\Persistence\DB;


use JsonSerializable;
use ReflectionClass;

abstract class Model implements JsonSerializable
{

    /**
     * The table in which the model is stored in
     *
     * @var string
     */
    protected $table;

    /**
     * The primary key row name
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The MySQL type of the primary key
     *
     * @var string
     */
    protected $primaryKeyType = 'int';

    /**
     * Used to indicate if the model should use auto incrementing ID's
     *
     * @var bool
     */
    protected $incrementing = true;

    /**
     * Flag set to indicate if the model instance exists or not
     *
     * @var bool
     */
    protected $exists = false;

    /**
     * Attribute keys that may be assigned
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * Attribute keys that should be removed from the model in array form
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Attribute keys that may be mapped when in array form
     *
     * @var array
     */
    protected $arrayMap = [];


    /**
     * Attribute keys that will be converted to dates
     *
     * @var array
     */
    protected $dates = [];

    /**
     * Attributes
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * Attributes in their original state
     *
     * @var array
     */
    protected $originalAttributes = [];

    /**
     * Attributes that are changed
     *
     * @var array
     */
    protected $changedAttributes = [];

    protected $createdAt = 'created_at';
    protected $updatedAt = 'updated_at';

    public function __construct($attributes = [])
    {
        // Fill attributes
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }

        // Toggle exists flag
        $this->exists = true;
    }

    /**
     * Override function when model is not using incrementing ID's
     *
     * @return null
     */
    protected function primaryKey() {
        return null;
    }

    /**
     * Save instance to database
     *
     * @return bool
     */
    public function save() {
        // First check if the model state has changed
        // If the state has changed, we know that the model already exists in the database, so there is no need to
        // create it
        if(count($this->changedAttributes) > 0) {
            // (for now) it is expected that all models have a field for update date
            $this->{$this->updatedAt} = date("Y-m-d H:i:s");

            // Update the model data in the database
            $q = DB::instance()->update($this->table, $this->attributes[$this->primaryKey], $this->changedAttributes, $this->primaryKey);

            // If the model was updated, then the model state is reset, as if it just was fetched
            if($q) {
                $this->originalAttributes   = $this->attributes;
                $this->changedAttributes    = [];
            }

            return $q;
        } else {
            // If the model does indeed exist, we need to check if it uses auto-incrementing values as it's primary
            // key, and then generate a value if specified by the model implementation
            if(!$this->incrementing) {
                // Only set the primary key if it has not already been set
                if(!$this->{$this->primaryKey}) {
                    $this->{$this->primaryKey} = $this->primaryKey();
                }
            }

            // (for now) it is expected that all models have a field for creation date
            $this->{$this->createdAt} = date("Y-m-d H:i:s");

            // Insert the model data into the database and validate if the query was successful
            $q = DB::instance()->insert($this->table, $this->getAttributes());
            if($q) {
                $this->exists = true;
            }

            return $this->exists;
        }
    }

    /**
     * Deletes the instance in the database
     *
     * @return bool
     */
    public function delete()
    {
        return DB::instance()->delete($this->table, [
            $this->primaryKey,
            "=",
            $this->{$this->primaryKey}
        ]);
    }

    /**
     * Fetch and return all
     *
     * @return array
     * @throws \ReflectionException
     */
    public static function all()
    {
        // Create empty instance of object
        /** @var Model $rc */
        $rc = (new ReflectionClass(static::class))->newInstanceWithoutConstructor();

        // Return mapped objects with query
        return self::fetchObjects("SELECT * FROM `{$rc->table}`", [], static::class);
    }

    /**
     * Fetch and return first matching primary key
     * @param $primaryValue
     * @return bool|mixed
     * @throws \ReflectionException
     */
    public static function find($primaryValue) {
        // Create empty instance of object
        /** @var Model $rc */
        $rc = (new ReflectionClass(static::class))->newInstanceWithoutConstructor();

        return static::findWhere([
           $rc->primaryKey, "=", $primaryValue
        ]);
    }

    public static function findWhere($where = []) {
        $result = static::findAllWhere($where);

        // Only return first result
        if(count($result) > 0) {
            return $result[0];
        }
        return false;
    }

    public static function findAllWhere($where = [])
    {
        // Create empty instance of object
        /** @var Model $rc */
        $rc = (new ReflectionClass(static::class))->newInstanceWithoutConstructor();

        if(count($where) === 3) {
            $operators = ["=", ">", "<", ">=", "<="];

            $field 		= $where[0];
            $operator 	= $where[1];
            $value 		= $where[2];

            if(in_array($operator, $operators)) {
                return self::fetchObjects("SELECT * FROM {$rc->table} WHERE {$field} {$operator} ?", [$value], static::class);
            }
        }

        return false;
    }

    public static function findWithQuery($query, $params = [])
    {
        return self::fetchObjects($query, $params, static::class);
    }

    private static function fetchObjects(string $query, $params = [], $class)
    {
        $results = [];

        // Fetch results
        $q = DB::instance()->setFetchObject(static::class)->query($query, $params);

        // Loop results, create object instances and fill them
        foreach ($q->results() as $result) {
            $resRc = new ReflectionClass($class);

            /** @var Model $resInstance */
            $resInstance = $resRc->newInstance();

            // Fill fillable attributes
            foreach ($resInstance->fillable as $fillable) {
                $resInstance->$fillable = $result->$fillable;
            }

            // Copy attributes into original attributes
            $resInstance->setOriginalAttributes($resInstance->getAttributes());

            // Append object to results
            $results[] = $resInstance;
        }

        return $results;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    public function getOriginalAttributes(): array
    {
        return $this->originalAttributes;
    }

    /**
     * @return array
     */
    public function getChangedAttributes(): array
    {
        return $this->changedAttributes;
    }

    /**
     * @param array $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    /**
     * @param array $originalAttributes
     */
    public function setOriginalAttributes(array $originalAttributes): void
    {
        $this->originalAttributes = $originalAttributes;
    }

    /**
     * @param array $changedAttributes
     */
    public function setChangedAttributes(array $changedAttributes): void
    {
        $this->changedAttributes = $changedAttributes;
    }

    /**
     * Get object attribute
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        if(method_exists($this, $key)) {
            return call_user_func_array([$this, $key], []);
        }
        return $this->attributes[$key];
    }

    /**
     * Set object attribute
     *
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
    {
        // Set date
        if(array_key_exists($key, $this->dates)) {
            $this->attributes[$key] = strtotime($value);

            // Set attribute changed when model has been created
            if($this->exists) {
                $this->changedAttributes[$key] = strtotime($value);
            }
        } else {
            $this->attributes[$key] = $value;

            // Set attribute changed when model has been created
            if($this->exists) {
                $this->changedAttributes[$key] = $value;
            }
        }
    }

    /**
     * Data to be serialized as json
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $data = $this->getAttributes();

        // Map values
        foreach ($this->arrayMap as $key => $newKey) {
            $data[$newKey] = $data[$key];
            unset($data[$key]);
        }

        // Remove hidden fields from the object
        foreach ($this->hidden as $hidden) {
            unset($data[$hidden]);
        }

        return $data;
    }


}