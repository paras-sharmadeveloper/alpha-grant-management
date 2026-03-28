# Alpha Grant Management — Loan Project Flow

---

## Step 1 — Loan Application

### Who can apply?

**A. Customer (Member) applies via portal**

1. Customer logs in at `/{tenant}/login`
2. Goes to **My Loan → Apply New Loan** (`/portal/loans/apply_loan`)
3. Fills the 6-step enquiry form:
   - Step 1: Full Name, Mobile, Email, GST Registered, Years Operating, ABN/ACN
   - Step 2: Loan Product, Applied Amount (validated against product min/max), Term (months + years shown), Loan Purpose, Monthly Revenue
   - Step 3: ATO Debt, Defaults, Existing Loans
   - Step 4: Security Type (Secured / Unsecured), Asset Type
   - Step 5: Funds Needed By date, Attachment, Description
   - Step 6: Review summary → Consent checkbox → Submit
4. Each step validates required fields before allowing Next
5. On submit → Loan saved with:
   - `status = 0` (Pending)
   - `release_date = today` (application date)
   - `first_payment_date = next month`

**B. Branch / Admin creates loan directly**

1. Admin/Staff logs in at `/{tenant}/login`
2. Goes to **Loans → All Loans → Add New** (`/loans/create`)
3. Fills: Loan ID, Loan Product, Borrower, Currency, First Payment Date, Release Date, Applied Amount, Late Payment Penalties, Description, Remarks
4. Loan saved with `status = 0` (Pending)

---

## Step 2 — Loan Review & Approval

1. Admin/Branch goes to **Loans → All Loans** → filter Pending
2. Clicks **View** on a loan → sees Loan Details tab
3. Clicks **Approve** button → opens approval form at `/loans/approve/{id}`

### On the Approval Form the branch can:

- **Override Applied Amount** — change the loan amount before approving
- **Override Term** — change the number of repayment periods
- **Override Interest Rate** — set a custom rate different from the product default
- **Upload Documents** — attach supporting files with Show to Customer toggle
- **Select Disburse Method** — Cash or Transfer to Account

4. Clicks **Approve** → system:
   - Sets `status = 1` (Active/Approved)
   - Records `approved_date` and `approved_user_id`
   - Generates full repayment schedule using `LoanCalculator`
   - Supports: flat_rate, fixed_rate, mortgage, one_time, reducing_amount
   - Saves `total_payable`
   - Creates disbursement Transaction if account transfer selected
   - Sends approval notification to borrower

5. To **Reject** → clicks Reject → `status = 3` (Cancelled) → borrower notified

---

## Step 3 — Repayment Schedule

After approval the system generates a schedule of instalments stored in `loan_repayments` table:

| Field | Description |
|-------|-------------|
| repayment_date | Due date of each instalment |
| principal_amount | Principal portion |
| interest | Interest portion |
| amount_to_pay | Total instalment |
| penalty | Late fee per day |
| balance | Remaining balance after payment |
| status | 0 = Unpaid, 1 = Paid |

Customer can view the schedule at **Loan Details → Statements tab** and print/download it.

---

## Step 4 — Making Payments

### A. Branch pays manually (Admin Pay Hub)

1. Admin goes to **Pay** in sidebar (`/{tenant}/pay`)
2. Sees all past payments in the table
3. Clicks **Pay** button → modal opens
4. **Search** by Loan ID, Member ID, or Member Name → results appear
5. Clicks **Pay** on a loan row → payment form loads with:
   - Payment Date
   - Principal Amount (pre-filled, editable)
   - Interest (pre-filled, readonly)
   - Late Penalties (editable)
   - Total Amount (auto-calculated)
6. Selects **Payment Method**:
   - **Cash** → submit directly → payment recorded
   - **Bank Transfer** → enter Transaction/Reference Number → submit → payment recorded
   - **Stripe** → redirects to Stripe card page

### B. Branch pays via Stripe (Admin Stripe page)

1. From Pay modal → click **Stripe** button → redirects to `/{tenant}/pay/stripe/{loan_id}`
2. Page shows: Loan ID, Borrower, Due Date, Principal, Interest, Late Fees (read-only if 0)
3. Admin enters card details → clicks Pay Now
4. Stripe charges the card → payment recorded → redirects back to Pay page

### C. Customer pays via Stripe (Customer Portal)

1. Customer goes to **Pay** in sidebar (`/portal/pay`)
2. All active loans listed with outstanding balance and next due date
3. Can search by Loan ID
4. Clicks **Pay via Stripe** → redirects to `/{tenant}/portal/loans/stripe_payment/{loan_id}`
5. Page shows repayment breakdown
6. Customer enters card details → Stripe charges → payment recorded → loan updated

---

## Step 5 — Payment Processing (What happens on each payment)

1. `LoanPayment` record created with: loan_id, paid_at, principal_amount, interest, late_penalties, total_amount, repayment_id
2. `Loan.total_paid` incremented by principal_amount
3. `LoanRepayment` for that instalment marked `status = 1`
4. If `total_paid >= applied_amount` → `Loan.status = 2` (Completed) → all remaining repayments deleted
5. If partial payment → remaining repayment schedule recalculated using LoanCalculator
6. Borrower receives `LoanPaymentReceived` notification

---

## Step 6 — Loan Completion

- When all principal is paid → `status = 2` (Completed)
- Loan appears in history on customer portal
- No further payments accepted

---

## Loan Status Reference

| Status | Meaning |
|--------|---------|
| 0 | Pending — awaiting approval |
| 1 | Active/Approved — repayments in progress |
| 2 | Completed — fully paid |
| 3 | Cancelled/Rejected |

---

## Key URLs Reference

| Who | Action | URL |
|-----|--------|-----|
| Customer | Apply loan | `/portal/loans/apply_loan` |
| Customer | View my loans | `/portal/loans/my_loans` |
| Customer | View loan detail | `/portal/loans/loan_details/{id}` |
| Customer | Pay via Stripe | `/portal/pay` |
| Admin | All loans | `/{tenant}/loans` |
| Admin | Approve loan | `/{tenant}/loans/approve/{id}` |
| Admin | Loan book | `/{tenant}/loan_book` |
| Admin | Pay hub | `/{tenant}/pay` |
| Admin | Admin Stripe pay | `/{tenant}/pay/stripe/{loan_id}` |
| Admin | Loan repayments | `/{tenant}/loan_payments` |
| Admin | Documents | `/{tenant}/documents` |
