<?php
class AssertIsTrueTestFixture extends EnhancePHPTestFixture
{
    /** @var EnhancePHPAssertions $target */
    private $target;
    
    public function setUp()
    {
        $this->target = EnhancePHPCore::getCodeCoverageWrapper('EnhancePHPAssertions', array(EnhancePHPLanguage::English));
    }

    public function assertIsTrueWithTrueExpectPass()
    {
        $this->target->isTrue(true);
    }
    
    public function assertIsTrueWithFalseExpectFail()
    {
        $verifyFailed = false;
        try {
            $this->target->isTrue(false);
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        EnhancePHPAssert::isTrue($verifyFailed);
    }
    
    public function assertIsTrueWith1ExpectFail()
    {
        $verifyFailed = false;
        try {
            $this->target->isTrue(1);
        } catch (Exception $e) {
            $verifyFailed = true;
        }
        EnhancePHPAssert::isTrue($verifyFailed);
    }
}
?>