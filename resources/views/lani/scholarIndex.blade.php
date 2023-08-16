@extends('layouts.base')
@section('body')
@include('layouts.navAdmin')
{{-- @include('designs.scholarstatuscss') --}}
<body>
    {{-- {{ dd($admins) }} --}}
    <h1 style="text-align: center;color: rgb(255,255,255);background: rgb(128,125,125);margin-bottom: 41px;"><br><strong>SCHOLAR&nbsp;LIST</strong><br><br>
    </h1>

@if(Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ Session::get('success') }} <i class="fas fa-check-circle"></i></strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
    <div class="container">
        <div class="row">
            <div class="col-xl-2 offset-xl-0">
                <p><strong>Sort By:</strong></p>
            </div>
<div class="col-xl-3">
<form class="form-inline" action="{{ route('scholarSort') }}" method="post">
    @csrf
  <div class="form-group">
   
     <select  class="form-control" name="label">
         <option></option>
         <option value="scholarId">ID</option>
         <option value="scholarFirstName">Name</option>
         <option value="scholarEmail">Email</option>
         <option value="scholarStatus">Status</option>
      </select>
  </div>
</div>
            <div class="col-lg-3 col-xl-2 offset-lg-1 offset-xl-0">
                <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-1" name="order" value="DESC"><label class="form-check-label" for="formCheck-1"><strong>Descending</strong></label></div>
            </div>
            <div class="col-lg-3 col-xl-2">
                <div class="form-check"><input class="form-check-input" type="radio" id="formCheck-1" name="order" value="ASC"><label class="form-check-label" for="formCheck-1"><strong>Ascending</strong></label></div>
            </div>
            <input type="hidden" name="table" value="scholars">
            <div class="col-lg-2 col-xl-3 offset-lg-0 offset-xl-0"><button class="btn btn-primary" type="submit" style="background: #c7140e;color: rgb(255,255,255);"><strong>SORT</strong></button></div>
        </div>
    </div>
</form>
    <div class="container" style="box-shadow: 0px 0px 20px;margin-top: 40px;margin-bottom: 20px;">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr></tr>
                </thead>
                <tbody>
                @foreach($scholars as $scholar)
                    <tr>
                        <td><strong>ID : </strong>{{ $scholar->scholarId }}</td>
                        <td><strong>Name : </strong>{{ $scholar->scholarFirstName}} {{ $scholar->scholarMiddleName}} {{$scholar->scholarLastName  }}</td>
                        <td><strong>Email : </strong>{{ $scholar->scholarEmail}}</td>

                        <td><strong>Status : </strong><b 
                            @if ( $scholar->scholarStatus == 'joining')
                                style="color: green"
                            @endif
                            @if ( $scholar->scholarStatus == 'renew' ||  $scholar->scholarStatus == 'new')
                                style="color: blue"
                            @endif
                            @if ( $scholar->scholarStatus == 'banned')
                                style="color: red"
                            @endif
                        >@if( $scholar->scholarStatus == 'renew' ||  $scholar->scholarStatus == 'new')
                            Accepted
                         @else
                             {{ $scholar->scholarStatus}}
                         @endif
                    </b>

                            @if( ($scholar->scholarStatus == "Joining" || $scholar->scholarStatus == "banned" ) && ($get_data['adminInfo']['adminStatus'] == 'main') )

                            <a href="{{ route('acceptScholar',$scholar->scholarId) }}" class="badge badge-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Click To Become a Memeber of Admin">Accept Now</a>
                            @endif


                            </td>
                       
                            <td style="text-align: center;">
                            <form action="{{ route('scholar.destroy', $scholar->scholarId) }}" method="post">
                            @csrf
                            @method('DELETE') 
                            <a href="{{ route('showToAdmin',$scholar->scholarId) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View Admin's Profile"><i class="far fa-eye"></i></a>
                @if($get_data['adminInfo']['adminStatus'] == 'main')
                            
                            <a href="{{ route('scholar.edit',$scholar->scholarId) }}" style="margin-left: 5px"><i class="fas fa-edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Admin's Profile"></i></a>
                @endif

                            @if(Session::get('UserMember') == "main" && $scholar->scholarStatus != "banned" )
                            <button type="submit" style="border: none;background-color: inherit;" data-bs-toggle="tooltip" data-bs-placement="top" title="Ban This Admin"><i class="fas fa-user-slash" style="color: #1A7BCB"></i></button>
                            @endif
                            </form>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/6360280a4c.js" crossorigin="anonymous"></script>
</body>
@stop