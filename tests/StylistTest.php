<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Stylist.php";
    class StylistTest extends PHPUnit_Framework_TestCase
    {
        function testGetName()
        {
            //Arrange
            $test_stylist = new Stylist("Sandra");
            //Act
            $result = $test_stylist->getId();
            //Assert
            $this->assertEquals("Sandra", $result);
        }
    }
?>
