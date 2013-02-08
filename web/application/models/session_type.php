<?php

include_once "abstract_ilios_model.php";

/**
 * Data Access Object (DAO) to the "session type" table.
 */
class Session_Type extends Abstract_Ilios_Model
{
    /**
     * Constructor.
     */
    public function __construct ()
    {
        parent::__construct('session_type', array('session_type_id'));

        $this->createDBHandle();
    }

    /**
     * Retrieves a list of session type ids/titles owned by a given school as key/value pairs.
     * @param int $schoolId the id of the owning school
     * @return array the session type ids/titles
     */
    public function getSessionTypeTitles ($schoolId)
    {
        $rhett = array();

        $DB = $this->dbHandle;
        $DB->where('owning_school_id', $schoolId);
        $DB->order_by('title');

        $result = $DB->get($this->databaseTableName);

        foreach ($result->result_array() as $row) {
            $id = $row['session_type_id'];
            $title = $row['title'];

            $rhett[$id] = $title;
        }

        return $rhett;
    }

    /**
     * Retrieves a list of session types owned by a given school.
     * @param int $schoolId the id of the owning school
     * @return array a list of session types records, each represented as associative array
     */
    public function getList ($schoolId)
    {
    	$rhett = array();

    	$DB = $this->dbHandle;
        $DB->where('owning_school_id', $schoolId);
        $DB->order_by('title');

        $result = $DB->get($this->databaseTableName);

        foreach ($result->result_array() as $row) {
            $rhett[] = $row;
        }
        return $rhett;
    }
}