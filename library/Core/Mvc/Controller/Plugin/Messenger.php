<?php

namespace Core\Mvc\Controller\Plugin;

use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

/**
 * Class Messenger
 * @package Core\Mvc\Controller\Plugin
 */
class Messenger extends AbstractPlugin implements IteratorAggregate, Countable
{

    /**
     * Default messages namespace
     */
    const NAMESPACE_DEFAULT = 'default';

    /**
     * Success messages namespace
     */
    const NAMESPACE_SUCCESS = 'success';

    /**
     * Warning messages namespace
     */
    const NAMESPACE_WARNING = 'warning';

    /**
     * Error messages namespace
     */
    const NAMESPACE_ERROR = 'error';

    /**
     * Info messages namespace
     */
    const NAMESPACE_INFO = 'info';

    /**
     * Messages from previous request
     * @var array
     */
    protected $messages = [];

    /**
     * Instance names[pace, default namespace "default"
     * @var string
     */
    protected $namespace = self::NAMESPACE_DEFAULT;

    /**
     * @return bool
     */
    public function hasMessages()
    {
        $namespace = $this->getNamespace();
        return isset($this->messages[$namespace]);
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set namespace
     * @param string $namespace
     * @return $this
     */
    public function setNamespace($namespace = self::NAMESPACE_DEFAULT)
    {
        $this->namespace = $namespace;
        return $this;
    }

    /**
     * Add a message
     *
     * @param  string         $message
     * @return Messenger Provides a fluent interface
     */
    public function addMessage($message)
    {
        $namespace = $this->getNamespace();
        $this->messages[$namespace][] = $message;

        return $this;
    }

    /**
     * Add a success message
     * @param $message
     * @return Messenger Provides a fluent interface
     */
    public function addSuccessMessage($message)
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_SUCCESS);
        $this->addMessage($message);
        $this->setNamespace($namespace);

        return $this;
    }

    /**
     * Add error message
     * @param $message
     * @return $this
     */
    public function addErrorMessage($message)
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_ERROR);
        $this->addMessage($message);
        $this->setNamespace($namespace);

        return $this;
    }

    /**
     * Add warning message
     * @param $message
     * @return $this
     */
    public function addWarningMessage($message)
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_WARNING);
        $this->addMessage($message);
        $this->setNamespace($namespace);

        return $this;
    }

    /**
     * Add info message
     * @param $message
     * @return $this
     */
    public function addInfoMessage($message)
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_INFO);
        $this->addMessage($message);
        $this->setNamespace($namespace);

        return $this;
    }

    /**
     * Get messages from default namespace
     * @return array
     */
    public function getMessages()
    {
        if ($this->hasMessages()) {
            return $this->messages[$this->getNamespace()];
        }
        return [];
    }

    /**
     * Get messages from namespace
     * @param $namespace
     * @return array
     */
    public function getMessagesFromNamespace($namespace)
    {
        $currentNamespace = $this->getNamespace();
        $this->setNamespace($namespace);
        $messages = $this->getMessages();
        $this->setNamespace($currentNamespace);

        return $messages;
    }

    /**
     * Get success messages
     * @return array
     */
    public function getSuccessMessages()
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_SUCCESS);
        $messages = $this->getMessages();
        $this->setNamespace($namespace);

        return $messages;
    }

    /**
     * Get error messages
     * @return array
     */
    public function getErrorMessages()
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_ERROR);
        $messages = $this->getMessages();
        $this->setNamespace($namespace);

        return $messages;
    }

    /**
     * Get warning messages
     * @return array
     */
    public function getWarningMessages()
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_WARNING);
        $messages = $this->getMessages();
        $this->setNamespace($namespace);

        return $messages;
    }

    /**
     * Get info messages
     * @return array
     */
    public function getInfoMessages()
    {
        $namespace = $this->getNamespace();
        $this->setNamespace(self::NAMESPACE_INFO);
        $messages = $this->getMessages();
        $this->setNamespace($namespace);

        return $messages;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     */
    public function getIterator()
    {
        if ($this->hasMessages()) {
            return new ArrayIterator($this->getMessages());
        }

        return new ArrayIterator();
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     */
    public function count()
    {
        if ($this->hasMessages()) {
            return count($this->getMessages());
        }
        return 0;
    }
}
