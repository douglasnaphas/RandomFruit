@extends('dashlayout')

{{-- app/views/instructordash.blade.php: Default view for instructors --}}
@section('title')
Instructor Dash
@stop

@section('page_header')
Dashboard
@stop

@section('content')
    <div class="row placeholders">
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/sky" class="img-responsive"
                 alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/vine" class="img-responsive"
                 alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/sky" class="img-responsive"
                 alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-6 col-sm-3 placeholder">
            <img data-src="holder.js/200x200/auto/vine" class="img-responsive"
                 alt="Generic placeholder thumbnail">
            <h4>Label</h4>
            <span class="text-muted">Something else</span>
        </div>
    </div>

    <h2 class="sub-header">Owned Tickets</h2>

    <?php
        $user = Auth::user();
        $con = mysqli_connect('localhost','root', 'root', 'RandomFruit') or die(mysqli_error());
        $sqlstmt = "SELECT * FROM tickets WHERE owner_id='".$user->id."'";
        $result = mysqli_query($con, $sqlstmt);
        
        
        while($row = mysqli_fetch_array($result)){
            $num = $row['number'];
            $title = $row['title'];
            $desc = $row['description'];
            $ph = $row['planned_hours'];
            $ah = $row['actual_hours'];
            
        }
    ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                    <th>Ticket #</th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Planned</th>
                    <th>Actual</th>
            </tr>
            </thead>
            <tbody>
            <?php
            echo "<tr>
                    <td>".$num."</td>
                    <td>".$title."</td>
                    <td>".$user->username."</td>
                    <td>".$user->username."</td>
                    <td>".$desc."</td>
                    <td>".$ph."</td>
                    <td>".$ah."</td>
                  </tr>"
            ?>            
            </tbody>
        </table>
    </div>
</div>
@stop

