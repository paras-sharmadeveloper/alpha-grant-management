@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <span class="panel-title">{{ _lang('Pay Loan') }}</span>
            </div>
            <div class="card-body">

                {{-- Search --}}
                <div class="form-group">
                    <label style="font-family:Poppins,sans-serif;font-size:14px;">{{ _lang('Search by Loan ID') }}</label>
                    <input type="text" id="pay_search_input" class="form-control"
                           placeholder="{{ _lang('Type loan ID...') }}" autocomplete="off">
                </div>

                <div id="pay_search_results" class="mt-3"></div>

                {{-- Default: show all active loans --}}
                <div id="pay_all_loans">
                    @forelse($loans as $loan)
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                        <div>
                            <div style="font-family:Poppins,sans-serif;font-size:14px;font-weight:500;color:#214942;">
                                {{ $loan->loan_id }}
                            </div>
                            <div style="font-family:Poppins,sans-serif;font-size:12px;color:#888;margin-top:4px;">
                                {{ _lang('Next Due') }}: {{ $loan->next_payment ? $loan->next_payment->repayment_date : '—' }}
                                &nbsp;|&nbsp;
                                {{ _lang('Outstanding') }}: {{ decimalPlace(($loan->applied_amount - $loan->total_paid), currency($loan->currency->name)) }}
                            </div>
                        </div>
                        <a href="{{ route('loans.stripe_payment', $loan->id) }}"
                           class="btn btn-danger btn-sm">
                            <i class="fab fa-stripe-s mr-1"></i> {{ _lang('Pay via Stripe') }}
                        </a>
                    </div>
                    @empty
                    <p class="text-center text-muted mt-3" style="font-family:Poppins,sans-serif;font-size:14px;">
                        {{ _lang('No active loans found.') }}
                    </p>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('js-script')
<script>
(function ($) {
    var timer;
    $('#pay_search_input').on('input', function () {
        clearTimeout(timer);
        var q = $(this).val().trim();

        if (q.length === 0) {
            $('#pay_search_results').html('');
            $('#pay_all_loans').show();
            return;
        }

        $('#pay_all_loans').hide();
        timer = setTimeout(function () {
            $.get('{{ route("customer.pay.search") }}', { q: q }, function (data) {
                if (!data.length) {
                    $('#pay_search_results').html(
                        '<p class="text-muted text-center" style="font-family:Poppins,sans-serif;font-size:14px;">{{ _lang("No active loans found.") }}</p>'
                    );
                    return;
                }
                var html = '';
                $.each(data, function (i, loan) {
                    html += '<div class="d-flex justify-content-between align-items-center py-3 border-bottom">'
                        + '<div>'
                        + '<div style="font-family:Poppins,sans-serif;font-size:14px;font-weight:500;color:#214942;">' + loan.loan_id + '</div>'
                        + '<div style="font-family:Poppins,sans-serif;font-size:12px;color:#888;margin-top:4px;">'
                        + '{{ _lang("Next Due") }}: ' + (loan.next_due_date || '—')
                        + ' &nbsp;|&nbsp; {{ _lang("Outstanding") }}: ' + loan.currency + ' ' + parseFloat(loan.outstanding).toFixed(2)
                        + '</div>'
                        + '</div>'
                        + '<a href="' + loan.stripe_url + '" class="btn btn-danger btn-sm">'
                        + '<i class="fab fa-stripe-s mr-1"></i> {{ _lang("Pay via Stripe") }}'
                        + '</a>'
                        + '</div>';
                });
                $('#pay_search_results').html(html);
            });
        }, 300);
    });
})(jQuery);
</script>
@endsection
