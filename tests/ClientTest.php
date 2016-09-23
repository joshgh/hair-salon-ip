<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Client::deleteAll();
        }

        function testGetName()
        {
            $test_client = new Client("Jim");

            $result = $test_client->getName();

            $this->assertEquals("Jim", $result);
        }

        function testSave()
        {
            $test_client = new Client("Jim");

            $test_client->save();
            $result = Client::getAll();

            $this->assertEquals($test_client, $result[0]);
        }

        function testFind()
        {
            $test_client1 = new Client("Jim");
            $test_client1->save();
            $test_client2 = new Client("Bob");
            $test_client2->save();

            $result = Client::find($test_client1->getId());

            $this->assertEquals($test_client1, $result);
        }

        function testUpdate()
        {
            $test_client = new Client("Jim");
            $test_client->save();
            $test_client->update("Billy");

            $result = Client::find($test_client->getId());

            $this->assertEquals("Billy", $test_client->getName());
        }

        function testDelete()
        {
            $test_client1 = new Client("Jim");
            $test_client1->save();
            $test_client2 = new Client("Bob");
            $test_client2->save();

            $test_client1->delete();

            $result = Client::find($test_client1->getId());

            $this->assertEquals(null, $result);
        }
    }
?>
