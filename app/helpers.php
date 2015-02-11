<?php
function readQIF($file)
{
    $handle = fopen($file, "r");
    if ($handle) {
        $i = 0;
        $data = array();
        while (($line = fgets($handle)) !== false) {
            if (preg_match("/\^/", $line)) $i++;
            if (preg_match("/^D[0-9]+/", $line)) {
                $date = explode("/", substr($line, 1));
                $date = $date[2] . '-' . $date[1] . '-' . $date[0];
                $date = preg_replace("/[\n\r\t]/", "", $date);
                $data[$i]['date'] = date('Y-m-d H:i:s', strtotime($date));
            }
            if (preg_match("/^(T-)[0-9]+/", $line)) {
                $data[$i]['amount'] = substr($line, 2);
                $data[$i]['type'] = 'purchase';
            }
            if (preg_match("/^(T)[0-9]+/", $line)) {
                $data[$i]['amount'] = substr($line, 1);
                $data[$i]['type'] = 'income';
            }
            if (preg_match("/^P/", $line)) {
                $data[$i]['description'] = substr($line, 1);
            }
        }
    } else {
        return false;
    }
    fclose($handle);
    return $data;
}


function totalDayOfMonth($month){

    $dayArr = array(
        '01'=>'30',
        '02'=>'28',
        '03'=>'31',
        '04'=>'30',
        '05'=>'31',
        '06'=>'30',
        '07'=>'31',
        '08'=>'31',
        '09'=>'30',
        '10'=>'31',
        '11'=>'30',
        '12'=>'31',
    );
   // if(in_array($month,$dayArr)){
        return $dayArr[$month];
   // }
    //return 30;

}