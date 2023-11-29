<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
    <div class="container pt-3">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('user.index') }}">Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('user.index') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('user.create') }}">Create</a>
                </li>
               
              </ul>
            </div>
        </nav>
<div class="pt-10">

    @if (session()->has('import_errors'))
    @foreach (session()->get('import_errors') as $failure )
        <span class="alert alert-danger">
            {{ $failure->errors()[0] }} at line no - {{ $failure->row() }}
        </span>
    @endforeach
@endif
</div>

        <form method="post" action="{{ route('uploadExcel') }}" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col">
              <input type="file" name="excel_sheet" class="form-control" >
                </div>

                <div class="col">
            <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
            @error('excel_sheet')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </form>

        <a href="{{ route('downloadExcel') }}">Download Excel file</a>
        <a href="{{ route('user.download') }}">Download PDF</a>

     <form action="{{ route('user.store') }}" method="post">
      @csrf
      <div class="form-group">
        <label for="exampleInputEmail1"> Name</label>
        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a Name">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a Name">
      </div>

      <div class="form-group">
        <label for="exampleInputEmail1">Password</label>
        <input type="password" name="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a Name">
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
     </form>

    </div>
   
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>