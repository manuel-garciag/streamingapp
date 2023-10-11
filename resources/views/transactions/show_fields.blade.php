<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p><a class="btn btn-outline-primary" href="/users/{{ $transaction->user['id'] }}"> {{ $transaction->user['name'] }} || {{ $transaction->user['email'] }}</a></p>
</div>

<!-- Qrcode Owner Id Field -->
<div class="col-sm-12">
    {!! Form::label('qrcode_owner_id', 'Qrcode Owner Id:') !!}
    <p><a class="btn btn-outline-primary" href="/users/{{ $transaction->qrcode_owner['id'] }}"> {{ $transaction->qrcode_owner['name'] }} || {{ $transaction->qrcode_owner['email'] }}</a></p>
</div>

<!-- Qr Code Id Field -->
<div class="col-sm-12">
    {!! Form::label('qr_code_id', 'Qr Code Id:') !!}
    <p><a class="btn btn-outline-primary" href="/qrcodes/{{ $transaction->qr_code['id'] }}"> {{ $transaction->qr_code['product_name'] }} </a> </p>
    <p><img src="{{ asset($transaction->qr_code['image_path']) }}" width="150px"></p>
</div>

<!-- Payment Method Field -->
<div class="col-sm-12">
    {!! Form::label('payment_method', 'Payment Method:') !!}
    <p>{{ $transaction->payment_method }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $transaction->message }}</p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>$. {{ $transaction->amount }}</p>
</div>

<!-- Status Field -->
<div class="col-sm-12">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $transaction->status }}</p>
</div>
