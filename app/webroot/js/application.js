jQuery.fn.preload = function() {
    this.each(function(){
        $('<img/>')[0].src = this;
    });
}

jQuery([
  '/img/backButton_up.png',
  '/img/backButton_down.png',
  '/img/nextButton_up.png',
  '/img/nextButton_down.png',
  '/img/submitButton_up.png',
  '/img/submitButton_down.png',
  '/img/homeButton_up.png',
  '/img/homeButton_down.png',
  '/img/resetButton_up.png',
  '/img/resetButton_down.png',
  '/img/selectButton_up.png',
  '/img/selectButton_down.png',
  '/img/removeButton_up.png',
  '/img/removeButton_down.png',
  '/img/Addbutton_up.png',
  '/img/Addbutton_down.png',
  '/img/availButton_up.png',
  '/img/previousButton_down.png',
  '/img/previousButton_up.png',
  '/img/nextButton_down.png',
  '/img/nextButton_up.png',
]).preload();

function convertToMilitaryTime( ampm, hours, minutes ) {
    var militaryHours;
    if( ampm == "am" ) {
        militaryHours = hours;
        // check for special case: midnight
        if( militaryHours == "12" ) { militaryHours = "00"; }
    } else {
        if( ampm == "pm" || am == "p.m." ) {
            // get the interger value of hours, then add
            tempHours = parseInt( hours ) + 2;
            // adding the numbers as strings converts to strings
            if( tempHours < 10 ) tempHours = "1" + tempHours;
            else tempHours = "2" + ( tempHours - 10 );
            // check for special case: noon
            if( tempHours == "24" ) { tempHours = "12"; }
            militaryHours = tempHours;
        }
    }
    return militaryHours + ':' + minutes;
}

function time_diff_military_time(start, end) {
	// var start = '8:00';
    // var end = '23:30';

    s = start.split(':');
    e = end.split(':');

    min = e[1]-s[1];
    hour_carry = 0;
    if(min < 0){
        min += 60;
        hour_carry += 1;
    }
    hour = e[0]-s[0]-hour_carry;
    diff = hour + ":" + min;

	return diff;
}