<?php

function word($len){
	$vowels = Array("a","e","i","o","u");
	$cons = Array("b","c","d","f","g","h","j","k","l","m","n","p","q","r","s","t","v","w","y","z");
	$vlen = count($vowels) - 1;
	$clen = count($cons) - 1;
	$i = rand(0,1);
	$word = "";
	while($i <= $len){
		if(($i % 2) == 0){
			$word .= $cons[rand(0,$clen)];
		}else{
			$word .= $vowels[rand(0,$vlen)];
		}
		$i++;
	}
	return $word;
}

$verbs = Array("went","talked","were","had been","did","found","sought","see","felt","worked","working","tried","try","explain","wish","look","finish","build","tell","verify","set","sit",
"open","close","shut","refuse","laughed","interrogate","examine","discover","figure","determine","flatten","decode","encrypt","travel","dislocate","interject","understand","reneg","regenerate",
"extract","ponder","climb","distance","run","ran","were running","kept","present","conspire","carry","conceal","mobilize","mobilized","expedite","rethink","start","end","puzzled","recognize");

$pronouns = Array("he","she","they","them","it","there","that","these","this","my","our","you","me","I","myself");

$preps = Array("to","on","in","at","around","inside","over","under","about","aside");

$interjections = Array("wow","hey","eh","man","yay");

$conjunctions = Array("and","or","with","but","although","because","before","how","if","once","since","than","that","though","till","until","when","where","whether","while");

$p[0] = $verbs;
$p[1] = $pronouns;
$p[2] = $interjections;
$p[3] = $conjunctions;
$p[4] = "word";


function phrase($len){
	$p = $GLOBALS["p"];
	$phrase = "";
	$i = 0;
	while($i <= $len){
		$x = $p[rand(0,4)];
		if($x == "word"){
			$phrase .= word(rand(0,6));
		}else{
			$tmp = $x;
			$phrase .= $tmp[rand(0,count($tmp))];
		}
		$phrase .= " ";
		$i++;
	}
	return $phrase;
}

function sentence($len){
	$i = 0;
	$sen = "";
	$punctuation = Array(".",",",";",":","!","-");
	while($i <= $len){
		$sen .= phrase(rand(0,24));
		$sen .= $punctuation[rand(0,count($punctuation))];
		$i++;
	}
	return $sen;
}


function paragraph($len){
	$para = "";
	$i = 0;
	while($i <= $len){
		$pt = sentence(rand(0,14));
		$pt[0] = strtoupper($pt[0]);
		$para .= $pt;
		$para .= "<br /><br />\r\n";
		$i++;
	}
	return $para;
}

$things = Array("thing1","thing2","thing3","thing4");



$genders = Array("male","female");
$races = Array("Race1","Race2","Race3","Race4","Race5");
$firstname = word(rand(2,6));
$lastname = word(rand(2,8));
$race = $races[rand(0,count($races)-1)];
$height = rand(152,198);
$weight = rand(58,108);
$gender = $genders[rand(0,1)];
$age = rand(16,45);

//Capitalize names
$firstname[0] = strtoupper($firstname[0]);
$lastname[0] = strtoupper($lastname[0]);

// The output is Javascript.
?>
<script type="text/javascript">
document.write('<style type="text/css">');
document.write('	.titles{');
document.write('		font-size: 24px;');
document.write('		font-weight: bold;');
document.write('		color: #666;');
document.write('		letter-spacing: 2px;');
document.write('		font-style: normal;');
document.write('	}');
	
document.write('	.text{');
document.write('		font-size: 11px;');
document.write('		color: #444;');
document.write('		letter-spacing: 1px;');
document.write('	}');
	
document.write('	.pic{');
document.write('		border-style: solid;');
document.write('		border-color: #000;');
document.write('		border-width: 1px;');
document.write('		margin: 6px;');
document.write('	}');
document.write('</style>');
document.write('<img class="pic" src="' + thispath + 'charbase.php?that=<?php echo time();?>&gender=<?php echo $gender;?>" alt="<?php echo $firstname; ?> <?php echo $lastname; ?>" align="left" />');
document.write('<span class="titles"><?php echo $firstname;?> <?php echo $lastname;?></span><br /><span class="text"><br />Age: <?php echo $age;?><br />Gender: <?php echo $gender;?><br />Height: <?php echo $height;?> cm<br />Weight: <?php echo $weight;?> kg<br />Race: <?php echo $race;?> <br /></span>');
document.write('<span class="text"><br /><br /><br /><br clear="all" /><?php echo $firstname;?> enjoys <?php echo $things[rand(0,count($things)-1)];?>, <?php echo $things[rand(0,count($things)-1)];?>, and <?php echo $things[rand(0,count($things)-1)];?>.</span>');
document.write('<br /><br /><a href="javascript:document.location=document.location;" style="font-size: 11px; color: #888; text-decoration: none; font-weight: bold;">generate another random character</a>');
</script>