# Exam

Prepare 5 presentation (one will be randomly drawn):
* CSS (and HTML)
* JavaScript (and HTML)
* PHP (and HTML)
* MySQL (and PHP)
* MVC design pattern

Presentations are used as a starting point
Questions after your presentation will span the whole curriculum (everything that is presented in the course slides)

Presentations are 8 minutes and you will be stopped after 8 minutes.

## HTML

Hyper Text Markup Language

HTML provides a means to create structured documents by denoting structural semantics for text such as headings, paragraphs, lists, links, quotes ...

Consists of elements and attributes:
```
<element attribute="value">
  Content
</element>
```

The DOM (Document Object Model) represents the logical tree by which HTML elements are connected:
```
            <html>
            /   \
      <head>    <body>
     /         /  |  \
<title>  <main> <nav> <footer>
            |
 ...       <p>     ...
```


### HTML Features

The initial main feature of HTML: linking to other resources on the web (Hypertext!)
```
<a href="http://info.cern.ch" title="home of the first website">Explore the first website on the world web</a>
```

While HTML itself is text-only, it can embed other multimedia sources:

```
<!-- Images -->
<img src="URI" alt="description" title="hover description"/>
<!-- Videos -->
<video width="320" height="240" autoplay>
  <source src="movie.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
<!-- Other Websites! -->
<iframe src="http://example.com"></iframe>
```

HTML elements can further by structured by adding IDs (unique identifier for page element) and Classes:
```
<div id="username" class="bold-green">Foobar</div>
```
These can later be used to access and modify the element(s).

### Forms and Inputs

Used to collect user input in a structured manner

Consist of one or multiple Input elements which can have different types:
* Text
* Password
* Submit
* Checkbox
* Dropdown (Select)
* ... many more

Inputs have different attributes to control their behavior: `required`, `placeholder`, `range` ...

```
<form action="user.php" method="POST">
    <input type="text" placeholder="Username" required/>
    <input type="password" required/>
    <input type="file" name="file"/>
    <input type="submit">
</form>
```

## CSS

Cascading Style Sheets

Defines how the HTML looks

Syntax:
```
<element class="class" id="id">
    <subelement>content</subelement>
</element>

element.class#id subelement {
    color: blue;
}
```
Access the element "subelement" with parent "element", class "class" and ID "id" -> make the text color blue.

CSS also has pseudo-classes to access elements with specific types or states:
```
input[type="text"] { border-radius: 5px; }
a:hover { color: lightblue; }
```

### Specificity

A score (rank) that determines which style declarations are ultimately applied to an element (if there are conflicts between multiple rules)

Specificity Hierarchy:

1. Inline styles (attached directly to the element): `<h1 style="color: #ff;">`
2. IDs: `#foobar`
3. Classes, attributes and pseudo-classes: `.classes, [attributes], :hover, :focus` etc.
4. Elements and pseudo-elements:  `h1, div, :before, :after`

When two rules have equal specificity, the latest (closest) rule wins.

### Properties

CSS can style a lot of properties:
* Padding: inner space between content and border
* Margins: outer distance between border and other elements
* Border: edge of the element
* Display: `block`, `inline`, `inline-block` (textflow)
* Position: `absolute`, `relative`, `fixed`
* Colors: `background-color: #ff`, `border-color: rgba(0.5, 123, 123, 123)`
* Box Sizes: `width`, `height`, `min-width`, `max-width`, ...
* Shapes: `skew`, `rotate`, `border-radius`, ...
* Transitions and Animations
* Fonts and Styles: `font-family`, `font-size`, `font-style` ...

### Images
Set background images: `element { background-image: url("bg.png"); }`
Overflow (if image is bigger than element): `scroll`, `hidden`, `auto` or `visible`
Object-fit (how the image is fitted into the element): `fill` (image is stretched to fit), `contain` (image scales inside element with aspect ratio intact), `cover` (image scales to fill element with aspect ratio intact), `scale-down` (like contain, but only scales down), `none` (image is not resized)

## JavaScript

High-level, interpreted programming language that conforms to the ECMAScript specification.
Curly-bracket syntax, dynamic typing, prototype-based object-orientation and first-class functions.
Curly-bracket language -> C-style comments, function declarations, For and while loops, if-else Statements, ...

Alongside HTML and CSS, JavaScript is one of the core technologies of the World Wide Web.
Enables interactive web pages by allowing to manipulate the DOM after HTML and CSS are loaded and displayed: responsive content, dynamic loading, manipulating elements, checking form content before submission, ...

### Triggers

Javascript functions are called after the DOM has loaded, or upon certain events (triggers): `onClick`, `onMouseDown`, `onLoad` ...
```
<button id="button" onclick="call(event, this)"></button>

<script>

document.getElementById("button").addEventListener("click", call(event, this));

function call(ev, obj) {
    console.log(ev, obj);
}
</script>
```

