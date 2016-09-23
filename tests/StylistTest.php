<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {
        protected function teardown()
        {
            Stylist::deleteAll();
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
    }
?>
