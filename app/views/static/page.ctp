<?php //$this->viewVars['title_for_layout'] = "About Us" ?>
<div id="full-content">
	<div id="main">
	    <div class="public-pages">
            <?php echo eval('?>' . $body . '<?php '); ?>
            <br />
	    </div> <!-- public pages -->
	    <?php echo $this->element('adsense_leaderboard'); ?>
	</div>
</div>
