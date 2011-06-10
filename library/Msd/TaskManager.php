<?php
/**
 * This file is part of MySQLDumper released under the GNU/GPL 2 license
 * http://www.mysqldumper.net
 *
 * @package         MySQLDumper
 * @subpackage      File
 * @version         SVN: $rev: 1207 $
 * @author          $Author$
 */

/**
 * Task Manager Class (Singleton)
 *
 * Class handles task lists
 *
 * @package         MySQLDumper
 * @subpackage      TaskManager
 */
class Msd_TaskManager
{
    /**
     * Define task types.
     * The integer value defines the ordering in wich tasks are executed.
     * @var int
     */
    const GET_CREATE_TABLE              = 100;
    const BACKUP_TABLE_DATA             = 200;
    const GET_ALTER_TABLE_ADD_KEYS      = 300;

    /**
     * Instance
     *
     * @var Msd_Configuration
     */
    private static $_instance = NULL;

    /**
     * Task Namespace
     * @var Zend_Session_Namespace
     */
    private $_session;

    private $_tasks = array();

    /**
     * Constructor
     *
     * Get task list from session or init an empty list.
     *
     * @param string  $taskType Task type to get or create.
     *                          Defaults to "backupTasks".
     * @param boolean Whether to create a new task list and delete all entries
     *                or to get it from the session
     *
     * @return void
     */
    private function __construct($taskType, $clear = false)
    {
        $this->_session = new Zend_Session_Namespace($taskType, true);
        if (isset($this->_session->tasks)) {
            $this->_tasks = $this->_session->tasks;
        }
        if ($clear === true) {
            $this->clearTasks();
        }
    }

    /**
     * Returns the task manager instance
     *
     * @param string  $configname   The name of the configuration file to load.
     *                              If not set we will load the config from
     *                              session if present.
     * @param boolean $forceLoading If set the config will be read from file.
     *
     * @return Msd_Configuration
     */
    public static function getInstance($taskType = 'backupTasks',
                                        $clear = false)
    {
        if (null == self::$_instance) {
            self::$_instance = new self($taskType, $clear);
        }
        return self::$_instance;
    }

    /**
     * Add a task
     *
     * @param string $type    Type of tasks
     * @param array  $options Option array
     *
     * @return void
     */
    public function addTask($type, $options = array())
    {
        $tasks = $this->_tasks;
        if (empty($tasks[$type])) {
            $tasks[$type] = array();
        }
        $tasks[$type][] = $options;
        $this->_tasks = $tasks;
        $this->_saveTasksToSession();
    }

    /**
     * Get tasks of given type
     *
     * Returns false if type is not present in task list.
     *
     * @param string $type
     *
     * @return array|false
     */
    public function getTasks($type = '')
    {
        if ($type > '') {
            if (!isset($this->_tasks[$type])) {
                return false;
            }
            return $this->_tasks[$type];
        }
        return $this->_tasks;
    }

    /**
     * Reset tasks array
     *
     * @return void
     */
    public function clearTasks()
    {
        $this->_tasks = array();
        $this->_saveTasksToSession();
    }

    /**
     * Remove the first task of the given type
     *
     * @param string $type
     *
     * @return void
     */
    public function removeActualTask($type)
    {
        $tasks = $this->getTasks($type);
        print_r($tasks);
        if ($tasks === false) {
            return;
        }
        if (empty($tasks)) {
            // no task of that type left - remove type
            unset($this->_tasks[$type]);
        }
        unset($tasks[0]);
        //rebuild index
        sort($tasks);
        $this->_tasks[$type] = $tasks;
        $this->_saveTasksToSession();
    }

    /**
     * Return the first task of given type or false if there is none.
     *
     * @param $type The type of the task to get.
     *
     * @return array|false
     */
    public function getActualTask($type)
    {
        $tasks = $this->getTasks($type);
        if (isset($tasks[0])) {
            return $tasks[0];
        };
        return false;
    }

    /**
     * Save task list to session
     *
     * @return void
     */
    private function _saveTasksToSession()
    {
        $this->_session->tasks = $this->_tasks;
    }
}
