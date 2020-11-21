<?php

function calBadgeLevel($practice_score, $objective_score, $full_score)
{
    return (($practice_score + $objective_score) * $full_score) / 100;
}

function dateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strMonthCut = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
    $strMonthThai = $strMonthCut[$strMonth];
    return thainumDigit("$strDay $strMonthThai พ.ศ. $strYear ");
}

function thainumDigit($num)
{
    return str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'), array("๐", "๑", "๒", "๓", "๔", "๕", "๖", "๗", "๘", "๙"), $num);
}