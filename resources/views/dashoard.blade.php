<!DOCTYPE html>
<html lang="en">
<head>
  <title>DEMO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
           
            
            <table class="table table-bordered">

                @for ($i = 0; $i < count($data["data"]); $i++)
                <tr>
                    <td>{{ $data["data"][$i]["id"] }}</td>
                    <td>{{ $data["data"][$i]["first_name"] }} {{ $data["data"][$i]["last_name"] }}</td>
                </tr>
            @endfor

            </table>
            @if ($data["meta"]["current_page"] > 1)
            <a href="http://127.0.0.1:8000/dashboard-users?per_page=5&page={{ $data["meta"]["current_page"] - 1}}">{{ $data["meta"]["current_page"] - 1}}</a>
            @endif
            <a href="http://127.0.0.1:8000/dashboard-users?per_page=5&page={{ $data["meta"]["current_page"]}}">{{ $data["meta"]["current_page"]}}</a>
            <a href="http://127.0.0.1:8000/dashboard-users?per_page=5&page={{ $data["meta"]["next_page"]}}">{{ $data["meta"]["next_page"]}}</a>
        </div>
    </div>
</div>

</body>
</html>
