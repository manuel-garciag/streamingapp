<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $user->name }}</p>
</div>

<!-- Email Field -->
<div class="col-sm-12">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $user->email }}</p>
</div>

<!-- Rol Id Field -->
<div class="col-sm-12">
    {!! Form::label('rol_id', 'Rol Id:') !!}
    <p><a class="btn btn-outline-primary" href="/roles/{{ $user->rol['id'] }}">{{ $user->rol['name'] }}</a></p>
</div>

<!-- Transactions -->

<div class="col-sm-12">
    <hr>
    <h2>Transaciones</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Transactions Id</th>
                <th>Product</th>
                <th>Product Image</th>
                <th>Amount</th>
                <th>QR Owner</th>
            </tr>
        </thead>
        <tbody>
            @php
            $amountAll = 0;
            @endphp
            @foreach ($user->transactions as $transaction)
            <tr>
                <td> <a class="btn btn-outline-primary" href="/transactions/{{ $transaction->id }}">{{ $transaction->id }}</a></td>
                <td>
                    <p><a class="btn btn-outline-primary" href="/qrcodes/{{ $transaction->qr_code['id'] }}"> {{ $transaction->qr_code['product_name'] }} </a> </p>
                </td>
                <td>
                    <p><img src="{{ asset($transaction->qr_code['image_path']) }}" width="150px"></p>
                </td>
                <td>$. {{ $transaction->amount }}</td>
                @php
                $amountAll = $transaction->amount + $amountAll;
                @endphp
                <td>
                    <p><a class="btn btn-outline-primary" href="/users/{{ $transaction->qrcode_owner['id'] }}"> {{ $transaction->qrcode_owner['name'] }} || {{ $transaction->qrcode_owner['email'] }}</a></p>
                </td>
            </tr>

            @endforeach
        </tbody>
        <tfoot>
            <th colspan="3">Total</th>
            <th>$. {{ $amountAll }}</th>
            <th></th>
        </tfoot>
    </table>
</div>


<!-- QRCodes -->

<div class="col-sm-12">
    <hr>
    <h2>QRCodes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>QRCode Id</th>
                <th>Product</th>
                <th>Product Image</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user->qr_code as $qrcode)
            <tr>
                <td> <a class="btn btn-outline-primary" href="/qrcodes/{{ $qrcode->id }}">{{ $qrcode->id }}</a></td>
                <td><a class="btn btn-outline-primary" href="/qrcodes/{{ $qrcode->id }}"> {{ $qrcode->product_name }}</a></td>
                <td>
                    <p><img src="{{ asset($qrcode->image_path) }}" width="150px"></p>
                </td>
                <td>{{ $qrcode->amount }}</td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>