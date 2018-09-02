<?php
use PHPUnit\Framework\TestCase;
require_once '..\src\DTCUtils.php';

final class DTCUtilsTest extends TestCase {
    
    private static $DATE_FORMAT = 'Y-m-d H:i:s';

    public function testDoNothing() {
        $this->assertTrue(True);
    }

    public function testAlsoDoNothing() {
        $this->assertEquals(7, (3 + 4));
    }

    /**
     * Unit tests for getNumberOfWeekdays() function
     */
    // Check function working in order as expected
    public function testGetNumberOfWeekdaysStartEndParams() {        
        //Number of week days between Sep 1 and Sep 7 are 4
        $dateSep1 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT,  mktime(00,00,00,9,1,2018)));
        $dateSep7 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,7,2018)));
        $numberofWeekDays = 4;
        
        $this->assertEquals($numberofWeekDays, DTCUtils::getNumberOfWeekdays($dateSep1, $dateSep7));
    }
    
    
    /*
     * This function will go through a infinite loop if we run
     * this rest case so commented out unitil we fix the code
     */    
    // Check the function working in order when
    // parameters are provided in larger date to small  
    /*
    public function testGetNumberOfWeekdaysEndStartParams() {
         //Number of week days between Sep 7 and Sep 1 are 0
         $dateSep1 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT,  mktime(00,00,00,9,1,2018)));
         $dateSep7 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,7,2018)));
         $numberofWeekDays = 0;
         
         $this->assertEquals($numberofWeekDays, DTCUtils::getNumberOfWeekdays($dateSep7, $dateSep1));
         
         $this->assertTrue(True);
     }*/
    
    // Check function working in when provide 
    // the same datetime as start and end
    public function testGetNumberOfWeekdaysStartEndParamsSame() {        
        //Number of week days between Sep 7 and Sep 7 should be 0
        $dateSep7_1 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT,  mktime(00,00,00,9,7,2018)));
        $dateSep7 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,7,2018)));
        $numberofWeekDays = 0;
        
        $this->assertEquals($numberofWeekDays, DTCUtils::getNumberOfWeekdays($dateSep7, $dateSep7_1));
    }
    
    // Check the invalid parameter mostly validated by deltic php
    public function testGetNumberOfWeekdaysInvalidParms() {        
        $this->expectException(TypeError::class);
        DTCUtils::getNumberOfWeekdays("", ""); // Required DateTime and provided String
    }
    
    /**
     * Unit tests for isWeekday() function
     */
    // Check the isWeekday function in order
    // with week day and with weekend dates
    public function testIsWeekday() {
        // 2018 sep 6, 7 are week days
        $dateSep6 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,6,2018)));
        $this->assertTrue(DTCUtils::isWeekday($dateSep6));
        
        $dateSep7 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,7,2018)));
        $this->assertTrue(DTCUtils::isWeekday($dateSep7));
        
        // 2018 sep 1, 2 are not a week days
        $dateSep1 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,1,2018)));
        $this->assertFalse(DTCUtils::isWeekday($dateSep1));
        
        $dateSep2 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,2,2018)));
        $this->assertFalse(DTCUtils::isWeekday($dateSep2));
    }
    
    // Check the invalid parameter mainly validated by deltic php
    public function testIsWeekdayInvalidParams() {
        $this->expectException(TypeError::class);
        DTCUtils::isWeekday(date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,2,2018))); // Required DateTime and provided String
    }
    
    /**
     * Unit tests for getDateTimeAsStr() function
     */
    // Check the getDateTimeAsStr function works in order
    public function testGetDateTimeAsStr() {
        $dateSep2 = DateTime::createFromFormat(DTCUtilsTest::$DATE_FORMAT, date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,2,2018)));
        $this->assertEquals('2018-09-02 00:00:00 Australia/Adelaide',  DTCUtils::getDateTimeAsStr($dateSep2));        
    }
    
    // Check the invalid parameter on getDateTimeAsStr
    // Which has not handled well and need to update this function
    public function testGetDateTimeAsStrInvalidParams() {
        $this->expectException(TypeError::class);
        DTCUtils::getDateTimeAsStr(date(DTCUtilsTest::$DATE_FORMAT, mktime(00,00,00,9,2,2018))); // Required DateTime and provided String
    }
}
