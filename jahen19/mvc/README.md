# Assignment 2

## Task

Deadline: 02.05.2019

Build a website where users can:
* [ ] Use 2 external APIs
* [X] Use MVC pattern
* [X] Use 2 frameworks
* [X] RESTful API (see below)

API:
* [X] POST /public/api/pictures/user/ID: `$_POST['json']` contains JSON with "image" base64-encoded, "title", "description", "username", "password", returns "image_id"
* [X] GET /public/api/users: returns JSON containing "user_id" and "username" of all users
* [X] GET /public/api/pictures/user/ID: returns JSON containing "image_id", "title", "description", "image" for all images that belong to a user "ID"
* [X] GET /public: UI to register new user

From Assignment 1:
* [X] Create a user and log in
* [X] Upload an image with a header and some text
* [X] See all users images on a feed when logged in
* [X] See and delete own pictures
* [X] Site must be somewhat scalable to desktop and mobile
* [X] Must contain one AJAX call
* [ ] Screenshots
* [X] Protect against XSS & SQL Injection
* [X] Show latest 20 pictures
* [X] User list
* [ ] Sign up page: Username, Password, Repeat Password, Firstname, Lastname, Zip, City, Email address, phone number

## Software

* Chromium
* PHP 7.3
* MariaDB
