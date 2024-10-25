# API Documentation - Bookings

Base URL

https://yasin-shamrat.com/api/

### Login
Request

Method: POST <br>
Endpoint: /login <br>
Headers: Accept: application/json <br>
Body: form-data <br>
email: string, required <br>
password: string, required <br>
Response <br>
On successful login, returns an authentication token.

### Get Bookings
Request

Method: GET <br>
Endpoint: /bookings <br>
Headers: Accept: application/json <br>
Authorization: Bearer token (obtained from login) <br>


### Get Mechanics Request

Method: GET  <br>
Endpoint: /mechanics <br>
Headers: Accept: application/json <br>
Authorization: Bearer token (obtained from login) <br>

### Dashboard Request

Method: GET <br>
Endpoint: /dashboard <br>
Headers: Accept: application/json <br>
Authorization: Bearer token (obtained from login) <br>
### Create Booking Request

Method: POST <br>
Endpoint: /booking/create <br>
Headers: Accept: application/json <br>
Authorization: Bearer token (obtained from login) <br>
Body: form-data <br>
car_make: string, required <br>
car_model: string, required <br>
car_year: string, required <br>
registration_plate: string, required <br>
customer_name: string, required <br>
customer_phone: string, required <br>
customer_email: string, required <br>
booking_title: string, required <br>
start_datetime: datetime (format: dd-MM-yyyy hh
AM/PM), required <br>
end_datetime: datetime (format: dd-MM-yyyy hh
AM/PM), required <br>
mechanic_id: integer, required <br>

### Update Booking Request

Method: POST <br>
Endpoint: /booking/{id}/update <br>
{id}: Booking ID to be updated <br>
Headers: Accept: application/json <br>
Authorization: Bearer token (obtained from login) <br>
Body: form-data <br>
status: string, required (e.g., "in-progress", "complete")
mechanic_id: integer, required