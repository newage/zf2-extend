<?php

namespace Core\View\Helper;

use Zend\I18n\View\Helper\AbstractTranslatorHelper;
use Core\Mvc\Controller\Plugin\Messenger as PluginMessenger;
use Zend\View\Helper\EscapeHtml;

/**
 * Class Messenger
 * @package Core\View\Helper
 */
class Messenger extends AbstractTranslatorHelper
{

    /**
     * Plugin "Messenger"
     * @var \Core\Mvc\Controller\Plugin\Messenger
     */
    protected $pluginMessenger;

    /**
     * @var EscapeHtml
     */
    protected $escapeHtmlHelper;

    /**
     * Default attributes for the open format tag
     *
     * @var array
     */
    protected $classMessages = array(
        PluginMessenger::NAMESPACE_INFO => 'info',
        PluginMessenger::NAMESPACE_ERROR => 'error',
        PluginMessenger::NAMESPACE_SUCCESS => 'success',
        PluginMessenger::NAMESPACE_DEFAULT => 'default',
        PluginMessenger::NAMESPACE_WARNING => 'warning',
    );

    /**
     * Templates for the open/close/separators for message tags
     *
     * @var string
     */
    protected $messageCloseString     = '</li></ul>';
    protected $messageOpenFormat      = '<ul%s><li>';
    protected $messageSeparatorString = '</li><li>';

    /**
     * Call messenger view helper
     * @return $this
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * Render Messages
     *
     * @param  string $namespace
     * @param  array  $classes
     * @return string
     */
    public function render($namespace = PluginMessenger::NAMESPACE_DEFAULT, array $classes = [])
    {
        $messenger = $this->getPluginMessenger();
        $messages = $messenger->getMessagesFromNamespace($namespace);
        return $this->renderMessages($namespace, $messages, $classes);
    }

    /**
     * Render Messages
     *
     * @param  string $namespace
     * @param  array $messages
     * @param  array $classes
     * @return string
     */
    protected function renderMessages(
        $namespace = PluginMessenger::NAMESPACE_DEFAULT,
        array $messages = [],
        array $classes = []
    ) {
        // Prepare classes for opening tag
        if (empty($classes)) {
            if (isset($this->classMessages[$namespace])) {
                $classes = $this->classMessages[$namespace];
            } else {
                $classes = $this->classMessages[PluginMessenger::NAMESPACE_DEFAULT];
            }
            $classes = [$classes];
        }
        // Flatten message array
        $escapeHtml      = $this->getEscapeHtmlHelper();
        $messagesToPrint = [];
        $translator = $this->getTranslator();
        $translatorTextDomain = $this->getTranslatorTextDomain();
        array_walk_recursive(
            $messages,
            function ($item) use (&$messagesToPrint, $escapeHtml, $translator, $translatorTextDomain) {
                if ($translator !== null) {
                    $item = $translator->translate(
                        $item,
                        $translatorTextDomain
                    );
                }
                $messagesToPrint[] = $escapeHtml($item);
            }
        );
        if (empty($messagesToPrint)) {
            return '';
        }
        // Generate markup
        $markup  = sprintf($this->getMessageOpenFormat(), ' class="' . implode(' ', $classes) . '"');
        $markup .= implode(
            sprintf($this->getMessageSeparatorString(), ' class="' . implode(' ', $classes) . '"'),
            $messagesToPrint
        );
        $markup .= $this->getMessageCloseString();
        return $markup;
    }

    /**
     * @return string
     */
    public function getMessageCloseString()
    {
        return $this->messageCloseString;
    }

    /**
     * @param string $messageCloseString
     * @return $this
     */
    public function setMessageCloseString($messageCloseString)
    {
        $this->messageCloseString = $messageCloseString;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageOpenFormat()
    {
        return $this->messageOpenFormat;
    }

    /**
     * @param string $messageOpenFormat
     * @return $this
     */
    public function setMessageOpenFormat($messageOpenFormat)
    {
        $this->messageOpenFormat = $messageOpenFormat;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessageSeparatorString()
    {
        return $this->messageSeparatorString;
    }

    /**
     * @param string $messageSeparatorString
     * @return $this
     */
    public function setMessageSeparatorString($messageSeparatorString)
    {
        $this->messageSeparatorString = $messageSeparatorString;
        return $this;
    }

    /**
     * @return \Core\Mvc\Controller\Plugin\Messenger
     */
    public function getPluginMessenger()
    {
        return $this->pluginMessenger;
    }

    /**
     * @param \Core\Mvc\Controller\Plugin\Messenger $pluginMessenger
     * @return $this
     */
    public function setPluginMessenger($pluginMessenger)
    {
        $this->pluginMessenger = $pluginMessenger;
        return $this;
    }

    /**
     * Retrieve the escapeHtml helper
     *
     * @return EscapeHtml
     */
    protected function getEscapeHtmlHelper()
    {
        if ($this->escapeHtmlHelper) {
            return $this->escapeHtmlHelper;
        }

        if (method_exists($this->getView(), 'plugin')) {
            $this->escapeHtmlHelper = $this->view->plugin('escapehtml');
        }

        if (!$this->escapeHtmlHelper instanceof EscapeHtml) {
            $this->escapeHtmlHelper = new EscapeHtml();
        }

        return $this->escapeHtmlHelper;
    }
}
