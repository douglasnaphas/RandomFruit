<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Tickets - Random Fruit</title>

    <!-- Bootstrap core CSS -->
    <link href="includes/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="includes/css/vtickets.css" rel="stylesheet">
    <link href="includes/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Include navigation top bar and side bar -->
<?php
include('includes/dashnav.php');
?>

<!-- Begin main content -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         <h1 class="page-header">View Tickets</h1>

         
            <div class="vcontain">
                <form class="form" role="form" method="post">
                    <div class="form-group">
                     <label for="ticket-search">Search</label>
                     <input type="search" class="form-control" placeholder="Enter Ticket Search Parameters" id="ticket-search">
                    </div>
                     <div class="form-inline">
                     <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="blocker">Task #
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="critical">Subject
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="major">Reporter
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="minor">Description
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="trivial">Type
                        </label>
                         <label class="btn btn-primary">
                             <input type="radio" name="options" id="trivial">Priority
                         </label>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary">Search</button>
                    </div>
                    </div>
                </form>
                <div class="table-responsive">
                <table class="table table-striped">
                <thead>
                <tr>
                    <th>Task #</th>
                    <th>Subject</th>
                    <th>Reporter</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Priority</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td><a href="">Draft 1</a></td>
                    <td>Rob</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><a href="">Draft 2</a></td>
                    <td>Rob</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><a href="">Draft 3</a></td>
                    <td>Rob</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td><a href="">Draft 4</a></td>
                    <td>Margret</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td><a href="">Draft 5</a></td>
                    <td>Margret</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td><a href="">Draft 6</a></td>
                    <td>Margret</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td><a href="">Draft 7</a></td>
                    <td>Margret</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td><a href="">Draft 8</a></td>
                    <td>Mike</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td><a href="">Draft 9</a></td>
                    <td>Mike</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td><a href="">Draft 10</a></td>
                    <td>Mike</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td><a href="">Draft 11</a></td>
                    <td>Mike</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td><a href="">Draft 12</a></td>
                    <td>Cody</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td><a href="">Draft 13</a></td>
                    <td>Cody</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td><a href="">Draft 14</a></td>
                    <td>Cody</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td><a href="">Draft 15</a></td>
                    <td>Sasha</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td><a href="">Draft 16</a></td>
                    <td>Sasha</td>
                    <td>.......</td>
                    <td>Task</td>
                    <td>Minor</td>
                </tr>
                </tbody>
            </table>    
        </div>
     </div>
</div>
<!-- End main content -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="includes/js/bootstrap.min.js"></script>
<script src="../../assets/js/docs.min.js"></script>
</body>
</html>
