# Submission API Endpoint

This is a simple API endpoint built with Laravel that allows users to submit data.

## Setup

1. Clone this repository to your local machine.
2. Install dependencies by running `composer install`.
3. Set up your `.env` file with your database credentials and other necessary configurations.
4. Run database migrations with `php artisan migrate` to set up the necessary tables.

## API Endpoint

The API endpoint accepts a `POST` request to `/submit` with the following JSON payload structure:

```json
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "message": "This is a test message."
}
Ensure all fields (name, email, and message) are present in the request payload.
Upon successful submission, the API returns a 200 OK status with a JSON response containing a success message.
If the submission is invalid, the API returns a 422 Unprocessable Entity status with a JSON response containing an error message.
Job Queue
Upon receiving a valid submission request, the API dispatches a Laravel job to process the data. The job saves the data to the submissions table in the database.

Events
After successfully saving the submission data to the database, a Laravel event named SubmissionSaved is triggered. A listener attached to this event logs a message indicating a successful save, including the name and email of the submission.

Error Handling
The API handles errors such as invalid data input and errors during job processing. It responds with appropriate messages and status codes for these scenarios.

Running Tests
To run unit tests, execute php artisan test in your terminal. Ensure that your application is properly configured and the database is set up for testing.