<?php $paginator->options(array('url' => $this->passedArgs)); ?>

<div id="search-toggle-holder">
  <?php echo $html->link(__('Search', true), 'javascript:void(0)', array('class'=>'search-toggle')); ?>
</div>

<?php  
if (!empty($title)) {
  echo '<b>Search Parameters</b>';
  echo '<br />';
  echo $title;
  echo '<br />';
  echo '<br />';
}
?>