<?php
class MockTestFixture extends EnhancePHPTestFixture
{
    public function createMockWithArgumentsAndOneTimeExpectReturnValueAndVerifies()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->with('hello', 3, 'world')->returns('Some Value')->times(1));

        $result = $mock->doSomething('hello', 3, 'world');

        EnhancePHPAssert::areIdentical('Some Value', $result);
        $mock->verifyExpectations();
    }
    
    public function createMockWithNoRequiredArgumentsAndOneTimeExpectReturnValueAndVerifies()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->returns('Some Value')->times(1));

        $result = $mock->doSomething();

        EnhancePHPAssert::areIdentical('Some Value', $result);
        $mock->verifyExpectations();
    }
    
    public function createMockWithAnyArgumentsAndOneTimeExpectReturnValueAndVerifies()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->with(EnhancePHPExpect::AnyValue, EnhancePHPExpect::AnyValue, EnhancePHPExpect::AnyValue)->returns('Some Value')->times(1));

        $result = $mock->doSomething('lalalala', 7, 'blahblah');

        EnhancePHPAssert::areIdentical('Some Value', $result);
        $mock->verifyExpectations();
    }

    public function createMockWithArgumentsAndTwoTimesExpectReturnValueAndVerifies()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->with('hello', 3, 'world')->returns('Some Value')->times(2));

        $result1 = $mock->doSomething('hello', 3, 'world');
        $result2 = $mock->doSomething('hello', 3, 'world');

        EnhancePHPAssert::areIdentical('Some Value', $result1);
        EnhancePHPAssert::areIdentical('Some Value', $result2);
        $mock->verifyExpectations();
    }
    
    public function createMockWithArgumentsAndOneTimeButTwoCallsExpectErrorOnVerify()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->with('hello', 3, 'world')->returns('Some Value')->times(1));

        $mock->doSomething('hello', 3, 'world');
        $mock->doSomething('hello', 3, 'world');

        $verifyFailed = false;
        try {
            $mock->verifyExpectations();
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        
        EnhancePHPAssert::isTrue($verifyFailed);
    }
    
    public function createMockWithZeroTimesButOneCallExpectErrorOnVerify()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->with('hello', 3, 'world')->times(0));

        $mock->doSomething('hello', 3, 'world');

        $verifyFailed = false;
        try {
            $mock->verifyExpectations();
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        
        EnhancePHPAssert::isTrue($verifyFailed);
    }
    
    public function createMockWithArgumentsAndTwoTimesButOneCallExpectErrorOnVerify()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->with('hello', 3, 'world')->returns('Some Value')->times(2));

        $mock->doSomething('hello', 3, 'world');

        $verifyFailed = false;
        try {
            $mock->verifyExpectations();
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        
        EnhancePHPAssert::isTrue($verifyFailed);
    }
    
    public function createMockWithExceptionAsReturnExpectReturnsException()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->with('hello', 3, 'world')->throws('Test Exception')->times(1));
        
        $verifyFailed = false;
        try {
            $mock->doSomething('hello', 3, 'world');
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        
        EnhancePHPAssert::isTrue($verifyFailed);
    }

    public function createMockWithCallToUnexpectedMethodExpectReturnsException()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');

        $verifyFailed = false;

        try {
            $mock->doSomething();
        } catch (Exception $e) {
            $verifyFailed = true;
        }

        EnhancePHPAssert::isTrue($verifyFailed);
    }
    
    public function createMockWithAnyArgumentsExpectVerify()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->returns('Some Value')->times(1));

        $result = $mock->doSomething('hello', 3, 'world');

        EnhancePHPAssert::areIdentical('Some Value', $result);
        $mock->verifyExpectations();
    }
    
    public function createMockWithNoArgumentsExpectVerify()
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->returns('Some Value')->times(1));

        $result = $mock->doSomething();

        EnhancePHPAssert::areIdentical('Some Value', $result);
        $mock->verifyExpectations();
    }

    public function createMockWithMultipleExpectationsExpectVerify() 
    {
        /** @var IMockExample $mock */
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::method('doSomething')->returns('Some Value')->times(1));
        $mock->addExpectation(EnhancePHPExpect::method('anotherMethod')->returns(5)->times(1));

        $result1 = $mock->doSomething();
        $result2 = $mock->anotherMethod();

        EnhancePHPAssert::areIdentical('Some Value', $result1);
        EnhancePHPAssert::areIdentical(5, $result2);
        $mock->verifyExpectations();
    }
    
    public function createMockWithGetPropertyExpectVerify()
    {
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::getProperty('Number')->returns(1)->times(1));

        /** @noinspection PhpUndefinedFieldInspection */
        $result = $mock->Number;

        EnhancePHPAssert::areIdentical(1, $result);
        $mock->verifyExpectations();
    }
    
    public function createMockWithSetPropertyExpectVerify()
    {
        $mock = EnhancePHPMockFactory::createMock('ExampleClass');
        $mock->addExpectation(EnhancePHPExpect::setProperty('Number')->with(5)->times(1));

        /** @noinspection PhpUndefinedFieldInspection */
        $mock->Number = 5;

        $mock->verifyExpectations();
    }
    
    public function createStubExpectCallsSucceed()
    {
        /** @var IMockExample $stub */
        $stub = EnhancePHPStubFactory::createStub('ExampleClass');
        $stub->addExpectation(EnhancePHPExpect::method('doSomething')->returns('Some Value'));
        $stub->addExpectation(EnhancePHPExpect::method('anotherMethod')->returns(5));

        $result1 = $stub->doSomething();
        $result2 = $stub->doSomething();
        $result3 = $stub->anotherMethod();
        $stub->callNotExpectedMethod();

        EnhancePHPAssert::areIdentical('Some Value', $result1);
        EnhancePHPAssert::areIdentical('Some Value', $result2);
        EnhancePHPAssert::areIdentical(5, $result3);
    }
}

interface IMockExample
{
    function doSomething();
    function anotherMethod();
    function callNotExpectedMethod();
}
?>