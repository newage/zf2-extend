<?php

namespace User\Behat;

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Core\Behat\ExtendContext;

/**
 * Features context.
 */
class LoginContext extends ExtendContext implements SnippetAcceptingContext
{

    /**
     * @Given /^There are following roles:$/
     */
    public function thereAreRoles(TableNode $table)
    {
        throw new PendingException();
    }
}
