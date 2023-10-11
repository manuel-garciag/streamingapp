<div class="card-body p-0">
    <div class="table-responsive">
        <table class="table" id="transactions-table">
            <thead>
                <tr>
                    <th>User Id</th>
                    <th>Qrcode Owner Id</th>
                    <th>Qr Code Id</th>
                    <th>Payment Method</th>
                    <th>Message</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td><a class="btn btn-outline-primary" href="/users/{{ $transaction->user['id'] }}"> {{ $transaction->user['name'] }} </a></td>
                    <td><a class="btn btn-outline-primary" href="/users/{{ $transaction->qrcode_owner['id'] }}"> {{ $transaction->qrcode_owner['name'] }} || {{ $transaction->qrcode_owner['email'] }}</a></td>
                    <td>
                        <a style="width: 100px;" class="btn btn-outline-primary" href="/qrcodes/{{ $transaction->qr_code['id'] }}"> {{ $transaction->qr_code['product_name'] }} </a>
                        <br><img style="width: 100px;" class="border mt-1" src="{{ asset($transaction->qr_code['image_path']) }}">
                    </td>
                    <td>{{ $transaction->payment_method }}</td>
                    <td>{{ $transaction->message }}</td>
                    <td>$. {{ $transaction->amount }}</td>
                    <td>{{ $transaction->status }}</td>
                    <td style="width: 120px">
                        {!! Form::open(['route' => ['transactions.destroy', $transaction->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('transactions.show', [$transaction->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-eye"></i>
                            </a>
                            <a href="{{ route('transactions.edit', [$transaction->id]) }}" class='btn btn-default btn-xs'>
                                <i class="far fa-edit"></i>
                            </a>
                            {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="card-footer clearfix">
        <div class="float-right">
            @include('adminlte-templates::common.paginate', ['records' => $transactions])
        </div>
    </div>
</div>