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
  '/img/AddButton_up.png',
  '/img/Addbutton_down.png',
  '/img/availButton_up.png',
  '/img/previousButton_down.png',
  '/img/previousButton_up.png',
  '/img/nextButton_down.png',
  '/img/nextButton_up.png',
]).preload();