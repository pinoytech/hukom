<?php 
    /*
    echo $form->create('Event', array('target'=> '_parent'));
    echo $form->input('title' , array('label' => 'Event title'));
    echo '<br/>At: ' . $displayTime;
    echo $form->input('start', array('type'=>'text','value'=>$event['Event']['start']));
    echo $form->input('end', array('type'=>'text','value'=>$event['Event']['end']));
    echo $form->input('allday', array('type'=>'text','value'=>$event['Event']['allday']));
    echo  $form->end(array('label'=>'Save' ,'name' => 'save')); 
    */
    
    // echo '<br/>At: ' . $displayTime;
    // echo $form->input('start', array('type'=>'text','value'=>$event['Event']['start']));
    // echo $form->input('end', array('type'=>'text','value'=>$event['Event']['end']));
    // echo $form->input('start', array('type'=>'time'));
    // echo $form->input('end', array('type'=>'time'));
    
    echo $form->create('Event', array('target'=> '_parent'));
    echo $form->input('title' , array('label' => 'User', 'value' => $custom->get_first_last_name($user_id)));
    echo $form->input('date', array('type'=>'text', 'value'=>$event['Event']['date'], 'readonly' => true));
    echo $form->input('start', array('type'=>'text', 'readonly' => true));
    echo $form->input('end', array('type'=>'text', 'readonly' => true));
    echo $form->input('allday', array('type'=>'hidden', 'value'=>$event['Event']['allday']));

    // echo  $form->end(array('label'=>'Save' ,'name' => 'save')); 
?>

<script type='text/javascript'>
    jQuery(document).ready(function() {
        $('#EventStart, #EventEnd').timepicker({
            ampm: true,
            stepMinute: 30,
        });
    });
</script>