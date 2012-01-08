<?php //$this->viewVars['title_for_layout'] = "About Us" ?>
<div id="full-content">
	<div id="main">

        <?php echo $this->element('adsense_leaderboard'); ?>
        
        <div class="addthis-page">
            <?php echo $this->Facebook->share(); ?>
        </div>
        
	    <div class="public-pages">
	        
            <?php echo $body; ?>
            
            <br />
            
            <?php //echo $this->Facebook->comments(); ?>
	    
	    </div> <!-- public pages -->
	    
	    <?php echo $this->element('adsense_leaderboard'); ?>
	    
	</div>
</div>
