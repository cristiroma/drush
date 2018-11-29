<?php

namespace Unish;

/**
 * Tests the Drush error handler.
 *
 * @group base
 */
class ShutdownAndErrorHandlerTest extends CommandUnishTestCase
{
    /**
     * Check to see if the shutdown function is working.
     */
    public function testShutdownFunction()
    {
        // Run some garbage php with a syntax error.
        $this->drush('ev', ['exit(0);']);

        $this->assertContains("Drush command terminated abnormally.", $this->getErrorOutput(), 'Error handler logged a message.');
    }

    /**
     * Check to see if the error handler is working.
     */
    public function testErrorHandler()
    {
        // Access a missing array element
        $this->drush('ev', ['$a = []; print $a["b"];']);

        $this->assertEquals('', $this->getErrorOutput(), 'Error handler prevented message.');
    }
}
