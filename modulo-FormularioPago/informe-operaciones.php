<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Informe de operaciones</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a href="#" class="navbar-brand"> Buscador Informe</a>
    <ul class="navbar-nav ml-auto">
        <ul class="navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0">
              <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-success my-2 my-sm-0" type="submit">
                Search
            </button>
            </form>
    </ul>
        
    </nav>





    <div class="container p-4 ">

        <div class="row">

            <div class="col-md-7" >

                <table class="table table-striped " border="2" >
                <tr>
                <th>Operaciones </th><td>Cantidad</td><td>Total</td>
                </tr>
                    <tbody id="informe-operaciones">

                    </tbody>
                </table>

            </div>
    
        </div>

    </div>




    <script src="https://code.jquery.com/jquery-3.6.1.min.js" 
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="pagos.js"> </script>
</body>

</html>