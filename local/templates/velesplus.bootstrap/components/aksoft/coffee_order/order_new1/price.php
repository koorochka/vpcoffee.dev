<?
/**
 * @param $type
 * @param $location
 * @param $count
 * @param $coffee
 * @param $coffe_count
 * @return int
 */
function getMachinePrice($type, $location, $count, $coffee, $coffe_count){
    $p = 0;

    if($location == "moscow")
    {

        if($type == 1)  # Механика
        {
            if($count == 1)
            {
                $p=1;
            }
            elseif($count == 2)
            {
                $p=2;
            }
            elseif($count == 3)
            {
                $p=3;
            }
            elseif($count >= 4)
            {
                $p=4;
            }
        }
        elseif($type == 10)  # Суперавтомат
        {
            if($count == 6)
            {
                $p=21;
            }
            elseif($count == 7)
            {
                $p=22;
            }
            elseif($count == 8)
            {
                $p=23;
            }
            elseif($count == 9)
            {
                $p=24;
            }
            elseif($count > 9)
            {
                $p=10;
            }
        }
        else # Автомат
        {
            if($count == 3)
            {
                $p=5;
            }
            elseif($count == 4)
            {
                $p=6;
            }
            elseif($count == 5 || $count == 6)
            {
                $p=7;
            }
            elseif($count == 7)
            {
                $p=8;
            }
            elseif($count >= 8 && $count < 12)
            {
                $p=9;
            }
            elseif($count >= 12)
            {
                $p=10;
            }
        }
    }
    elseif($location == "all")
    {
        if($type == 1)  # Механика
        {
            if($count == 1)
            {
                $p=11;
            }
            elseif($count == 2)
            {
                $p=12;
            }
            elseif($count == 3)
            {
                $p=13;
            }
            elseif($count >= 4)
            {
                $p=14;
            }
        }
        elseif($type == 10)  # Суперавтомат
        {
            if($count == 6)
            {
                $p=25;
            }
            elseif($count == 7)
            {
                $p=26;
            }
            elseif($count == 8)
            {
                $p=27;
            }
            elseif($count == 9)
            {
                $p=28;
            }
            elseif($count > 9)
            {
                $p=20;
            }
        }
        else # Автомат
        {
            if($count == 3)
            {
                $p=15;
            }
            elseif($count == 4)
            {
                $p=16;
            }
            elseif($count == 5 || $count == 6)
            {
                $p=17;
            }
            elseif($count == 7)
            {
                $p=18;
            }
            elseif($count >= 8 && $count < 12)
            {
                $p=19;
            }
            elseif($count >= 12)
            {
                $p=20;
            }
        }
    }

    return $p;
}

/**
 * @param $type
 * @param $location
 * @param $count
 * @param $coffee
 * @param $coffe_count
 * @return mixed
 */
function calculate_price($type, $location, $count, $coffee, $coffe_count)
{
    $p = getMachinePrice($type, $location, $count, $coffee, $coffe_count);

    $result = str_replace(" ","",$coffee["PROPERTY_P".$p."_VALUE"]);
    $result = $result * $coffe_count;

    return $result;
}
?>