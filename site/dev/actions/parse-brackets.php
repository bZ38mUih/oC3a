<?php
function checkBrackets($str, $bracketsSigns)
{
    $str= " ".$str;
    foreach($bracketsSigns as $brace){
        if($endPos=strpos($str, $brace['end'])){
            $tmpStr = substr($str, 0, $endPos)." ";
            if($startPos = strpos(strrev($tmpStr), $brace['start'])){
                $restStr=substr($str, strlen($tmpStr)-$startPos, $endPos-strlen($tmpStr)+$startPos);
                $glueStr=substr($str, 0, strlen($tmpStr)-$startPos-1).substr($str, $endPos+1, strlen($str));
                if(checkBrackets($glueStr, $bracketsSigns)){
                    if(checkBrackets($restStr, $bracketsSigns)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }elseif($startPos=strpos($str, $brace['start'])){
            return false;
        }
    }
    return true;
};