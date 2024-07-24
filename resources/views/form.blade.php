<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Mail Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="m-5 justify-content-center conatiner">
        <h1 class="text-center card-title">Send Mail Form</h1>
        @if (Session::has('success'))
            <div class="p-2 alert alert-success">{{Session::get('success')}}</div>            
        @endif
        @if (Session::has('error'))
            <div class="p-2 alert alert-danger">{{Session::get('error')}}</div>            
        @endif
        <form action="{{ route('send') }}" method="post">
            @csrf
            <div class="my-4 form-group">
                <label for="">Title</label>
                <input type="text" placeholder="Enter Email Title" name="title" class="form-control">
                <span class="text-danger">
                    @error('title')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="my-4 form-group">
                <label for="">Reciever Email</label>
                <input type="email" placeholder="Enter Reciever Email" name="email" class="form-control">
                <span class="text-danger">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="my-4 form-group">
                <label for="">Mail Body</label>
                <input type="text" placeholder="Enter Email Body" name="body" class="form-control">
                <span class="text-danger">
                    @error('body')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="my-4 form-group">
                <label for="">Mail Footer</label>
                <input type="text" placeholder="Enter Email Footer" name="footer" class="form-control">
                <span class="text-danger">
                    @error('footer')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <button type="submit" class="p-2 mt-3 w-100 btn btn-primary btn-sm">Send</button>
        </form>
    </div>
</body>

</html>
