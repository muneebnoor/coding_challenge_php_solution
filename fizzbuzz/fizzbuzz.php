<?php
namespace hr;

/**
 *
 * Task: Given is the following FizzBuzz application which counts from 1 to 100 and outputs either the corresponding
 * number or if one of the following rules apply output the corresponding text.
 * Rules:
 *  - dividable by 3 without a remainder -> Fizz
 *  - dividable by 5 without a remainder -> Buzz
 *  - dividable by 3 or 5 without a remainder -> FizzBuzz
 *
 * Please refactor this code so that it can be extended in the future with other rules, such as
 * "if it is dividable by 7 without a remainder output Bar"
 * "if multiplied by 10 is larger than 100 output Foo"
 *
 */


abstract class arithmeticOperator
{
    const Plus = "+";
    const Minus = "-";
    const Mod = "%";
    const Multiply = "*";
}

abstract class ComparisonOperator
{
    const Equal = "==";
    const NotEqual = "!=";
    const LessThan = "<";
    const GreaterThan = ">";
    const LessThanOrEqual = "<=";
    const GreaterThanOrEqual = ">=";
}

class FizzBuzzRule
{
    public int $rightOperand;
    public string $comparisonOperator;
    public string $arithmeticOperator;
    public int $result;
    public string $output;

    function __construct(int $rightOperand, string $arithmeticOperator, string $comparisonOperator, int $result, string $output) {
        $this->rightOperand = $rightOperand;
        $this->comparisonOperator = $comparisonOperator;
        $this->arithmeticOperator = $arithmeticOperator;
        $this->result = $result;
        $this->output = $output;
    }
}

abstract class FizzBuzzRuleEvaluator
{
    public static function evaluate(int $leftOperand, FizzBuzzRule $rule) : bool{
        $leftComparisonOperand = self::arithmeticEvaluate($leftOperand, $rule->arithmeticOperator, $rule->rightOperand);
        return self::comparisonEvaluate($leftComparisonOperand, $rule->comparisonOperator, $rule->result);
    }

    private static function arithmeticEvaluate(int $leftOperand, string $arithmeticOperator, int $rightOperand): int{
        switch($arithmeticOperator){
            case "+":
                return $leftOperand + $rightOperand;
            case "-":
                return $leftOperand - $rightOperand;
            case "%":
                return $leftOperand % $rightOperand;
            case "*":
                return $leftOperand * $rightOperand;
            default:
                throw new Exception('Please provide a valid arithmetic operator');
        }
    }
    
    private static function comparisonEvaluate(int $leftOperand, string $comparisonOperator, int $rightOperand): int{
        switch($comparisonOperator){
            case "==":
                return $leftOperand == $rightOperand;
            case "!=":
                return $leftOperand != $rightOperand;
            case "<":
                return $leftOperand < $rightOperand;
            case ">":
                return $leftOperand > $rightOperand;
            case "<=":
                return $leftOperand <= $rightOperand;
            case ">=":
                return $leftOperand >= $rightOperand;  
            default:
                throw new Exception('Please provide a valid comparison operator');
        }
    }
}

class FizzBuzzEngine
{
    private $rules = array();

    function __construct(){
        $defaultRule1 = new FizzBuzzRule(3, ArithmeticOperator::Mod, ComparisonOperator::Equal, 0, "Fizz");
        $defaultRule2 = new FizzBuzzRule(5, ArithmeticOperator::Mod, ComparisonOperator::Equal, 0, "Buzz");
        $this->rules[0] = $defaultRule1;
        $this->rules[1] = $defaultRule2;
    }

    public function run($limit = 100)
    {
        for ($i = 1; $i <= $limit; $i++) {
            $output = '';
            if(isset($this->rules)){
                foreach ($this->rules as $rule) {
                    if(FizzBuzzRuleEvaluator::evaluate($i, $rule)){
                        $output .= $rule->output;
                    }  
                }
            }
            if (empty($output)) {
                $output = 'None';
            }
            echo sprintf('%d: %s', $i, $output . PHP_EOL);
        }
    }
    public function addRule(FizzBuzzRule $rule)
    {
        array_push($this->rules, $rule);
    }
}

$engine = new FizzBuzzEngine();
$newRule1 = new FizzBuzzRule(7, ArithmeticOperator::Mod, ComparisonOperator::Equal, 0, "Bar");
$newRule2 = new FizzBuzzRule(10, ArithmeticOperator::Multiply, ComparisonOperator::GreaterThan, 100, "Foo");
$engine->addRule($newRule1);
$engine->addRule($newRule2);
$engine->run();