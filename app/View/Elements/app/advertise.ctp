<div id="rev">
	<?php if(Configure::read('Feature.adsense')) { ?>
	<script type="text/javascript"><!--
		google_ad_client = "ca-pub-7904143507693921";
		/* App Display */
		google_ad_slot = "<?php echo Configure::read('Adsense.adunit'); ?>";
		google_ad_width = 160;
		google_ad_height = 600;
		//-->
	</script>
	<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
	<?php } ?>
</div>
