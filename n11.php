<?php

if (@$_POST["submit"]) {
	function siteAdresi($site)
	{
		$ch = curl_init();
		$hc = "YahooSeeker-Testing/v3.9 (compatible; Mozilla 4.0; MSIE 5.5; Yahoo! Search - Web Search)";
		curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.com');
		curl_setopt($ch, CURLOPT_URL, $site);
		curl_setopt($ch, CURLOPT_USERAGENT, $hc);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$site = curl_exec($ch);
		curl_close($ch);
		return $site;
	}
	function search($start, $end, $string)
	{
		@preg_match_all('/' . preg_quote($start, '/') .
		'(.*?)'. preg_quote($end, '/').'/i', $string, $m);
		return @$m[1];
	}

	$veri= siteAdresi($_POST["kanalgir"]);
	$itemName  = search('"title":"','"',$veri)[0];
	$itemPrice = search('"pDiscountedPrice":"','"',$veri)[0];
	$itemImg   = search('"pImageUrl":"','"',$veri)[0];

}
?>
<hr>
<form action="" method="POST">
	<input type="text" name="kanalgir" placeholder="Hepsiburada ürün bağlantısı">
	<input type="submit" name="submit" value="Ara">
</form>

<table border="1">
	<thead>
		<th>itemImg</th>
		<th>itemName</th>
		<th>itemPrice</th>
	</thead>
	<tbody>
		<tr>
			<?php if (!empty($itemImg)): ?>
				<td><img src="<?php echo $itemImg ?>" width="50"></td>
			<?php endif; ?>
			<?php if (!empty($itemName)): ?>
				<td><?php echo @$itemName; ?></td>
			<?php endif; ?>
			<?php if (!empty($itemPrice)): ?>
				<td><?php echo @$itemPrice; ?>₺</td>
			<?php endif; ?>
		</tr>
	</tbody>
</table>
