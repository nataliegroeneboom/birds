<?php


/**
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 */
class ExampleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Upload
     */
    protected $_object;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp():void
    {
        $_FILES = array(
            'test' => array(
                'name' => 'test.jpg',
                'type' => 'image/jpeg',
                'size' => 542,
                'tmp_name' => __DIR__ . '/_files/source-test.jpg',
                'error' => 0
            )
        );
        $this->_object = new \File\Upload();
        $this->_object->setDestination(__DIR__ . '/_files/');
    }
    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown():void
    {
        unset($_FILES);
        unset($this->_object);
        @unlink(__DIR__ . '/_files/test.jpg');
    }

    public function testSetDestination(){
        $this->assertEquals(__DIR__ . '/_files/', $this->_object->getDestination());
    }


    public function testReceive()
    {
        $this->assertTrue($this->_object->receive('test'));
    }
    public function testReceiveWithUnknowFile()
    {
        $this->assertFalse($this->_object->receive('test2'));
    }

}