@extends('app')
@section('content')
        {!! Form::model($user, array('route' => array('user.update', $user->id), 'enctype' => 'multipart/form-data' ,'method'  => 'PUT')) !!}
        {!! Form::token() !!}
        <div class="form-group">
            {!! Form::label('name', 'Ім\'я користувача') !!}
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            <div class="panel panel-orange" id="vimg">
                @if(Auth::user()->avatar and File::exists(public_path('image/user/' . Auth::user()->id .'/avatar/'. Auth::user()->avatar)))
                    {!! Html::image( 'image/user/' . Auth::user()->id .'/avatar/'. Auth::user()->avatar, 'logo',
                    array('id' => 'vacImg', 'width' => '100%', 'height' => '100%')) !!}
                @else
                    {!! Html::image('image/m.jpg', 'logo', array('id' => 'vacImg', 'width' => '100%', 'height' => '100%')) !!}
                @endif
            </div>
        </div>

        <div class="form-group {{$errors-> has('avatar') ? 'has-error' : ''}}">
            <button id="but" type="button" onclick="document.getElementById('avatar').click()" onchange="">Виберіть фото</button>
            <div id="filename">
                {{ trans('form.unselected') }}
            </div>
            {!! Form::file('avatar', array( 'id'=>'avatar', 'style'=>'display:none', 'accept'=>'.jpg, .jpeg, .gif, .png')) !!}

            <div class="form-group">
                {!! $errors->first('avatar', '<span class="help-block">:message</span>') !!}
            </div>
        </div>

        <input type="hidden" name="fcoords" class="coords" id="coords" value="">
        <input type="hidden" name="fname" value="{{}}">

        <div class="form-group">
            {!! Form::submit(trans('main.save'), ['class' => 'btn btn-success']) !!}
        </div>
        {!! Form::close() !!}

        <div id="imageBox" class="modal fade">
            @include('newDesign.cropModal')
        </div>
        {!!Html::script('js/crop.js')!!}
        <script>
            $(document).ready(function () {
                var cloneInputFile = $('#avatar').clone();
                $('#avatar').on('change', function(e) {
                    if(document.getElementById('avatar').value) {
                        cloneInputFile = $('#avatar').clone();
                        $('#imageBox').modal({
                            show: true,
                            backdrop: 'static'
                        });
                        crop(e, 'img-src', '#crop', '#imageBox');
                    } else {
                        $('#avatar').replaceWith(cloneInputFile);
                    }
                    document.getElementById('filename').innerHTML = document.getElementById('avatar').value;
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $('#description').text($('.change_description').html());
            })
        </script>
@endsection
@section('footer')

@stop
