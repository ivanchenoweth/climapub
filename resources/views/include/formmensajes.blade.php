@if(Session::has('mensaje'))
    <div 
        style='background-color:#DC7F37; color:#FFFFFF;'
        class="alert alert-success alert-dismissible" role="alert">
        {{Session::get('mensaje')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif
