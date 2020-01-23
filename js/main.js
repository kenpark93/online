$(function() {
  var event_id;
  var event_ti;
  var event_st;
  var event_en;
  var event_de;
  var event_mu;
  //for (var i = kol.length - 1; i >= 0; i--) {
    //zap(kol[0]["id"]);
  //}
  $('.calendar').fullCalendar({
    eventSources: [
    {
      events : events,
      color : '#0EB6A2',
      textColor : '#fff',
    }
  ],
    height: 450,
  	dayClick: function(date, jsEvent, view){
  		var clickDate = date.format();
  		$('#start').val(clickDate);
    $('#dialog').dialog('open');
  	},
    eventClick: function(event) {
      console.log();
      $("#pos").html('');
      $('#titlee').val(event.title);
      $('#starte').val(event[3]);
      $('#ende').val(event[4]);
      $('#texte').val(event.description);
      $('#multe').val(event.mult);
      event_id = event.id;
      event_ti = event.title;
      event_st = event[3];
      event_en = event[4];
      event_de = event.description;
      event_mu = event.mult;
      if (event_mu) {
          img2 = new Image (200,200);
          img2.src="./uploads/" + event_mu;
          $("#pose").html('');
      $("#pose").append(img2);}
    $('#dialog1').dialog('open');
  }
  });

  $(".datepicker").datepicker({
    dateFormat: 'yy-mm-dd'
  }); 

  $('#dialog').dialog({
  	autoOpen: false,
  	show: {
  		effect: 'drop',
  		duration: 500
  	},
  	hide: {
  		effect: 'clip',
  		duration: 500
  	},
    buttons: [
    {   id: 'edit',
        text: 'Добавить',
        click: function() {
            addsob();
    }}]
  });

  $('#dialog1').dialog({
    autoOpen: false,
    show: {
      effect: 'drop',
      duration: 500
    },
    hide: {
      effect: 'clip',
      duration: 500
    },
    buttons: [
    {   id: 'edit',
        text: 'Изменить',
        click: function() {
            editsob(event_id);
    }},
    {   id: 'delete',
        text: 'Удалить',
        click: function() { 
            delsob(event_id);
        },
    }]
  });

  $('#dialog2').dialog({
    autoOpen: false,
    show: {
      effect: 'drop',
      duration: 500
    },
    hide: {
      effect: 'clip',
      duration: 500
    }
  });
    
    
  	
});