### DOM Manipulation

Javascript can query specific elements by ID, Class and/or HTML tag:
```
document.getElementById('idA'); // exactly one
document.getElementsByClassName('classA'); // more than one
document.getElementsByTagName('div'); // more than one
document.querySelector('.classA.classB'); // combination of selectors, exactly one
document.querySelectorAll('.classA.classB'); // combination of selectors, multiple
```

Afterwards, the attributes and content of these elements can be changed:
```
var user = document.getElementById("user");

user.innerHTML = "Foo Bar";
user.style.color = "red";
```

Also the structure of the DOM tree can be manipulated:
```
document.createElement("div")
element.appendChild(otherelement)
element.cloneNode(true)
element.insertBefore(newElement, existingElement)
```

### Variables
* no explicit types (types are inferred on declaration)
-> assigning a new value of a different type will simply change the type
Datatypes: Strings, Integers, Floating point numbers, Arrays, Functions, Objects

```
var hello = "world"; // can be changed at any time (including type)
const foo = "bar"; // can not be altered
let i = 0; // scope is limited to the block, statement or expression
```

### Example: form validation
```
<form onsubmit="return checkForm()" method="post" action="./password.php" >
    <input type="password" name="password" id="password"/>
    <br>
    <input type="submit" name="submit" id="submit"/>
</form>
<script>
function checkForm() {
    var password = document.getElementById("password").value;
    var regex = new RegExp("/([a-zA-Z0-9]{8,})/g"); // letters a-z, A-Z and 0-9, at least 8 characters
    if(regex.test(password)) {
        alert("Password does not conform to pattern"); // bad
        return false; // preventing the browser from posting the form
    } else {
        return true;
    }
}
</script>
```

## PHP
PHP: Hypertext Preprocessor is a general purpose programming language mainly focused on web development.
It runs on the server (backend) and creates the content (HTML) that gets sent to the client. (Client never sees PHP source code!)

```
<h1><?php echo 'Hello World'; ?></h1>
```

### Variables
Like Javascript, PHP is dynamically typed. Unlike JS, variables are denoted with a dollar sign `$`.
(Primitive) Datatypes: Integer, Double, String and Boolean
For double quoted strings: variable interpolation
```
$user = '"Name"';
echo "Hello $user";
```

Generally: PHP is pass-by-value
For primitives, copies are made
For objects, the value is a reference

### Functions

Does not support function overloading (function with same name but different signatures)
Does support default arguments for functions (some arguments may be left unspecified)
Does support function overriding (function with same name and same signature is replaced by another one)

### Classes and Objects

Like most modern languages: Interfaces, Classes and Objects

```
interface Person {
    public function getName();
}

class Student {
    private $name;
    function __construct($name) {
		$this->name = $name;
	}
	function __destruct() {
		// destructor
	}
    function __tostring() {
        return $this->name;
    }
}

$jack = new Student('jack');
echo $jack;
```

PHP does not have garbage collection
For each object, PHP counts the references
When a reference is removed, and there are no more references to the object, the destructor is called

Magic methods start with `__`, special functionality is associated with them

### PHP Arrays
Arrays in PHP can either be accessed via key-value pairs or via index:

```
$array = array(
    "key" => "value",
    "foo" => 3,
    "x"
    );

echo $array['key']; // value
echo $array[2]; // x

$array[] = "y"; // add new item
$array["bar"] = 4; // add new key-value pair
unset($array["bar"]); // remove key
isset($array["bar"]); // check if element is present
print_r($array); // print out the entire array
```

### Superglobals
Predefined Global Variables: "superglobals" (for communicating with the server application, always accessible):

* `$GLOBALS`: lists all global variables
* `$_SERVER`: holds information about headers, paths, and script locations (`SERVER_NAME`, `HTTP_HOST`, ...)
* `$_ENV`: associative array of variables passed to the current script via the environment method
* `$_REQUEST`: associative array that by default contains the contents of `$_GET`, `$_POST` and `$_COOKIE`
* `$_POST`: collects form data after submitting an HTML form with method="post"
* `$_GET`: collects form data after submitting an HTML form with method="get".
* `$_FILES`: associative array of items uploaded to the current script via the HTTP POST method
* `$_COOKIE`: associative array of variables passed to the current script via HTTP Cookies
* `$_SESSION`: associative array containing session variables available to the current script

### PHP Sessions
The superglobal `$_SESSION` contains information about a specific client.
PHP automatically sets a cookie to uniquely identify a client and select the right session.
(The user does however not have access to the data attached to a session)

```
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ( isset($_SESSION["logged_in"] && $_SESSION["logged_in"] ) {
    echo 'Hello ' . $_SESSION["username"];
}
```

