# Assignment 2

## Task

Deadline: 02.05.2019

Build a website where users can:
* [ ] Use 2 external APIs
* [ ] Use MVC pattern
* [ ] Use 2 frameworks
* [ ] RESTful API (see below)

API:
* [ ] POST /public/api//pictures/user/ID: `$_POST['json']` contains JSON with "image" base64-encoded, "title", "description", "username", "password", returns "image_id"
* [ ] GET /public/api/users: returns JSON containing "user_id" and "username" of all users
* [ ] GET /public/api/pictures/user/ID: returns JSON containing "image_id", "title", "description", "image" for all images that belong to a user "ID"
* [ ] GET /public: UI to register new user

From Assignment 1:
* [ ] Create a user and log in
* [ ] Upload an image with a header and some text
* [ ] See all users images on a feed when logged in
* [ ] See and delete own pictures
* [ ] Site must be somewhat scalable to desktop and mobile
* [ ] Must contain one AJAX call
* [ ] Screenshots
* [ ] Protect against XSS & SQL Injection
* [ ] Show latest 20 pictures
* [ ] User list
* [ ] Sign up page: Username, Password, Repeat Password, Firstname, Lastname, Zip, City, Email address, phone number

## Software

* Chromium
* PHP 7.3
* MariaDB
