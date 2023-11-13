<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p><a class="btn btn-outline-primary" href="/users/{{ $qrcode->user['id'] }}"> {{ $qrcode->user['name'] }}</a></p>
</div>

<!-- Website Field -->
<div class="col-sm-12">
    {!! Form::label('website', 'Website:') !!}
    <p><a href="{{ $qrcode->website }}" target="_blank" rel="noopener noreferrer">{{ $qrcode->website }}</a></p>
</div>

<!-- Company Name Field -->
<div class="col-sm-12">
    {!! Form::label('company_name', 'Company Name:') !!}
    <p>{{ $qrcode->company_name }}</p>
</div>

<!-- Product Name Field -->
<div class="col-sm-12">
    {!! Form::label('product_name', 'Product Name:') !!}
    <p>{{ $qrcode->product_name }}</p>
</div>

<!-- Product Url Field -->
<div class="col-sm-12">
    {!! Form::label('product_url', 'Product Url:') !!}
    <p><a href="{{ $qrcode->product_url }}" target="_blank" rel="noopener noreferrer">{{ $qrcode->product_url }}</a></p>
</div>

<!-- Image Path Field -->
<div class="col-sm-12">
    {!! Form::label('image_path', 'Image Path:') !!}
    <p><img src="{{ asset($qrcode->image_path) }}" width="150px"></p>
</div>

<!-- Callback Url Field -->
<div class="col-sm-12">
    {!! Form::label('callback_url', 'Callback Url:') !!}
    <p><a href="{{ $qrcode->callback_url }}" target="_blank" rel="noopener noreferrer">{{ $qrcode->callback_url }}</a></p>
</div>

<!-- Qrcode Path Field -->
<div class="col-sm-12">
    {!! Form::label('qrcode_path', 'Qrcode Path:') !!}
    <p><img src="{{ asset($qrcode->qrcode_path) }}"></p>
</div>

<!-- Amount Field -->
<div class="col-sm-12">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $qrcode->amount }}</p>
</div>

<!-- Paypal -->
<div class="col-sm-12">
    <h3>Paypal</h3>
    <form action="{{route('payment')}}" method="post">
        <br>
        @csrf <!-- protección contra ataques de falsificación de solicitudes entre sitios (CSRF).-->
        <!-- <input type="hidden" name="amount" value="{{ $qrcode->amount }}"> -->
        <button type="submit">Paypal</button>
    </form>
</div>

<!-- Transactions -->

<div class="col-sm-12">
    <hr>
    <h2>Transaciones</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Transactions Id</th>
                <th>Amount</th>
                <th>Payment Method</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($qrcode->transactions as $transaction)
            <tr>
                <td> <a href="/transactions/{{ $transaction->id }}">{{ $transaction->id }}</a></td>
                <td>${{ $transaction->amount }}</td>
                <td>{{ $transaction->payment_method }}</td>
                <td>{{ $transaction->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>