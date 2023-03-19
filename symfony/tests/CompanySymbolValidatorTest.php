<?php

namespace App\Tests;

use App\Entity\CompanyInformation;
use App\Repository\CompanyInformationRepository;
use App\Validator\CompanySymbolConstraint;
use App\Validator\CompanySymbolValidator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class CompanySymbolValidatorTest extends TestCase
{
    private MockObject $repositoryMock;
    private MockObject $contextMock;

    protected function setUp(): void
    {
        $this->repositoryMock = $this->getMockBuilder(CompanyInformationRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->contextMock = $this->createMock(ExecutionContextInterface::class);
    }

    public function testValidateWithInvalidConstraint()
    {
        $validator = new CompanySymbolValidator($this->repositoryMock);

        $this->expectException(UnexpectedTypeException::class);

        $validator->validate('SYM', new NotBlank());
    }

    public function testValidateWithInvalidValue()
    {
        $validator = new CompanySymbolValidator($this->repositoryMock);
        $constraint = new CompanySymbolConstraint();

        $this->expectException(UnexpectedTypeException::class);

        $validator->validate(123, $constraint);
    }

    public function testValidateWithNonExistentSymbol()
    {
        $value = 'AAPLTEEEEST';
        $constraint = new CompanySymbolConstraint();
        $this->repositoryMock->expects($this->once())
            ->method('findBySymbol')
            ->with($value)
            ->willReturn(null);

        $violationBuilder = $this->createMock(ConstraintViolationBuilderInterface::class);
        $violationBuilder->expects($this->once())
            ->method('setParameter')
            ->willReturnSelf();
        $violationBuilder->expects($this->once())
            ->method('addViolation');

        $this->contextMock->expects($this->once())
            ->method('buildViolation')
            ->with($constraint->message)
            ->willReturn($violationBuilder);

        $validator = new CompanySymbolValidator($this->repositoryMock);
        $validator->initialize($this->contextMock);
        $validator->validate($value, $constraint);
    }

    public function testValidateWithExistentSymbol()
    {
        $validator = new CompanySymbolValidator($this->repositoryMock);
        $constraint = new CompanySymbolConstraint();
        $symbol = 'SYM';

        $this->repositoryMock->expects($this->once())
            ->method('findBySymbol')
            ->with($symbol)
            ->willReturn(new CompanyInformation());

        $this->contextMock->expects($this->never())
            ->method('buildViolation');

        $validator->initialize($this->contextMock);
        $validator->validate($symbol, $constraint);
    }
}

