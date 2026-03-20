<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        /* Header link */
        .top-link {
            text-align: center;
            padding: 15px;
            color: #1a73e8;
            font-weight: 600;
        }

        /* Tabs */
        .tabs {
            display: flex;
            justify-content: center;
            gap: 80px;
            border-bottom: 1px solid #ddd;
            background: #fff;
        }

        .tab {
            padding: 15px;
            cursor: pointer;
            color: #333;
            font-size: 18px;
        }

        .tab.active {
            color: #1a73e8;
            border-bottom: 3px solid #1a73e8;
            font-weight: 600;
        }

        /* Content */
        .tab-content {
            display: none;
            width: 80%;
            margin: 20px auto;
        }

        .tab-content.active {
            display: block;
        }

        /* TRANSACTIONS */
        .transaction {
            padding: 15px 0;
            border-bottom: 1px solid #5c5c5c;
            display: flex;
            justify-content: space-between;
        }

        .left {
            display: flex;
            flex-direction: column;
        }

        .date {
            font-size: 14px;
            font-weight: 600;
        }

        .title {
            font-size: 18px;
            margin-top: 8px;
        }

        .amount {
            font-weight: 800;
        }

        .positive {
            color: #000;
        }

        .negative {
            color: #000;
        }

        /* STATEMENTS (reuse previous) */
        .info {
            background: #DEF6E6;
            color: #203422;
            padding: 14px 30px 15px 30px;
            border-radius: 30px;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: 500;
        }

        .card {
            background: #E5F6FE;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
        }

        .btn {
            background: #0060ED;
            color: #fff;
            border: none;
            padding: 20px;
            width: 100%;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
            font-weight: 600;
            font-size: 19px;
        }

        .statement {
            display: flex;
            justify-content: space-between;
            padding: 14px 3px;
            border-bottom: 1px solid #3d3d3d;
            font-size: 18px;
        }

        .refresh {
            color: #0158C3;
            cursor: pointer;
            font-weight: 600;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 25px;
        }

        .nav {
            font-size: 18px;
            color: #aaa;
            cursor: pointer;
            font-weight: 600;
        }

        .nav:hover {
            color: #1a73e8;
        }

        .nav.disabled {
            opacity: 0.4;
            cursor: not-allowed;
        }

        .page {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #1a73e8;
            color: #fff;
            font-weight: 700;
            font-size: 18px;
        }

        /* summery section start  */
        /* Top link */
        .info-link {
            text-align: center;
            color: #1a73e8;
            font-weight: 700;
            margin: 20px 0 35px;
            cursor: pointer;
            font-size: 20px;
        }

        /* Card */
        .summary-card {
            width: 80%;
            margin: 0 auto 25px;
            background: #D6F2FF;
            border-radius: 10px;
            padding: 25px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Items */
        .summary-item {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .label {
            font-size: 14px;
            color: #1f2d3d;
        }

        .value {
            font-size: 20px;
            font-weight: 700;
            color: #000;
        }

        /* Divider */
        .divider {
            width: 1px;
            height: 50px;
            background: #111f28;
            margin-right: 30px;
        }

        /* summery section end */

        /* loan section started */
        .details-section {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
        }

        /* Row */
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 18px 0;
            border-bottom: 1px solid #434343;
        }

        /* Left text */
        .label {
            color: #2c3e50;
            font-size: 18px;
        }

        /* Right value */
        .value {
            font-weight: 800;
            font-size: 18px;
            color: #0b1f3a;

        }

        /* =========================
   RESPONSIVE DESIGN
========================= */

/* Tablet (768px and below) */
@media (max-width: 768px) {

    .tab-content,
    .details-section {
        width: 95%;
    }

    .tabs {
        gap: 30px;
    }

    .tab {
        font-size: 16px;
        padding: 12px 5px;
    }

    .summary-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }

    .divider {
        display: none;
    }

    .summary-item {
        width: 100%;
    }

    .transaction {
        gap: 5px;
    }

    .amount {
        align-self: flex-end;
    }

    .detail-row {
        font-size: 16px;
    }

    .label,
    .value {
        font-size: 16px;
    }

    .info-link {
        font-size: 18px;
        padding: 0 10px;
        text-align: center;
    }
}


