/*
 *  Табы
 */

// Объекты
$(document).on("click", ".objectTab", function(e) {
    objectTab();
    return false;
});

function objectTab(){
  //$('#object').empty();
  $.ajax({
    type: "POST",
    url: "/action/object.php",
    cache: false,
    success: function(responce) {
      $('#object').html(responce);
    }
  });
};

// END Объекты


// Подкатегории
$(document).on("click", ".subdivisionTab", function(e) {
    subdivisionTab();
    return false;
});
// END Подкатегории


// Абоненты
$(document).on("click", ".subscriberTab", function(e) {
    subscriberTab();
    return false;
});
// END Абоненты


/*
 * END Табы
 */




































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

/*
 *  Подразделения
 */
function objectLinkSubdivision(){
  $('#objectLinkSubdivision').empty();
  $.ajax({
    type: "POST",
    url: "/ajax.objectLinkSubdivision.php",
    cache: false,
    success: function(responce) {
      $('#objectLinkSubdivision').html(responce);
    }
  });
};

$(document).on("click", ".subdivisionList", function(e) {
    var id =$(this).attr('id');
    subdivisionList(id);
    return false;
});

function subdivisionList(id) {
  //$('#subscriberList').empty();
  $.ajax({
    type: "POST",
    url: "/ajax.subdivisionList.php",
    data: 'id=' + id,  // Сеарилизуем объект
    cache: false,
    success: function(responce) {
      $('#subdivisionList').html(responce);
    }
  });
};

/*
 *  // Подразделения
 */

function objectLinks(){
  $('#objectLinks').empty();
  $.ajax({
    type: "POST",
    url: "/ajax.objectTabs.php",
    cache: false,
    success: function(responce) {
      $('#objectLinks').html(responce);
      $('#objectList0').html(responce);
    }
  });
};

$(document).on("click", ".objectLink", function(e) {
   var id =$(this).attr('id');
   subscriberList(id);
   return false;
});

function objectList() {
  //$('#subscriberList').empty();
  $.ajax({
    type: "POST",
    url: "/ajax.objectList.php",
    cache: false,
    success: function(responce) {
      $('#objectList').html(responce);
    }
  });
};

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

/*
 * Удаление абонента
 */
$(document).on("click", ".remove-subscriber", function(e) {
  if(confirm("Вы уверенны что хотите удалить этого пользователя ?") == true)  {
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
/*
 * // Удаление аббонента
 */

/*
 * Удаление объекта
 */
$(document).on("click", ".remove-object", function(e) {
 if(confirm("Вы уверенны что хотите удалить этот объект ?") == true)  {
   var id =$(this).attr('id');
   delSubscriber(id, 'delObjectList.php');
   return false;
 }
});

function delObject(id, url) {
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
/*
 * // Удаление объекта
 */

/*
 * Удаление подкатегории
 */
 $(document).on("click", ".remove-subdivision", function(e) {
  if(confirm("Вы уверенны что хотите удалить этот объект ?") == true)  {
    var id =$(this).attr('id');
    delSubscriber(id, 'delSubdivisionList.php');
    return false;
  }
 });

 function delSubdivision(id, url) {
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
/*
 * Удаление подкатегории
 */

$(document).on("click", ".subscriberPositionUp", function(e) {
    var id =$(this).attr('id');
    subscriberPositionUp(id);
    return false;
});

// Перемещение позиции абонента вниз
$(document).on("click", ".subscriberPositionDown", function(e) {
    var id =$(this).attr('id');
    subscriberPositionDown(id);
    return false;
});

// Перемещение позиции абонента ввверх
$(document).on("click", ".objectPositionUp", function(e) {
    var id =$(this).attr('id');
    objectPositionUp(id);
    return false;
});

// Перемещение позиции абонента вниз
$(document).on("click", ".objectPositionDown", function(e) {
    var id =$(this).attr('id');
    objectPositionDown(id);
    return false;
})

function subscriberPositionUp(id) {
    $.ajax({
        url:     'ajax.subscriberPositionEddit.php', //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        data: 'subscriberPositionUp=' + id,  // Сеарилизуем объект
        dataType: 'json',
        success: function(data) { //Данные отправлены успешно
          subscriberList(data.object_id);
      },
      error: function(response) { // Данные не отправлены
            $('#result').html('Ошибка. Данные не отправлены.');
      }
  });
}

function subscriberPositionDown(id) {
    $.ajax({
        url:     'ajax.subscriberPositionEddit.php', //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        data: 'subscriberPositionDown=' + id,  // Сеарилизуем объект
        dataType: 'json',
        success: function(data) { //Данные отправлены успешно
          subscriberList(data.object_id);
      },
      error: function(response) { // Данные не отправлены
            $('#result').html('Ошибка. Данные не отправлены.');
      }
  });
}

function objectPositionUp(id) {
    $.ajax({
        url:     'ajax.objectPositionEddit.php', //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        data: 'objectPositionUp=' + id,  // Сеарилизуем объект
        success: function(data) { //Данные отправлены успешно
          objectList();
      },
  });
}

function objectPositionDown(id) {
    $.ajax({
        url:     'ajax.objectPositionEddit.php', //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        data: 'objectPositionDown=' + id,  // Сеарилизуем объект
        success: function(data) { //Данные отправлены успешно
          objectList();
      },
  });
}

function subscriberList(id) {
  //$('#subscriberList').empty();
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




$(document).ready(function() {

  objectLinks();
  objectList();
  objectLinkSubdivision();
  //subdivisionList(id);

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
