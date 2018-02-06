/*
 *  Табы
 */

// Объекты
$(document).on("click", "#object-tab-link", function(e) {
    object();
    return false;
});

function object(){
  $('#object').empty();
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
$(document).on("click", "#subdivision-tab-link", function(e) {
    subdivision();
    return false;
});

function subdivision(){
  $('#subdivision').empty();
  $.ajax({
    type: "POST",
    url: "/action/subdivision.php",
    cache: false,
    success: function(responce) {
      $('#subdivision').html(responce);
    }
  });
};
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
 * Добавленние нового объекта
 */

 $(document).on("click", "#object-add-btn", function(e) {
     sendForm('result', 'object-add', 'object-add.php');
     setTimeout(function () {
       objectTable();
     },1000);
     return false;
 });

/*
 * END Добавленние нового объекта
 */

 // Вывод таблицы объектов

 function objectTable() {
   //$('#subscriberList').empty();
   $.ajax({
     type: "POST",
     url: "/action/object-table.php",
     cache: false,
     success: function(responce) {
       $('#object-table').html(responce);
     }
   });
 };


 /*
  * Удаление объекта
  */

 $(document).on("click", ".object-del", function(e) {
  if(confirm("Вы уверенны что хотите удалить этот объект ?") == true)  {
    var id =$(this).attr('id');
    delInTable(id, 'object-del.php');
    return false;
  }
 });

 /*
  * // Удаление объекта
  */

  // Изменение позиции
  $(document).on("click", ".object-position-up", function(e) {
      var id =$(this).attr('id');
      positionСhange(id, 'object', 'position-up');
  });

  $(document).on("click", ".object-position-down", function(e) {
      var id =$(this).attr('id');
      positionСhange(id, 'object', 'position-down');
  });

  function positionСhange(id, table, position) {
      $.ajax({
          url:     '/action/position-change.php', //url страницы (action_ajax_form.php)
          type:     "POST", //метод отправки
          data: {id: id, table: table, position: position},  // Сеарилизуем объект
          success: function() {
            objectTable();
          },
          error: function(response) { // Данные не отправлены
              $('#result').html('Ошибка. Данные не отправлены.');
            }
    });
  }

function sendForm(result, ajax_form, url) {
    $.ajax({
        url:     '/action/'+url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
          //result = $.parseJSON(response);
          //$('#result').html(result);
          $("#"+ajax_form)[0].reset();
      },
      error: function(response) { // Данные не отправлены
            $('#result').html('Ошибка. Данные не отправлены.');
      }
  });
}

function delInTable(id, url) {
   $.ajax({
       url:     '/action/'+url, //url страницы (action_ajax_form.php)
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
