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
    
    echo $form->create('Event', array('target'=> '_parent'));
    echo $form->input('title' , array('label' => 'User', 'value' => $custom->get_first_last_name($user_id)));
    // echo '<br/>At: ' . $displayTime;
    // echo $form->input('start', array('type'=>'text','value'=>$event['Event']['start']));
    // echo $form->input('end', array('type'=>'text','value'=>$event['Event']['end']));
    echo $form->input('start', array('type'=>'time'));
    echo $form->input('end', array('type'=>'time'));
    echo $form->input('date', array('type'=>'text', 'value'=>$event['Event']['date']));
    echo $form->input('allday', array('type'=>'text', 'value'=>$event['Event']['allday']));
    echo  $form->end(array('label'=>'Save' ,'name' => 'save')); 
?>