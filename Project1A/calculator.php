<!DOCTYPE html>
<html>
<head>
    <title>Calculator</title>
</head>
<body>
    <h1>CS143 - Calculator</h1>
    <h5>Created by Nguyen Si Nguyen UID: 004870721</h5>
<form method="GET">
    <input type="text" name="input">
    <input type="submit" value="Calculate">
</form>

<h2> Result:
    <?php
    function Calculate($input){
        if(preg_match('/\s/',$input) and !preg_match('/([\+\-\*\/])/',$input)){
            return "Invalid Expression. Ambiguous Number.";
        }
        else{
            $equation = str_replace(' ','',$input);
        }
        if(preg_match('/([a-z])/',$equation)){ //check for valid numbers.
            $cal = "Invalid Expression. Not a number.";
        }
        elseif(preg_match('/[(\)]/',$equation)){ //check for parenthesis.
            $cal = "Invalid Expression. No parenthesis is allowed.";
        }
        elseif(preg_match('/([\+\-\*\/])/',$equation)){ //check for valid math operators.
            if(preg_match('/[1-9]\/[0]/',$equation)){ //check for divisible by 0. 0/0 will not show basing on giving specs.
                $cal = "Invalid Expression. Division by zero error.";
            }
            else{
                $value = eval('return '.$equation.';');
                $cal = $equation." = ".$value;
            }
        }
        else{
            if(preg_match('/./',$equation)){//return leading 0 for decimal input.
                $value = floatval($equation);
                $cal = $equation." = ".$value;
            }
            else{
                $value = floatval($equation);
                $cal = $equation." = ".$value;
            }
        }
        return $cal;
    }

    $input = $_GET["input"]; //str_replace(' ','',$_GET["input"]); //replace empty splace.
    echo Calculate($input);
    ?>
</h2>
<div>
    <ul>
        <li>Only numbers, +, -, *, and / operators are allowed in input textbox.</li>
        <li>The operators are left-associate and / and * operators have precedence over + and -. </li>
        <li>Integer and decimal numbers are allowed.</li>
        <li>0/0 will not return anything basing on giving specs.</li>
        <li>leading zeros will be disregarded.</li>
        <li>Calculator does not support parentheses.</li>
        <li>Calculator handles errors gracefully and will not return PHP error message.</li>
    </ul>
</div>
</body>
</html>
