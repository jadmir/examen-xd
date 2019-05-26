<!doctype html>
<html lang="en">
  <head>
    <title>Practica 1</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <?php require_once 'proceso.php'; ?>

      <?php
      if (isset($_SESSION['message'])): ?>

      <div class="alert alert-<?=$_SESSION['msg_type']?>">

        <?php
          echo $_SESSION['message'];
          unset($_SESSION['message']);
        ?>
      </div>
      <?php endif ?>
      <div class="container">
      <?php
        $mysqli = new mysqli('localhost', 'root', '', 'prueba') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM producto") or die($mysqli->error);
        //pre_r($result); 
       
        ?>
          <div class="row justify-content-center">
            <table class="table">
              <thead>
                <tr>
                  <th>Codigo</th>
                  <th>Descripcion</th>
                  <th>Precio</th>
                  <th>Existencia</th>
                  <th colspan="2">Action</th>
                </tr>
              </thead>

              <?php
                while ($row = $result->fetch_assoc()): ?>
              
                <tr>
                  <td><?php echo $row['Codigo']; ?></td>
                  <td><?php echo $row['Descripcion']; ?></td>
                  <td><?php echo $row['Precio']; ?></td>
                  <td><?php echo $row['Existencia']; ?></td>
                  <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class="btn btn-info">Editar</a>
                    <a href="proceso.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">Eliminar</a>
                  </td>
                </tr>
                <?php endwhile; ?>
            </table>
          </div>
        <?php

        function pre_r( $array) {
          echo '<pre>';
          print_r($array);
          echo '</pre>'; 
        }
      ?>

      <div class="row justify-content-center">
        <form action="proceso.php" method="POST"> 
          <input type="hidden" name="id" value="<?php echo $id; ?>">         
          <div class="form-group">
            <label>Codigo</label>
            <input type="text" name="Codigo" class="form-control" 
            value ="<?php echo $Codigo; ?>" placeholder="Codigo">
          </div>
          <div class="form-group">
            <label>Descripcion</label>
            <input type="text" name="Descripcion" class="form-control" 
                    value ="<?php echo $Descripcion; ?>" placeholder="Descripcion">
          </div>          
          <div class="form-group">
            <label>Precio</label>
            <input type="text" name="Precio" class="form-control" 
                    value ="<?php echo $Precio; ?>" placeholder="Precio">
          </div>
          <div class="form-group">
            <label>Existencia</label>
            <input type="text" name="Existencia" class="form-control" 
                    value ="<?php echo $Existencia; ?>"placeholder="Existencia">
          </div>
          <div class="form-group">
            <?php
            if ($update == true):
            ?>
            <button type="submit" class="btn btn-primary" name="update">Update</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="Guardar">Guardar</button>
            <?php endif; ?>
          </div>

        </form>
      </div>
      </div>











    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>