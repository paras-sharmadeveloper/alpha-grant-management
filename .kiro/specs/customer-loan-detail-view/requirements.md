# Requirements Document

## Introduction

This feature provides customers with a detailed, mobile-friendly loan detail view page. When a customer clicks on a loan from their loan list, they are taken to a page that shows a summary card (next payment date, pending amount, status), followed by tabbed sections for Loan Details, Transactions, Statements, and Documents. The design is based on the mockup in `viewloan.md` and is implemented within the existing Laravel multi-tenant backend.

## Glossary

- **Customer**: An authenticated user with `user_type = 'customer'` who has an associated `Member` record.
- **Loan**: A record in the `loans` table representing a borrowing agreement between a member and the organization.
- **LoanRepayment**: A scheduled repayment entry in the `loan_repayments` table, with a `repayment_date`, `principal_amount`, `interest`, and `status` (0 = pending, 1 = paid).
- **LoanPayment**: An actual payment made by the customer, stored in the `loan_payments` table.
- **LoanCollateral**: A document or asset pledged against the loan, stored in the `loan_collaterals` table.
- **Summary Card**: The top section of the loan detail page showing next payment date, pending amount, and loan status.
- **Loan Detail View**: The customer-facing page at route `loans.loan_details` rendered by `backend.customer.loan.loan_details`.
- **Pending Amount**: The difference between `applied_amount` and `total_paid` on the loan.
- **Next Payment**: The earliest unpaid `LoanRepayment` record for the loan (status = 0), ordered by `id` ascending.
- **Overdue Amount**: The sum of `principal_amount` for all `LoanRepayment` records where `repayment_date` is in the past and `status = 0`.
- **Print Schedule**: A printable/downloadable PDF of the full repayment schedule, accessible via route `loans.customer_print_schedule`.

---

## Requirements

### Requirement 1

**User Story:** As a customer, I want to view a summary of my loan at a glance, so that I can quickly understand my current repayment status.

#### Acceptance Criteria

1. WHEN a customer navigates to the loan detail page, THE Loan Detail View SHALL display a summary card containing the next payment due date, the pending (outstanding) amount, and the current loan status.
2. WHEN the loan has no remaining unpaid repayments, THE Loan Detail View SHALL display a dash ("—") in place of the next payment due date.
3. WHEN the loan status is 0, THE Loan Detail View SHALL display the status label as "Pending" in an amber/warning color.
4. WHEN the loan status is 1, THE Loan Detail View SHALL display the status label as "Approved" in a green/success color.
5. WHEN the loan status is 2, THE Loan Detail View SHALL display the status label as "Completed" in a blue/info color.

---

### Requirement 2

**User Story:** As a customer, I want to see the full details of my loan in a dedicated tab, so that I can review the terms I agreed to.

#### Acceptance Criteria

1. WHEN a customer opens the Loan Details tab, THE Loan Detail View SHALL display the loan amount, interest rate, loan term, release date, first payment date, and late payment penalties.
2. WHEN the loan status is 1 (Approved), THE Loan Detail View SHALL additionally display the approved date and the name of the loan officer who approved the loan.
3. WHEN the loan has a non-empty description field, THE Loan Detail View SHALL display the description in the Loan Details tab.
4. WHEN custom fields are configured for the loans table and have values, THE Loan Detail View SHALL display each custom field name and its value in the Loan Details tab.
5. WHEN a custom field is of type "file", THE Loan Detail View SHALL render a clickable "Preview" link pointing to the uploaded file instead of displaying raw text.

---

### Requirement 3

**User Story:** As a customer, I want to see a chronological list of all transactions related to my loan, so that I can track disbursements, repayments, and charges.

#### Acceptance Criteria

1. WHEN a customer opens the Transactions tab, THE Loan Detail View SHALL display the loan disbursement as the first entry with a positive amount and the release date.
2. WHEN a customer opens the Transactions tab and payments exist, THE Loan Detail View SHALL display each `LoanPayment` record showing the payment date, an "EMI Paid" label, and the principal portion as a positive amount.
3. WHEN a `LoanPayment` record has an interest value greater than zero, THE Loan Detail View SHALL display a sub-row beneath the EMI entry showing the interest charged as a negative amount.
4. WHEN a `LoanPayment` record has a late penalty value greater than zero, THE Loan Detail View SHALL display a sub-row beneath the EMI entry showing the late penalty as a negative amount.
5. WHEN no payments have been made and the loan is approved, THE Loan Detail View SHALL display no transaction rows beyond the disbursement entry.

---

### Requirement 4

**User Story:** As a customer, I want to download or print my loan repayment schedule, so that I can keep a record of my payment obligations.

#### Acceptance Criteria

1. WHEN a customer opens the Statements tab, THE Loan Detail View SHALL display a button or link to print or download the full repayment schedule as a PDF.
2. WHEN a customer clicks the print/download link, THE Loan Detail View SHALL open the printable schedule in a new browser tab via the `loans.customer_print_schedule` route.

---

### Requirement 5

**User Story:** As a customer, I want to view documents and collaterals attached to my loan, so that I can confirm what was submitted.

#### Acceptance Criteria

1. WHEN a customer opens the Documents tab and collaterals exist, THE Loan Detail View SHALL display each collateral's name and either a "View" link (if an attachment file exists) or the collateral type and estimated price.
2. WHEN no collaterals exist for the loan, THE Loan Detail View SHALL display a "No documents found" message in the Documents tab.

---

### Requirement 6

**User Story:** As a customer, I want the loan detail page to be accessible only for my own loans, so that I cannot view another customer's loan data.

#### Acceptance Criteria

1. WHEN a customer requests the loan detail page for a loan that does not belong to them, THE Loan Detail View SHALL return a null result and not render any loan data.
2. WHILE a customer is authenticated, THE Loan Detail View SHALL only query loans where `borrower_id` matches the authenticated user's member ID.

---

### Requirement 7

**User Story:** As a customer, I want the loan detail page to be responsive and usable on mobile devices, so that I can check my loan status from my phone.

#### Acceptance Criteria

1. WHILE the viewport width is 768px or below, THE Loan Detail View SHALL stack the summary card items vertically and hide the dividers between them.
2. WHILE the viewport width is 768px or below, THE Loan Detail View SHALL reduce the tab gap and expand the tab content to 95% of the viewport width.
