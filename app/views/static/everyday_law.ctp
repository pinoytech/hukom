<?php $this->viewVars['title_for_layout'] = $title; ?>
<div id="full-content">
	<div id="main">
	    <div class="public-pages">
	        <h1><?php echo $title; ?></h1>	        
	        <br />
	        
            <?php echo eval('?>' . $body . '<?php '); ?>
            <br />

            <div class="blog_navigation">
                <?php if ($previous) { ?>
                    <div id="previous">
                        <a href="<?php echo $previous['SiteCopy']['slug']; ?>">Previous: <?php echo $previous['SiteCopy']['title']; ?></a>
                    </div>
                <?php } ?>
                
                
                <?php if ($next) { ?>
                    <div id="next">
                        <a href="<?php echo $next['SiteCopy']['slug']; ?>">Next: <?php echo $next['SiteCopy']['title']; ?></a>
                    </div>
                <?php } ?>
            </div>
            
            <br />
            
	    </div> <!-- public pages -->
	    <?php echo $this->element('adsense_leaderboard'); ?>
	</div>
</div>