/* Mobile (480px and below) */
@media (max-width: 480px) {

    body {
        font-size: 14px;
    }

    .tabs {
        flex-direction: column;
        gap: 0;
        border-bottom: none;
    }

    .tab {
        text-align: center;
        border-bottom: 1px solid #ddd;
        font-size: 15px;
    }

    .tab.active {
        border-bottom: 2px solid #1a73e8;
    }

    .top-link {
        font-size: 14px;
        padding: 10px;
    }

    .transaction {
        padding: 12px 0;
    }

    .title {
        font-size: 16px;
    }

    .date {
        font-size: 13px;
    }

    .amount {
        font-size: 15px;
    }

    .card {
        padding: 15px;
    }

    .btn {
        padding: 14px;
        font-size: 16px;
    }

    .statement {


        font-size: 14px;
    }

    .pagination {
        gap: 6px;
    }

    .page {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }

    .nav {
        font-size: 16px;
    }

    .details-section {
        padding: 10px;
    }

    .detail-row {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
}

        /* loan section ended */
    </style>
</head>

<body>


    <!-- Loan details Start -->
    <div class="details-section">

        <div class="detail-row">
            <span class="label">Loan amount</span>
            <span class="value">$32,595.00</span>
        </div>

        <div class="detail-row">
            <span class="label">Interest rate</span>
            <span class="value">23.99%</span>
        </div>

        <div class="detail-row">
            <span class="label">Loan term</span>
            <span class="value">7 years</span>
        </div>

        <div class="detail-row">
            <span class="label">Loan start date</span>
            <span class="value">29/08/2025</span>
        </div>

        <div class="detail-row">
            <span class="label">Loan end date</span>
            <span class="value">29/08/2032</span>
        </div>

        <div class="detail-row">
            <span class="label">Loan purpose</span>
            <span class="value">Home improvements</span>
        </div>

    </div>

    <!-- Loan details end -->




    <!-- Info Link -->
    <div class="info-link">
        ⓘ <span style="border-bottom: 2px solid #33567A;padding-bottom: 2px;">Learn about repaying your loan in full</span>
    </div>

    <!-- Summary Card -->
    <div class="summary-card">

        <div class="summary-item">
            <span class="label">Next payment due date</span>
            <span class="value">29 Mar 2026</span>
        </div>

        <div class="divider"></div>

        <div class="summary-item">
            <span class="label">Min. monthly repayment</span>
            <span class="value">$820.62</span>
        </div>

        <div class="divider"></div>

        <div class="summary-item">
            <span class="label">Overdue amount</span>
            <span class="value">$0.00</span>
        </div>

    </div>



    <div class="top-link">📄 Update your direct debit payment</div>

    <!-- Tabs -->
    <div class="tabs">
        <div class="tab active" onclick="openTab('transactions')">Transactions</div>
        <div class="tab" onclick="openTab('details')">Details</div>
        <div class="tab" onclick="openTab('statements')">Statements</div>
    </div>

    <!-- TRANSACTIONS -->
    <div id="transactions" class="tab-content active">

        <div class="transaction">
            <div class="left">
                <span class="date">Sat, 28 Feb 2026</span>
                <span class="title">Reschedule</span>
            </div>
            <div class="amount">0.00</div>
        </div>

        <div class="transaction">
            <div class="left">
                <span class="date">Sat, 28 Feb 2026</span>
                <span class="title">Loan repayment Direct Debit</span>
            </div>
            <div class="amount positive">+$820.62</div>
        </div>

        <div class="transaction">
            <div class="left">
                <span class="date">Sat, 28 Feb 2026</span>
                <span class="title">Interest Charged</span>
            </div>
            <div class="amount negative">-$627.44</div>
        </div>

        <div class="transaction">
            <div class="left">
                <span class="date">Sat, 28 Feb 2026</span>
                <span class="title">Loan Service Fee</span>
            </div>
            <div class="amount negative">-$16.50</div>
        </div>

        <div class="transaction">
            <div class="left">
                <span class="date">Thu, 29 Jan 2026</span>
                <span class="title">Loan repayment Direct Debit</span>
            </div>
            <div class="amount positive">+$820.62</div>
        </div>

        <div class="transaction">
            <div class="left">
                <span class="date">Thu, 29 Jan 2026</span>
                <span class="title">Interest Changed</span>
            </div>
            <div class="amount positive">-$651.47</div>
        </div>

        <div class="transaction">
            <div class="left">
                <span class="date">Thu, 29 Jan 2026</span>
                <span class="title">Loan Service Fee</span>
            </div>
            <div class="amount positive">-$16.50</div>
        </div>

        <div class="transaction">
            <div class="left">
                <span class="date">Mon, 29 Jan 2025</span>
                <span class="title">Loan repayment Direct Debit</span>
            </div>
            <div class="amount positive">+$820.62</div>
        </div>

    </div>

    <!-- DETAILS (EMPTY FOR NOW) -->
    <div id="details" class="tab-content">

    </div>

    <!-- STATEMENTS -->
    <div id="statements" class="tab-content">

        <div class="info">
            <span
                style="border: 2px solid black;border-radius: 50%;display: inline-block;justify-content: center;padding: 0px 4px;font-size: 16px; margin-right: 5px;">✔ 
            </span> We’re generating your statement, it’ll appear below within a few minutes. Refresh to see updates.
        </div>

        <div class="card">
            <h3 style="font-weight: 700;font-size: 19px;">Get your latest statement</h3>
            <p style="font-size: 18px;">Generate a full history of your loan activity to date.</p>
            <button class="btn">Generate statement</button>
        </div>

        <div style="display:flex; justify-content:space-between; margin-top:20px;" class="statement">
            <span style="font-weight: 700;">View and download your previously generated statements below</span>
            <span class="refresh">Refresh</span>
        </div>

        <div class="statement">
            <span>eStatement-LAI-00251280-03-2026.pdf</span>
            <span>3/10/2026 4:26:17 PM</span>
            <span style="font-weight: 900;">></span>
        </div>

        <div class="statement">
            <span>eStatement-LAI-00251280-02-2026.pdf</span>
            <span>2/28/2026 7:32:30 PM</span>
            <span style="font-weight: 900;">></span>
        </div>

        <div class="statement">
            <span>eStatement-LAI-00251280-01-2026.pdf</span>
            <span>1/28/2026 12:58:24 PM</span>
            <span style="font-weight: 900;">></span>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <span class="nav disabled">|&lt;</span>
            <span class="nav disabled">&lt;</span>

            <span class="page active">1</span>

            <span class="nav">&gt;</span>
            <span class="nav">&gt;|</span>
        </div>



    </div>
    <div style="background: #E5F6FE;height: 50px;">
    </div>



    <!-- JS -->
    <script>
        function openTab(tabName) {
            let contents = document.querySelectorAll('.tab-content');
            let tabs = document.querySelectorAll('.tab');

            contents.forEach(c => c.classList.remove('active'));
            tabs.forEach(t => t.classList.remove('active'));

            document.getElementById(tabName).classList.add('active');
            event.target.classList.add('active');
        }
    </script>

</body>

</html>