@extends('layouts.app')

@section('content')
<script src="https://js.stripe.com/v3/"></script>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-header d-flex align-items-center">
                <span class="header-title">{{ _lang('Stripe Payment') }}</span>
                <a href="{{ route('pay.index') }}" class="btn btn-secondary btn-xs ml-auto"><i class="ti-arrow-left"></i> {{ _lang('Back') }}</a>
            </div>
            <div class="card-body">

                <table class="table table-bordered mb-3">
                    <tr><td>{{ _lang('Loan ID') }}</td><td>{{ $loan->loan_id }}</td></tr>
                    <tr><td>{{ _lang('Borrower') }}</td><td>{{ $loan->borrower->first_name }} {{ $loan->borrower->last_name }}</td></tr>
                    <tr><td>{{ _lang('Due Date') }}</td><td>{{ $loan->next_payment->repayment_date }}</td></tr>
                    <tr><td>{{ _lang('Principal') }}</td><td>{{ decimalPlace($loan->next_payment->principal_amount, currency($loan->currency->name)) }}</td></tr>
                    <tr><td>{{ _lang('Interest') }}</td><td>{{ decimalPlace($loan->next_payment->interest, currency($loan->currency->name)) }}</td></tr>
                    @if($late_penalties > 0)
                    <tr><td>{{ _lang('Late Fees') }}</td><td class="text-danger">{{ decimalPlace($late_penalties, currency($loan->currency->name)) }}</td></tr>
                    @endif
                    <tr>
                        <td><strong>{{ _lang('Total') }}</strong></td>
                        <td><strong id="total_display">{{ decimalPlace($totalAmount, currency($loan->currency->name)) }}</strong></td>
                    </tr>
                </table>

                <form action="{{ route('pay.stripe_callback', $loan->id) }}" method="post" id="payment-form">
                    @csrf
                    <input type="hidden" name="late_penalties" id="late_penalties_hidden" value="{{ $late_penalties }}">
                    <input type="hidden" name="total_amount" id="total_amount_hidden" value="{{ $totalAmount }}">

                    <div class="form-group">
                        <label>{{ _lang('Card Details') }}</label>
                        <div id="card-element" class="form-control" style="height:auto;padding:12px 14px;"></div>
                        <div id="card-errors" class="text-danger mt-1" role="alert"></div>
                    </div>

                    <button class="btn btn-danger btn-block mt-3" id="pay_now" type="submit">
                        <i class="fab fa-stripe-s mr-1"></i> {{ _lang('Pay Now') }}
                        <span id="pay_btn_amount">{{ decimalPlace($totalAmount, currency($loan->currency->name)) }}</span>
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>
var stripe = Stripe("{{ $publishable_key }}");
var card   = stripe.elements().create('card', {
    style: { base: { color: '#32325d', fontSize: '16px', '::placeholder': { color: '#aab7c4' } }, invalid: { color: '#fa755a' } },
    hidePostalCode: true
});
card.mount('#card-element');
card.on('change', function(e) { document.getElementById('card-errors').textContent = e.error ? e.error.message : ''; });

document.getElementById('payment-form').addEventListener('submit', function(e) {
    e.preventDefault();
    document.getElementById('pay_now').disabled = true;
    stripe.createToken(card).then(function(result) {
        if (result.error) {
            document.getElementById('card-errors').textContent = result.error.message;
            document.getElementById('pay_now').disabled = false;
        } else {
            var input = document.createElement('input');
            input.type = 'hidden'; input.name = 'stripeToken'; input.value = result.token.id;
            document.getElementById('payment-form').appendChild(input);
            document.getElementById('payment-form').submit();
        }
    });
});
</script>
@endsection
