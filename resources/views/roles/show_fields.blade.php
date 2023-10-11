<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $roles->name }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $roles->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $roles->updated_at }}</p>
</div>

<!-- Users -->

<div class="col-sm-12">
    <hr>
    <h2>Usuarios</h2>
    <table class="table">
        <thead>
            <tr>
                <th>User Id</th>
                <th>Nombre</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles->user as $user)
            <tr>
                <td> <a class="btn btn-outline-primary" href="/user/{{ $user->id }}">{{ $user->id }}</a></td>
                <td><a class="btn btn-outline-primary" href="/users/{{ $user->id }}"> {{ $user->name }}</a></p></td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>