<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Stylist::deleteAll();
            Client::deleteAll();
        }

        function testGetName()
        {
            $test_stylist = new Stylist("Sandra");

            $result = $test_stylist->getName();

            $this->assertEquals("Sandra", $result);
        }

        function testSave()
        {
            $test_stylist = new Stylist("Sandra");

            $test_stylist->save();
            $result = Stylist::getAll();

            $this->assertEquals($test_stylist, $result[0]);
        }

        function testFind()
        {
            $test_stylist1 = new Stylist("Sandra");
            $test_stylist1->save();
            $test_stylist2 = new Stylist("Becky");
            $test_stylist2->save();

            $result = Stylist::find($test_stylist1->getId());

            $this->assertEquals($test_stylist1, $result);
        }

        function testUpdate()
        {
            $test_stylist = new Stylist("Sandra");
            $test_stylist->save();
            $test_stylist->update("Rita");

            $result = Stylist::find($test_stylist->getId());

            $this->assertEquals("Rita", $test_stylist->getName());
        }

        function testDelete()
        {
            $test_stylist1 = new Stylist("Sandra");
            $test_stylist1->save();
            $test_stylist2 = new Stylist("Becky");
            $test_stylist2->save();

            $test_stylist1->delete();

            $result = Stylist::find($test_stylist1->getId());

            $this->assertEquals(null, $result);
        }

        function testFindClients()
        {
            $test_stylist1 = new Stylist("Sandra");
            $test_stylist1->save();
            $test_stylist2 = new Stylist("Becky");
            $test_stylist2->save();
            $test_client1 = new Client("Jim", $test_stylist1->getId());
            $test_client1->save();
            $test_client2 = new Client("Bob", $test_stylist2->getId());
            $test_client2->save();

            $result = $test_stylist1->findClients();

            $this->assertEquals([$test_client1], $result);
        }
    }
?>
