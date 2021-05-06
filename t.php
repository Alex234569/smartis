<?php

$data = simplexml_load_file('http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=02/03/2019&date_req2=14/03/2019&VAL_NM_RQ=R01235');



print_r($data);