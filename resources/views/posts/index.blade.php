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
            <a class="navbar-brand" href="{{ route('post.index') }}">Admin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('post.index') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('post.create') }}">Create</a>
                </li>
               
              </ul>
            </div>
        </nav>

        <form method="post" action="" enctype="multipart/form-data" >
            @csrf
            <div class="row">
                <div class="col">
              <input type="file" name="excel" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter a Name">
                </div>

                <div class="col">
            <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </div>
            @error('excel')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
        </form>

{{-- <object width="425" height="350" data="http://www.youtube.com/v/Ahg6qcgoay4" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/Ahg6qcgoay4" /></object> --}}

<iframe width="420" height="315"
src="{{ $fullurl }}">
</iframe>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Image</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post )
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td><img src="{{ $post->image }}" alt="no image" height="100" width="100"></td>
                    <td style="display:flex">  <a href="{{ route('post.edit', $post) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('download', $post) }}" class="btn btn-default">Download</a>
                    <form action="{{ route('post.destroy', $post) }}" method="post">
                        @csrf
                        @method('delete')
                    <button class="btn btn-danger" onClick="return confirm('Are you sure ? ')" type="submit">Delete</button>
                    </form>
                </tr>    
                @empty
                    
                @endforelse
                
               
            </tbody>
          </table>

    </div>
   
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>