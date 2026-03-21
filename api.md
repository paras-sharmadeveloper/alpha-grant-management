

/**
**verification id 
**/

curl --request POST \
  --url https://verification.didit.me/v3/id-verification/ \
  --header 'Content-Type: multipart/form-data' \
  --header 'x-api-key: CZh3nyDdD2TQByxqSQViYl0dvd3TZSKQFz6wM_bL8lo' \
  --form front_image='@example-file' \
  --form back_image='@example-file' \
  --form perform_document_liveness=false \
  --form minimum_age=60 \
  --form expiration_date_not_detected_action=DECLINE \
  --form invalid_mrz_action=DECLINE \
  --form inconsistent_data_action=DECLINE \
  --form preferred_characters=latin \
  --form save_api_request=true \
  --form 'vendor_data=<string>'

    key:-x-api-key

    body
    front_image upload
    back_image  upload
    perform_document_liveness true and false 
    minimum_age   calulate automatic nullable 
    inimum_age

integer
Minimum age required. Users under this age will be declined. Must be between 1-120.

enter minimum_age
expiration_date_not_detected_action
enum<string>
Action to take when the expiration date is not detected. Must be one of NO_ACTION or DECLINE.


DECLINE

invalid_mrz_action
enum<string>
Action to take when MRZ reading fails because the MRZ has been tampered, or there is some occlusions that does not allow to read it properly. Must be one of NO_ACTION or DECLINE.


DECLINE

inconsistent_data_action
enum<string>
Action to take when the extracted data in the VIZ (Visual Inspection Zone) is not consistent with the MRZ data, indicating signs of data tampering. Must be one of NO_ACTION or DECLINE.


DECLINE

preferred_characters
enum<string>
Preferred character set to use when multiple scripts are available in the document data. Must be one of latin or non_latin.


latin

save_api_request
boolean
Whether to save this API request. If true, then it will appear on the Manual Checks section in the Business Console.


true

vendor_data
string
A unique identifier for the vendor or user, such as a UUID or email. This field enables proper session tracking and user data aggregation across multiple verification sessions.


  
/**
**proff of address
**/


curl --request POST \
  --url https://verification.didit.me/v3/poa/ \
  --header 'Content-Type: multipart/form-data' \
  --header 'x-api-key: CZh3nyDdD2TQByxqSQViYl0dvd3TZSKQFz6wM_bL8lo' \
  --form document='@example-file' \
  --form 'expected_address=<string>' \
  --form 'expected_country=<string>' \
  --form 'expected_first_name=<string>' \
  --form 'expected_last_name=<string>' \
  --form 'poa_languages_allowed=<string>' \
  --form 'poa_document_age_months=utility_bill:3,bank_statement:3,government_issued_document:3' \
  --form poa_name_mismatch_action=DECLINE \
  --form poa_document_issues_action=DECLINE \
  --form poa_document_authenticity_action=DECLINE \
  --form poa_unsupported_language_action=DECLINE \
  --form poa_address_mismatch_action=DECLINE \
  --form poa_issuer_not_identified_action=DECLINE \
  --form save_api_request=true \
  --form 'vendor_data=<string>'


  Proof of Address
Verify address documents by submitting images or PDFs. Extracts address data, performs authenticity checks, and returns structured results.

Authorization
x-api-key
string
required
CZh3nyDdD2TQByxqSQViYl0dvd3TZSKQFz6wM_bL8lo
Body
document
file
required
Proof of address document. Allowed formats: PDF, JPEG, PNG, WebP, TIFF. Maximum file size: 15MB.

Drop a file here or click to upload
expected_address
string
Expected address to cross-validate with the data extracted in the POA document.

enter expected_address
expected_country
string
Expected country to cross-validate with the data extracted in the POA document.

enter expected_country
expected_first_name
string
Expected first name to cross-validate with the data extracted in the POA document.

enter expected_first_name
expected_last_name
string
Expected last name to cross-validate with the data extracted in the POA document.

enter expected_last_name
poa_languages_allowed
string
Comma-separated list of allowed language codes (e.g., en,es,fr). If blank or not provided, defaults are used. You can find a list of supported languages here.

enter poa_languages_allowed
poa_document_age_months
string
Comma-separated key:value pairs for document age limits (e.g., utility_bill:3,bank_statement:3). If blank or not provided, defaults are used.

utility_bill:3,bank_statement:3,government_issued_document:3
poa_name_mismatch_action
enum<string>
Action to take when there is a mismatch between the name provided (first name, last name, or both), and the extracted name from the POA document. Must be one of NO_ACTION or DECLINE.


DECLINE

poa_document_issues_action
enum<string>
Action to take when the document quality or file integrity is poor. Must be one of NO_ACTION or DECLINE.


DECLINE

poa_document_authenticity_action
enum<string>
Action to take when document manipulation or authenticity is suspected. Must be one of NO_ACTION or DECLINE.


DECLINE

poa_unsupported_language_action
enum<string>
Action to take when the document language is not supported. Must be one of NO_ACTION or DECLINE.


DECLINE

poa_address_mismatch_action
enum<string>
Action to take when there is a mismatch between the expected address and the address extracted from the POA document. Must be one of NO_ACTION or DECLINE.


DECLINE

poa_issuer_not_identified_action
enum<string>
Action to take when the issuer is not identified. Must be one of NO_ACTION or DECLINE.


DECLINE

save_api_request
boolean
Whether to save this API request. If true, then it will appear on the Manual Checks section in the Business Console.


true

vendor_data
string
A unique identifier for the vendor or user, such as a UUID or email. This field enables proper session tracking and user data aggregation across multiple verification sessions.





3.  passive liveness



curl --request POST \
  --url https://verification.didit.me/v3/passive-liveness/ \
  --header 'Content-Type: multipart/form-data' \
  --header 'x-api-key: CZh3nyDdD2TQByxqSQViYl0dvd3TZSKQFz6wM_bL8lo' \
  --form user_image='@example-file' \
  --form face_liveness_score_decline_threshold=123 \
  --form rotate_image=true \
  --form save_api_request=true \
  --form 'vendor_data=<string>'





4.  face serach 


  curl --request POST \
  --url https://verification.didit.me/v3/face-search/ \
  --header 'Content-Type: multipart/form-data' \
  --header 'x-api-key: CZh3nyDdD2TQByxqSQViYl0dvd3TZSKQFz6wM_bL8lo' \
  --form user_image='@priya.jpg' \
  --form search_type=most_similar \
  --form rotate_image=false \
  --form save_api_request=true \
  --form 'vendor_data=<string>'


 5. Age Estimation

  curl --request POST \
  --url https://verification.didit.me/v3/age-estimation/ \
  --header 'Content-Type: multipart/form-data' \
  --header 'x-api-key: CZh3nyDdD2TQByxqSQViYl0dvd3TZSKQFz6wM_bL8lo' \
  --form user_image='@example-file' \
  --form face_liveness_score_decline_threshold=30 \
  --form age_estimation_decline_threshold=18 \
  --form rotate_image=false \
  --form save_api_request=true \
  --form 'vendor_data=<string>'