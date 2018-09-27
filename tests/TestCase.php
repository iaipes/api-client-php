<?php
namespace Iaipes\ApiClient\Tests;


use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
  /**
     * Load package service provider
     * @param  \Illuminate\Foundation\Application $app
     * @return Iw\Core\CoreServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [
        ];
    }
    /**
    * Load package alias
    * @param  \Illuminate\Foundation\Application $app
    * @return array
    */
    protected function getPackageAliases($app)
    {
        return [

        ];
    }

    /**
    * Get application timezone.
    *
    * @param  \Illuminate\Foundation\Application  $app
    * @return string|null
    */
    protected function getEnvironmentSetUp($app)
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__);
        $dotenv->load();
        $app['config']->set('iaipes_apiclient', require(dirname(__DIR__) ."/config/iaipes_apiclient.php"));
    }

    /**
     * Check for successful API response
     * @param  Array $response
     * @return Boolean
     */
    protected function isSuccessfulResponse($response)
    {
       return is_object($response) &&
            property_exists($response, 'data') && 
            is_array($response->data) &&
            count($response->data) > 0;
    }

    /**
     * Test for successful API response
     * @param  Array $response
     * @return Void
     */
    protected function assertSuccessfulResponse($response)
    {
        $this->assertTrue(is_object($response));
        $this->assertObjectHasAttribute('meta', $response);
        $this->assertObjectHasAttribute('data', $response);
        $this->assertTrue($response->meta->status == 200);
    }
}
