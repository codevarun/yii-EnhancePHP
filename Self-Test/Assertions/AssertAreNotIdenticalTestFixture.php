<?php
class AssertAreNotIdenticalTestFixture extends EnhancePHPTestFixture
 {
    /** @var EnhancePHPAssertions $target */
    private $target;
    
    public function setUp()
    {
        $this->target = EnhancePHPCore::getCodeCoverageWrapper('EnhancePHPAssertions', array(EnhancePHPLanguage::English));
    }

    public function assertAreNotIdenticalWithDifferentIntegers()
    {
        $this->target->areNotIdentical(5, 4);
    }
    
    public function assertAreNotIdenticalWithIdenticalIntegers()
    {
        $verifyFailed = false;
        try {
            $this->target->areNotIdentical(5, 5);
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        EnhancePHPAssert::isTrue($verifyFailed);
    }
    
    public function assertAreNotIdenticalWithDifferentStrings()
    {
        $this->target->areNotIdentical('Test', 'test');
    }
    
    public function assertAreNotIdenticalWithIdenticalStrings()
    {
        $verifyFailed = false;
        try {
            $this->target->areNotIdentical('Test', 'Test');
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        EnhancePHPAssert::isTrue($verifyFailed);
    }
    
    public function assertAreNotIdenticalWithDifferentFloats()
    {
        $this->target->areNotIdentical(15.123346575, 15.123346574);
    }
    
    public function assertAreNotIdenticalWithIdenticalFloats()
    {
        $verifyFailed = false;
        try {
            $this->target->areNotIdentical(15.123346575, 15.123346575);
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        EnhancePHPAssert::isTrue($verifyFailed);
    }
}
?>