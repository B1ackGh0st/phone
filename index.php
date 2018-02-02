<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <title>Checkout example for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
     body{
       font-size: 14px;
     }

     .bg-light  {
       padding-top: 50px;
     }
    </style>
  </head>

  <body class="bg-light">

    <div class="container">

      <div class="row">
        <div class="col-md-12 order-md-1">
          <div id="result"></div>

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#objects" role="tab" aria-controls="objects" aria-selected="true">Объекты</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#subdivisions" role="tab" aria-controls="subdivisions" aria-selected="false">Подразделения</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="contact-tab" data-toggle="tab" href="#subscribers" role="tab" aria-controls="subscribers" aria-selected="false">Абоненты</a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">

          <div class="tab-pane fade show active" id="objects" role="tabpanel" aria-labelledby="objects-tab">
            <div class="card">
              <div class="card-body">
                <form class="form-inline" id="object_add" method="post" action="">
                  <label <label class="sr-only" for="object_add_name">Объект</label>
                  <input type="text" name="object_add_name" id="object_add_name" class="form-control mb-2 mr-sm-2 form-control-sm" placeholder="Имя объекта">
                  <button id="object_add_btn" class="btn btn-sm btn-primary mb-2">Добавить</button>
              </form>
              </div>
            </div>
            <div class="card">
              <div class="card-body" id="objectList">
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="subdivisions" role="tabpanel" aria-labelledby="subdivisions-tab">
            <div class="card">
              <div class="card-body">
                <form id="subdivision_add" method="post" action="">
                <div class="form-group row" id="subdivision_add" method="post" action="">
                  <label for="subdivision_add_name" class="col-sm-2 col-form-label">Имя подразделения</label>
                  <div class="col-sm-8">
                    <input type="text" name="subdivision_add_name" id="subdivision_add_name" class="form-control form-control-sm" placeholder="Имя подразделения">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Объект</label>
                  <div class="col-sm-8">
                    <select class="form-control form-control-sm" name="object_id" id="object_id">
                      <?php
                      $query = 'SELECT * FROM object';
                      $a = pg_query($connection, $query);
                      while($row = pg_fetch_array($a)) {
                        echo "<option value=".$row['id'].">".$row['name']."</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button id="subdivision_add_btn" class="btn btn-sm btn-primary mb-2">Добавить</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <div class="card">
              <div class="card-body">
                <?php
                $connection = pg_connect("host=127.0.0.1 port=5432 dbname=phone user=postgres password=postgres");

                $query = 'SELECT sub.id, sub.name, ob.id, ob.name FROM object as ob, subdivision as sub WHERE sub.object_id = ob.id';
                $a = pg_query($connection, $query);
                echo '<table class="table table-bordered table-sm">
                        <thead>
                          <tr>
                            <th scope="col">Наименование</th>
                            <th scope="col">Объект</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>';
                while($row = pg_fetch_row($a)) {
                echo '<tr><td>'.$row[1].'</td><td>'.$row[3].'</td><td><a href="object_del='.$row[0].'">Удалить</a></td></tr>';
                }
                echo "</tbody></table>";
                ?>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="subscribers" role="tabpanel" aria-labelledby="subscribers-tab">
            <div class="card">
              <div class="card-body">
                <form id="subscriber_add" method="post" action="">
                  <div class="form-group row" id="subscriber_add" method="post" action="">
                    <label for="subscriber_add_name" class="col-sm-2 col-form-label">Имя абонента</label>
                    <div class="col-sm-6">
                      <input type="text" name="subscriber_add_name" id="subscriber_add_name" class="form-control form-control-sm" placeholder="Имя абонента">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Подразделение</label>
                    <div class="col-sm-4">
                      <select name="selectObject_id" id="selectObject_id" onchange="javascript:selectSubdivision();" class="form-control form-control-sm">
                        <?php
                        $query = 'SELECT * FROM object ORDER BY position ASC';
                        $a = pg_query($connection, $query);
                        while($row = pg_fetch_row($a)) {
                          echo "<option value=".$row[0].">".$row[1]."</option>";
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div name="selectSubdivision"></div>

                  <div class="row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Телефон</label>
                    <div class="col">
                      <div class="form-group" id="subscriberPhone0">
                          <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone0" id="subscriberPhone0" class="form-control form-control-sm" placeholder="Телефон">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group" id="subscriberPhone1">
                          <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone1" id="subscriberPhone1" class="form-control form-control-sm" placeholder="Телефон">
                      </div>
                    </div>
                    <div class="col">
                  <div class="form-group" id="subscriberPhone2">
                      <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone2" id="subscriberPhone2" class="form-control form-control-sm" placeholder="Телефон">
                  </div>
                  </div>
                  <div class="col">
                  <div class="form-group" id="subscriberPhone3">
                        <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone3" id="subscriberPhone3" class="form-control form-control-sm" placeholder="Телефон">
                    </div>
                  </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-10">
                      <button id="subscriber_add_btn" class="btn btn-sm btn-success mb-2"><img src="img/plus-2x.png"> Добавить</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card">
              <ul class="nav" id="objectLinks">

              </ul>
              <div class="card-body" id="subscriberList">

              </div>
            </div>
          </div>
        </div>

        </div>
      </div>

      <footer cl<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <p class="mb-1">&copy; 2018 СДТУ СГЭС</p>
      </footer>
    </div>

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Редактирование абонента</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form id="subscriber_add" method="post" action="">
              <div class="form-group row" id="subscriber_add" method="post" action="">
                <label for="subscriber_add_name" class="col-sm-2 col-form-label">Имя абонента</label>
                <div class="col-sm-6">
                  <input type="text" name="subscriber_add_name" id="subscriber_add_name" class="form-control form-control-sm" placeholder="Имя абонента">
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Подразделение</label>
                <div class="col-sm-4">
                  <select name="selectObject_id" id="selectObject_id" onchange="javascript:selectSubdivision();" class="form-control form-control-sm">
                    <?php
                    $query = 'SELECT * FROM object';
                    $a = pg_query($connection, $query);
                    while($row = pg_fetch_row($a)) {
                      echo "<option value=".$row[0].">".$row[1]."</option>";
                    }
                    ?>
                  </select>
                </div>
              </div>

              <div name="selectSubdivision"></div>

              <div class="row">
                <label for="inputPassword" class="col-sm-2 col-form-label">Телефон</label>
                <div class="col">
                  <div class="form-group" id="subscriberPhone0">
                      <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone0" id="subscriberPhone0" class="form-control form-control-sm" placeholder="Телефон">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group" id="subscriberPhone1">
                      <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone1" id="subscriberPhone1" class="form-control form-control-sm" placeholder="Телефон">
                  </div>
                </div>
                <div class="col">
              <div class="form-group" id="subscriberPhone2">
                  <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone2" id="subscriberPhone2" class="form-control form-control-sm" placeholder="Телефон">
              </div>
              </div>
              <div class="col">
              <div class="form-group" id="subscriberPhone3">
                    <input min="3" max="11" maxlength="11" type="phone" name="subscriberPhone3" id="subscriberPhone3" class="form-control form-control-sm" placeholder="Телефон">
                </div>
              </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10">
                  <button id="subscriber_add_btn" class="btn btn-sm btn-success mb-2"><img src="img/plus-2x.png"> Добавить</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Send message</button>
          </div>
        </div>
      </div>
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
    <script>

    </script>
  </body>
</html>
