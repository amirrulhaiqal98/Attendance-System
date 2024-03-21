<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR SCANNER</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('style.css')}}">
  </head>
  <body>
    
    <div class="container col-lg-4 py-5">
        {{-- scanner --}}
        <div class="card bg-white shadow rounded-3 p-3 border-0">

            {{-- Notification --}}
            @if (session()->has('Fail'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>
                        {{session('Fail')}}
                    </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
           
            @if (session()->has('Success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>
                    {{session('Success')}}
                </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="wrapper">
              <div class="scanner"></div>
              <video id="preview"></video>
            </div>

            {{-- form --}}
            <form action="{{route('store')}}" method="POST" id="form">
                @csrf
                <input type="hidden" name="staff_id" id="staff_id">
            </form>
        </div>

        {{-- scanner --}}
        <div class="table-reponsive mt-5">
            <table class="table table-bordered table-tower">
                <tr>
                    <th>Nama</th>
                    <th>Tarikh</th>
                </tr>

                @foreach ($absence as $item)
                <tr>
                    <td>{{$item->staff->name}}</td>
                    <td>{{$item->date}}</td>
                </tr> 
                @endforeach
            </table>
        </div>
    </div>

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script type="text/javascript">
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview'),  refractoryPeriod: 10000, });
        scanner.addListener('scan', function (content) {
          console.log(content);
        });
        Instascan.Camera.getCameras().then(function (cameras) {
          if (cameras.length > 0) {
            scanner.start(cameras[0]);
          } else {
            console.error('No cameras found.');
          }
        }).catch(function (e) {
          console.error(e);
        });

        scanner.addListener('scan',function(c){
            document.getElementById('staff_id').value= c;
            document.getElementById('form').submit();
        })

      </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>