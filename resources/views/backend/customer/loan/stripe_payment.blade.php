@extends('layouts.app')

@section('content')
<script src="https://js.stripe.com/v3/"></script>

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <span class="header-title text-center">{{ _lang('Pay Loan Repayment via Stripe') }}</span>
            </div>
            <div class="card-body">
                <table class="table table-bordered mb-4">
                    <tr>
                        <td>{{ _lang('Loan ID') }}</td>
                        <td>{{ $loan->loan_id }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Due Date') }}</td>
                        <td>{{ $loan->next_payment->repayment_date }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Principal Amount') }}</td>
                        <td>{{ decimalPlace($loan->next_payment->principal_amount, currency($loan->currency->name)) }}</td>
                    </tr>
                    <tr>
                        <td>{{ _lang('Interest') }}</td>
                        <td>{{ decimalPlace($loan->next_payment->interest, currency($loan->currency->name)) }}</td>
                    </tr>
                    @if($late_penalties > 0)
                    <tr>
                        <td>{{ _lang('Late Penalties') }}</td>
                        <td class="text-danger">{{ decimalPlace($late_penalties, currency($loan->currency->name)) }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td><strong>{{ _lang('Total Amount') }}</strong></td>
                        <td><strong>{{ decimalPlace($totalAmount, currency($loan->currency->name)) }}</strong></td>
                    </tr>
                </table>

                <form action="{{ route('loans.stripe_callback', $loan->id) }}" method="post" id="payment-form">
                    @csrf
                    <div class="form-group">
                        <label>{{ _lang('Card Details') }}</label>
                        <div id="card-element" class="form-control" style="height: auto; padding: 12px 14px;"></div>
                        <div id="card-errors" class="text-danger mt-1" role="alert"></div>
                    </div>
                    <button class="btn btn-primary btn-block mt-3" id="pay_now" type="submit">
                        <i class="ti-credit-card mr-1"></i> {{ _lang('Pay Now') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>
var stripe   = Stripe("{{ $publishable_key }}");
var elements = stripe.elements();
var style    = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': { color: '#aab7c4' }
    },
    invalid: { color: '#fa755a', iconColor: '#fa755a' }
};

var card = elements.create('card', { style: style, hidePostalCode: true });
card.mount('#card-element');

card.on('change', function(event) {
    document.getElementById('card-errors').textContent = event.error ? event.error.message : '';
});

document.getElementById('payment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    document.getElementById('pay_now').disabled = true;

    stripe.createToken(card).then(function(result) {
        if (result.error) {
            document.getElementById('card-errors').textContent = result.error.message;
            document.getElementById('pay_now').disabled = false;
        } else {
            var form        = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', result.token.id);
            form.appendChild(hiddenInput);
            form.submit();
        }
    });
});
</script>
@endsection
