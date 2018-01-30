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

function objectLinks(){
  $('#objectLinks').empty();
  $.ajax({
    type: "POST",
    url: "/ajax.objectTabs.php",
    cache: false,
    success: function(responce) {
      $('#objectLinks').html(responce);
    }
  });
};

$(document).ready(function() {
  subscriberList();
  objectLinks();

  $("#object_add_btn").click(
  function(){
    sendAjaxForm('result', 'object_add', 'object_add.php');
    return false;
  }
);

  $("#subdivision_add_btn").click(
  function(){
    sendAjaxForm('result', 'object_add', 'object_add.php');
    return false;
  }
);

$("#subscriber_add_btn").click(
  function() {
    sendAjaxForm('result', 'subscriber_add', 'subscriber_add.php');
    setTimeout(function () {
      subscriberList();
    },1000);
    return false;
  }
);

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

$(document).on("click", ".remove-subscriber", function(e) {
  if(confirm("Вы уверенны что хотите удалить этого пользователя ?") == true)
  {
    var id =$(this).attr('id');
    delSubscriber(id, 'delSubscriberList.php');
    return false;
  }
});

function delSubscriber(id, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        data: 'id=' + id,  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
          $('#result').html(result);
          $('tr#row-' + id).remove(); // строка имеет id вида "row-17"
      },
      error: function(response) { // Данные не отправлены
            $('#result').html('Ошибка. Данные не отправлены.');
      }
  });
}

function subscriberList(id) {
  $('#subscriberList').empty();
  $.ajax({
    type: "POST",
    url: "/ajax.subscriberList.php",
    data: 'id=' + id,  // Сеарилизуем объект
    cache: false,
    success: function(responce) {
      $('#subscriberList').html(responce);
    }
  });
};

$(document).on("click", ".objectLink", function(e) {
    var id =$(this).attr('id');
    subscriberList(id);
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
