
$(document).ready(function() {
    $("#subdivision_add_btn").click(
    function(){
      sendAjaxForm('result', 'subdivision_add', 'subdivision_add.php');
      return false;
    }
  );
});
$(document).ready(function() {
    $("#subdivision_add_btn").click(
    function(){
      sendAjaxForm('result', 'object_add', 'object_add.php');
      return false;
    }
  );
});

$(document).ready(function() {
    $("#subscriber_add_btn").click(
    function(){
      sendAjaxForm('result', 'subscriber_add', 'subscriber_add.php');
      subscriberList();
      return false;
    }
  );
});




/*
 *  Связные списки
 */

function selectSubdivision(){
  var object_id = $('select[name="object"]').val();
  if(!id_country) {
    $('div[name="selectDataObject"]').html('');
    $('div[name="selectDataSubscriber"]').html('');
  } else {
  $.ajax({
    type: "POST",
    url: "ajax.php",
    data: { action: 'showRegionForInsert', id_country: id_country },
    cache: false,
    success: function(responce){ $('div[name="selectDataRegion"]').html(responce); }
  });
  };
};

function objectTabs(){
  $('#objectTabs').empty();
  $.ajax({
    type: "POST",
    url: "/ajax.objectTabs.php",
    cache: false,
    success: function(responce) {
      $('#objectTabs').html(responce);
    }
  });
};

function subscriberList(){
  $('#subscriberList').empty();
  $.ajax({
    type: "POST",
    url: "/ajax.subscriberList.php",
    cache: false,
    success: function(responce) {
      $('#subscriberList').html(responce);
    }
  });
};

$(document).ready(function() {
    $("#subdivision_add_btn").click(
    function(){
      sendAjaxForm('result', 'object_add', 'object_add.php');
      return false;
    }
  );

subscriberList();
objectTabs();
});

function sendAjaxForm(result, ajax_form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
          result = $.parseJSON(response);
          $('#result').html(result);
          $("#"+ajax_form)[0].reset();
      },
      error: function(response) { // Данные не отправлены
            $('#result').html('Ошибка. Данные не отправлены.');
      }
  });
}

$(document).on("click", "#subscriber_add_btn", function(e) {
  sendAjaxForm('result', 'subscriber_add', 'subscriber_add.php');
  return false;
});


/*
 *  Связные списки
 */

function selectSubdivision(){

  var object_id = $('select[name="selectObject_id"]').val();
  if(!object_id){
    $('div[name="selectSubdivision"]').html('');
  }else{
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {
        action: 'showSubdivision', object_id: object_id
      },
      cache: false,
      success: function(responce){ $('div[name="selectSubdivision"]').html(responce); }
    });
  };
};
