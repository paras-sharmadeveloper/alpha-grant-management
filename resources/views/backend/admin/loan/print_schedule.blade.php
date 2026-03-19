<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Schedule - {{ $loan->loan_id }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 13px; margin: 30px; color: #222; }
        h2, h4 { text-align: center; margin: 4px 0; }
        p.sub { text-align: center; color: #555; margin: 4px 0 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #1a73e8; color: #fff; padding: 10px 8px; text-align: center; }
        td { padding: 9px 8px; border-bottom: 1px solid #ddd; text-align: center; }
        tr:nth-child(even) td { background: #f5f9ff; }
        .badge { padding: 3px 10px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .paid { background: #d4edda; color: #155724; }
        .unpaid { background: #fff3cd; color: #856404; }
        .due { background: #f8d7da; color: #721c24; }
        .summary { display: flex; gap: 20px; margin-bottom: 20px; }
        .summary-box { flex: 1; background: #D6F2FF; border-radius: 8px; padding: 12px 16px; }
        .summary-box .s-label { font-size: 12px; color: #555; }
        .summary-box .s-value { font-size: 16px; font-weight: 700; margin-top: 4px; }
        @media print {
            .no-print { display: none; }
            body { margin: 10px; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="text-align:right;margin-bottom:15px;">
        <button onclick="window.print()" style="background:#1a73e8;color:#fff;border:none;padding:10px 24px;border-radius:6px;font-size:15px;cursor:pointer;">
            🖨 Print / Save as PDF
        </button>
    </div>

    <h2>{{ get_tenant_option('business_name', request()->tenant->name ?? 'Loan Statement') }}</h2>
    <h4>Loan Repayment Schedule</h4>
    <p class="sub">{{ $loan->borrower->first_name.' '.$loan->borrower->last_name }} &mdash; Loan ID: {{ $loan->loan_id }}</p>

    <div class="summary">
        <div class="summary-box">
            <div class="s-label">Loan Amount</div>
            <div class="s-value">{{ decimalPlace($loan->applied_amount, currency($loan->currency->name)) }}</div>
        </div>
        <div class="summary-box">
            <div class="s-label">Interest Rate</div>
            <div class="s-value">{{ $loan->loan_product->interest_rate }}%</div>
        </div>
        <div class="summary-box">
            <div class="s-label">Term</div>
            <div class="s-value">{{ $loan->loan_product->term }} {{ preg_replace('/^\+\d+\s*/', '', $loan->loan_product->term_period) }}</div>
        </div>
        <div class="summary-box">
            <div class="s-label">Total Paid</div>
            <div class="s-value">{{ decimalPlace($loan->total_paid, currency($loan->currency->name)) }}</div>
        </div>
        <div class="summary-box">
            <div class="s-label">Remaining</div>
            <div class="s-value">{{ decimalPlace($loan->applied_amount - $loan->total_paid, currency($loan->currency->name)) }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>EMI (Amount to Pay)</th>
                <th>Principal (+)</th>
                <th>Interest (-)</th>
                <th>Late Penalty (-)</th>
                <th>Balance</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repayments as $i => $repayment)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $repayment->repayment_date }}</td>
                <td>{{ decimalPlace($repayment->amount_to_pay, currency($loan->currency->name)) }}</td>
                <td style="color:#27ae60;font-weight:600;">
                    +{{ decimalPlace($repayment->principal_amount, currency($loan->currency->name)) }}
                </td>
                <td style="color:#e74c3c;font-weight:600;">
                    -{{ decimalPlace($repayment->interest, currency($loan->currency->name)) }}
                </td>
                <td style="color:#e74c3c;font-weight:600;">
                    {{ $repayment->penalty > 0 ? '-'.decimalPlace($repayment->penalty, currency($loan->currency->name)) : '—' }}
                </td>
                <td>{{ decimalPlace($repayment->balance, currency($loan->currency->name)) }}</td>
                <td>
                    @if($repayment->status == 1)
                        <span class="badge paid">Paid</span>
                    @elseif($repayment->status == 0 && date('Y-m-d') > $repayment->getRawOriginal('repayment_date'))
                        <span class="badge due">Due</span>
                    @else
                        <span class="badge unpaid">Unpaid</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top:30px;font-size:12px;color:#888;text-align:center;">
        Generated on {{ date('d M Y, h:i A') }}
    </p>

</body>
</html>
