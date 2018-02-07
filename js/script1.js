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
$(document).on("click", "#subscriber-tab-link", function(e) {
    subscriber();
    return false;
});


function subscriber() {
  $('#subscriber').empty();
  $.ajax({
    type: "POST",
    url: "/action/subscriber.php",
    cache: false,
    success: function(responce) {
      $('#subscriber').html(responce);
    }
  });
};
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

// Удаление объекта
 $(document).on("click", ".object-del", function(e) {
  if(confirm("Вы уверенны что хотите удалить этот объект ?") == true)  {
    var id =$(this).attr('id');
    delInTable(id, 'object-del.php');
    return false;
  }
 });
 // Удаление подразделения
  $(document).on("click", ".subdivision-del", function(e) {
   if(confirm("Вы уверенны что хотите удалить это подразде ?") == true)  {
     var id =$(this).attr('id');
     delInTable(id, 'subdivision-del.php');
     return false;
   }
  });
  // Удаление аббонентов
   $(document).on("click", ".subscriber-del", function(e) {
    if(confirm("Вы уверенны что хотите удалить этого аббонента ?") == true)  {
      var id =$(this).attr('id');
      delInTable(id, 'subscriber-del.php');
      return false;
    }
   });

  // Вывод таблицы подразделений

// Вывод таблицы подразделений в Табе "Подразделения"
$(document).on("click", "#object", function(e) {
  var object_id = $("select#object").val();
  if(!object_id){
    $('#subdivision-table').html('');
  }else{
    $.ajax({
      type: "POST",
      url: "/action/subdivision-table.php",
      data: {id: object_id},
      cache: false,
      success: function(responce){ $('#subdivision-table').html(responce); }
    });
  };
});

  // Вывод таблицы подразделений
function subdivisionTable(id) {
  $.ajax({
    url: "/action/subdivision-table.php",
    type: "POST",
    cache: false,
    data: {id: id},
    success: function(data) {
      $('#subdivision-table').html(data);
    }
  });
};


  // Вывод таблицы аббонентов
function subscriberTable(id) {
  $.ajax({
    url: "/action/subscriber-table.php",
    type: "POST",
    cache: false,
    data: {id: id},
    success: function(data) {
      $('#subscriber-table').html(data);
    }
  });
};

/*
 * Изменение позиций вывода записей
 */

// Для объектов
  $(document).on("click", ".object-position-up", function(e) {
      var id =$(this).attr('id');
      positionСhange(id, 'object', 'position-up');
  });

  $(document).on("click", ".object-position-down", function(e) {
      var id =$(this).attr('id');
      positionСhange(id, 'object', 'position-down');
  });

  // Для подразделений
  $(document).on("click", ".subdivision-position-up", function(e) {
      var id =$(this).attr('id');
      positionСhange(id, 'subdivision', 'position-up');
  });

  $(document).on("click", ".subdivision-position-down", function(e) {
      var id =$(this).attr('id');
      positionСhange(id, 'subdivision', 'position-down');
  });


  // Для аббонентов
  $(document).on("click", ".subscriber-position-up", function(e) {
      var id =$(this).attr('id');
      positionСhange(id, 'subscriber', 'position-up');
  });

  $(document).on("click", ".subscriber-position-down", function(e) {
      var id =$(this).attr('id');
      positionСhange(id, 'subscriber', 'position-down');
  });
/*
 * Абоненты
 */

// Связные списки во вкладке аббонентов для вывода подразделений в selct
 $(document).on("click", "#select-objeсt", function(e) {
     selectSubdivision();
 });

function selectSubdivision(){
  var object_id = $('select[name="select-object"]').val();
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


$(document).on("click", "#object-sabdivision", function(e) {
    selectSubdivisionSabsc();
});
function selectSubdivisionSabsc(){
  var subdivision_id = $("select#object-sabdivision").val();
  if(!subdivision_id){
    $('div[name="subscriber-table"]').html('');
  }else{
    $.ajax({
      type: "POST",
      url: "/action/subscriber-table.php",
      data: {id: subdivision_id},
      cache: false,
      success: function(responce){ $('#subscriber-table').html(responce); }
    });
  };
};

function positionСhange(id, table, position) {
  $.ajax({
      url:     '/action/position-change.php', //url страницы (action_ajax_form.php)
      type:     "POST", //метод отправки
      cache: false,
      data: {id: id, table: table, position: position},  // Сеарилизуем объект
      dataType: 'json',
      success: function(data) {
        if(table == 'object') objectTable();
        if(table == 'subdivision') subdivisionTable(data.object_id);
        if(table == 'subscriber') subscriberTable(data.subdivision_id);
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