### User Input
User Input is always dangerous! Need to sanitize it: `filter_input(INPUT_GET, "email", FILTER_VALIDATE_EMAIL)`

### Combining different PHP scripts
Promotes code-reuse and helps keep the source code tidy

```
include 'myFile.php'; // creates warning if it fails
include_once 'myFile.php'; // only includes if not included before
require 'myFile.php'; // throws fatal error if it fails
require_once 'myFile.php'; // only includes if not included before
```

## Databases / SQL

* Database is an organized collection of data
* Database Management System (DBMS) is the software that interacts with the database, applications and end users
* DBMS manages the data and the organization of the data in Schemas
* Sorted by indexes
* Tables are ordered by column names and row ids
* Each Schema consists of one or multiple tables
* Structured Query Language (SQL) is the language used to communicate with a database
* Most RDBMS use SQL, but the syntax varies

Examples:
```
> SHOW DATABASES;
information_schema
mysql
app
> USE DATABASE app;
> SHOW TABLES:
Users
Images
> SELECT name, birthdate FROM Users WHERE id = 2;
Anton, 1999-09-09
```

### Data Types
MySQL / MariaDB support different datatypes (cell types) for storing different kinds of information:

* Boolean: TinyInt (Bool, Boolean)
* Integer: SmallInt, MediumInt, Int (Integer), BigInt
* Decimal: Dec, Float, Double
* Characters: Char, VarChar
* Binary Data: TinyBlob, MediumBlob, Blob, LongBlob
* Text: Text, LongText
* Time and Date: TimeStamp, Date, DateTime, Time, Year

Choose the appropriate data type for the use-case!

### SQL Commands

* `CREATE`: creates a new database, table, view, ...
* `DROP`: deletes a database, table, view, ...
* `ALTER`: used to modify the structure of an existing table (`ADD`,`RENAME`, `DROP` ...)
* `INSERT`: add a new row to a table
* `UPDATE`: modify an existing entry (row) in the table
* `SELECT`: query information from a table
* `JOIN`: query information present in multiple tables

### Migrations

* Migrations are a set of files that contain the SQL that makes up the database.
* They are ordered (e.g. version or date) and have to be applied in this order
* They initialize or upgrade the database to a new version
* The database has a migrations table that remembers which migrations are already on
* They don't contain data, just structure

### SQL Injections

User Input is dangerous!
When concatenating SQL statements and user-input together, the user can break out of the SQL clause!

```
$sql = 'SELECT * FROM user WHERE username = ' . $_POST["username"];
$stmt = $conn->prepare($sql);
$stmt->execute();
```

Malicious username: `abc'); DROP TABLE Users;--`

Database input needs to be sanitized or use of "Prepared Statements" (separates SQL statements from data):

```
$sql = 'SELECT * FROM user WHERE username = :username';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $_POST["username"]);
$stmt->execute();
```

## MVC

Split functionality into a Model, a View and a Controller

![MVC Image]()

"View" generates the HTML for the client (no HTML anywhere else!)
Views are made up of many partials views (templates) such as Menus, Navbars, Footers, ...

Model contains (or has access to) the data in the database (only part that communicates with the database)
Model manages the hierarchical relationships between the objects

Controller is the heart of the application
Receives the request from the client, initiates the necessary queries to the Model, forwards the data to the view and sends back the HTML to the client
Typically the data is passed from the Controller to the View via a "Viewbag" (associative array or object)

The Service contains code that does not belong into any other category
Such as communicating or exposing an API, generic algorithms, ...

### Router

Router handles the matching between the incoming request and which controller to call (when there are multiple controllers)
e.g. `example.com/home` -> `homeController`
Three methods for routing:
* Annotate controller methods with routing rules: `@Url("home/login")`
* Manually list all routes in the router: `array( "home/login" => $homeController->login() )`
* Automate the router using reflection: call a class / method based on its name (derived from URL)
Problems: Users can call any function in any class / Users can try to reach a class or function that does not exist
-> sanitize and restrict user input, set defaults

```
$url = explode('/', $_SERVER["REQUEST_URI"]);
if( class_exists($url[0]) && method_exists($url[1])) {
  call_user_func_array( [new $url[0], $url[1]] );
} Else {
  logout();
}
```

## API

Application Programming Interface:
a set of functions and procedures allowing the creation of applications that access the features or data of an operating system, application, or other service
-> A way to expose data and functionality in a structured format from one application to others

### REST

Representational State Transfer
A uniform way of cross application communication
Usually uses JSON, but can use XML
URL's define resources
HTTP verbs define actions:
* GET gets data (idempotent)
* POST uploads new data
* PUT changes existing data (idempotent)
* DELETE removes existing data (idempotent)
