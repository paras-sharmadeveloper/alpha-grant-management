# Didit KYC Integration — Requirements

## Overview

This document describes the requirements for integrating Didit identity verification (KYC) into the loan management system. The goal is to allow admins to trigger identity verification for members using the Didit API, and automatically update member KYC status when Didit sends a webhook result.

---

## User Stories

### US-1 — Admin initiates KYC for a member
**As an** admin,  
**I want to** start a KYC verification session for a member from the Members list,  
**So that** I can verify the member's identity before approving their loan.

**Acceptance Criteria:**
- WHEN the admin opens the member action dropdown, THEN a "KYC" option is visible.
- WHEN the admin clicks "KYC", THEN they are taken to the KYC status page for that member.
- WHEN the admin clicks "Start KYC Verification", THEN the system calls the Didit API to create a session and redirects to the Didit verification URL.
- WHEN the session is created successfully, THEN the member's `kyc_status` is set to `pending` and `kyc_session_id` is saved.
- IF the Didit API call fails, THEN an inline error message is shown (no `alert()`).

### US-2 — Member completes verification on Didit
**As a** member,  
**I want to** complete identity verification on the Didit platform,  
**So that** my KYC status is updated in the system automatically.

**Acceptance Criteria:**
- WHEN the member completes verification on Didit, THEN Didit POSTs a webhook to `/didit/webhook`.
- WHEN the webhook is received with `status = approved`, THEN `kyc_status` is set to `approved` and `kyc_verified_at` is recorded.
- WHEN the webhook is received with `status = declined`, THEN `kyc_status` is set to `declined`.
- WHEN the webhook signature does not match, THEN the system returns HTTP 401 and logs a warning.

### US-3 — Admin views KYC status
**As an** admin,  
**I want to** see the current KYC status of a member,  
**So that** I know whether they are verified before processing their loan.

**Acceptance Criteria:**
- WHEN the KYC page is opened, THEN it shows: member name, email, KYC status badge, verified date (if approved), and session ID.
- WHEN status is `approved`, THEN a green "Approved" badge is shown and no initiate button is displayed.
- WHEN status is `pending`, THEN an orange "Pending" badge is shown and a "Re-initiate KYC" button is available.
- WHEN status is `declined` or not started, THEN a "Start KYC Verification" button is shown.

---

## Data Model

### `members` table additions
| Column | Type | Description |
|---|---|---|
| `kyc_status` | string, nullable | `null` / `pending` / `approved` / `declined` |
| `kyc_session_id` | string, nullable | Didit session ID |
| `kyc_verified_at` | timestamp, nullable | When KYC was approved |

---

## External API — Didit

### Step 1: Get Access Token
```
POST https://auth.didit.me/auth/v2/token
Content-Type: application/x-www-form-urlencoded

client_id=...
client_secret=...
grant_type=client_credentials
scope=kyc
```
Response: `{ "access_token": "..." }`

### Step 2: Create Verification Session
```
POST https://api.didit.me/v1/session/
Authorization: Bearer <access_token>
Content-Type: application/json

{
  "callback": "https://yourdomain.com/didit/webhook",
  "vendor_data": "<member_id>",
  "features": "OCR + FACE"
}
```
Response: `{ "session_id": "...", "url": "https://verify.didit.me/..." }`

### Step 3: Webhook (Didit → System)
```
POST /didit/webhook
X-Signature: <hmac-sha256>

{
  "session_id": "...",
  "status": "approved" | "declined" | "pending",
  "vendor_data": "<member_id>"
}
```

---

## Environment Variables Required

| Variable | Description |
|---|---|
| `DIDIT_CLIENT_ID` | OAuth client ID from Didit dashboard |
| `DIDIT_CLIENT_SECRET` | OAuth client secret from Didit dashboard |
| `DIDIT_BASE_URL` | `https://api.didit.me` |
| `DIDIT_AUTH_URL` | `https://auth.didit.me` |
| `DIDIT_WEBHOOK_SECRET` | Secret for verifying webhook HMAC signature |

---

## Flow Diagram

```
Admin                   System                      Didit API
  |                       |                             |
  |-- Click "KYC" ------->|                             |
  |                       |-- POST /auth/v2/token ----->|
  |                       |<-- access_token ------------|
  |                       |-- POST /v1/session/ ------->|
  |                       |<-- session_id + url --------|
  |                       |-- save session_id, status=pending
  |<-- redirect to Didit verification URL --------------|
  |                                                     |
  |-- Member completes verification on Didit ---------->|
  |                       |<-- POST /didit/webhook -----|
  |                       |-- verify HMAC signature     |
  |                       |-- update kyc_status         |
  |                       |-- update kyc_verified_at    |
```

---

## Security Considerations

- Webhook endpoint is excluded from CSRF middleware (registered in `bootstrap/app.php`).
- Webhook signature is verified using HMAC-SHA256 with `DIDIT_WEBHOOK_SECRET`.
- SSL verification is disabled only in non-production environments (`app()->isProduction()`).
- Didit credentials are stored in `.env`, never hardcoded.

---

## Routes

| Method | URL | Name | Description |
|---|---|---|---|
| GET | `/{tenant}/members/kyc/{member_id}` | `kyc.show` | KYC status page |
| GET | `/{tenant}/members/kyc/{member_id}/initiate` | `kyc.initiate` | Start KYC session |
| POST | `/didit/webhook` | `kyc.webhook` | Receive Didit result |

---

## Files Involved

| File | Role |
|---|---|
| `app/Http/Controllers/KycController.php` | Handles show, initiate, webhook |
| `resources/views/backend/admin/member/kyc.blade.php` | KYC status UI |
| `app/Http/Controllers/MemberController.php` | Adds KYC link to member dropdown |
| `app/Models/Member.php` | Has `kyc_status`, `kyc_session_id`, `kyc_verified_at` |
| `config/services.php` | Didit config keys |
| `routes/web.php` | Route definitions |
| `bootstrap/app.php` | CSRF exclusion for webhook |
| `database/migrations/..._add_kyc_fields_to_members_table.php` | DB migration |
