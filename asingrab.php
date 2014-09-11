<?php
libxml_use_internal_errors(true);
function sgt_ag_graburl($url,$page)
{
	$asin_area='';
	$cnt=0;
	$retval='';
	$cekakhir='';
	for($i=1;$i<=$page;$i++)
	{	
		$newurl='';
		if ($i<>1)
		{
			$newurl=trim(urldecode($url)).'&p='.$i;
		}else
		{
			$newurl=trim(urldecode($url));
		}
		//print_r($newurl.'<br/>');
		$var = sgt_ag_fread_url($newurl); 	       
    	preg_match_all ("/a[\s]+[^>]*?href[\s]?=[\s\"\']+".
                    "(.*?)[\"\']+.*?>"."([^<]+|.*?)?<\/a>/", $var, $matches,PREG_PATTERN_ORDER);    
	    $matches = $matches[1];
	    $list = array();
		foreach($matches as $var)
		{    
			$hasil=explode("/",$var);
			if (count($hasil)>=5)
			{	
				if ($hasil[2]=='product-reviews')
				{
					if ($cekakhir !== $hasil[3])
					{
						$asin_area .= $hasil[3]."\n";
						//print_r($hasil[3]."<br/>");
						$cekakhir=$hasil[3];
						$cnt++;
					}
				}
				if ($hasil[4]=='dp')
				{
					if ($cekakhir !== $hasil[5])
					{
						$asin_area .=  $hasil[5]."\n";
						//print_r($hasil[5]."<br/>");
						$cekakhir=$hasil[5];
						$cnt++;
					}
				}
			}
		}	
	}
	$retval='<h2>Result : </h2><table><tr><td>Grab :</td><td>'.$cnt.' Asin</td></tr><tr><td colspan=2><textarea style="float:left;" rows="20" cols="12">'.$asin_area.'</textarea></td></tr></table><button onclick="history.go(-1);">Grab More </button><br/> * If you need tutorial how to create this plugin visit my site <a href="http://seegatesite.com" target="_blank">Seegatesite</a>';
	return $retval;
}
function sgt_ag_fread_url($url,$ref="")
{
        if(function_exists("curl_init")){
            $ch = curl_init();
            $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; ".
                          "Windows NT 5.0)";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
            curl_setopt( $ch, CURLOPT_HTTPGET, 1 );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION , 1 );
            curl_setopt( $ch, CURLOPT_FOLLOWLOCATION , 1 );
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_REFERER, $ref );
            //curl_setopt ($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
            $html = curl_exec($ch);
            curl_close($ch);
        }
        else{
            $hfile = fopen($url,"r");
            if($hfile){
                while(!feof($hfile)){
                    $html.=fgets($hfile,1024);
                }
            }
        }
        return $html;
}
?>