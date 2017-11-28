#### Milestone 2 - Development Book (October 6, 2017)
#### By Maggie Jin, Holly Borrino, and Ian Kitchen 



## Team Members and Roles
We have three members in the group, some members may have multiple roles but all of the members will collaborate on every part of the project. Every decision will be agreed upon within the group and a finalized version will be completed by the member with that role.

As team projects can be difficult to successfully organize, these roles come with the implicit understanding that individual work must be done significantly in advance before a deadline: so, in the event of illness, catastrophe, or any other inability to complete the designated work, another team member will have enough time to pick up the slack.

* __Project Manager__ - __*Holly*__ - accounts for overall coordination of project, checking in with members, monitoring deadlines, and ensuring that work is steadily progressing.

* __Document Writer__ - __*Holly*__ - responsible for the non-code documents with the project, especially during the planning process. Still works together with other members on the composition of those documents, but accounts for file formatting, proofreading, and overall quality checking of written submissions. May write more than 1/3 of the content too.

* __Documentation Writer__ - __*Maggie*__ - responsible for the code's documentation with the project: comments, headers, formatting, and help resources. Still works together with other members on the composition of those documents, but accounts for quality of them and may write more than 1/3 of the content.

* __Application Designer__ - __*Maggie*__ - responsible for the design of the program, especially during the planning process; still works with the other members on the composition of the program and discussion about the merit of the design choices, but accounts for diagrams, rough-draft explanations of the application design, being able to articulate the reasoning behind choices, ultimate choice of design pattern, and overall quality checking of the chosen design. Responsible for more than 1/3 of the input and brainstorming, too.

* __Application Programmer(s)__ - __*All (small team)*__ - responsible for the creation of the program. The role should be shared by all members volunteering to do about 1/3 of the actual coding. Application programmers are responsible for being able to articulate coding choices and what the produced code does on a step-by-step level, especially any deviations from the original design plan.

* __Application Tester__ - __*Ian*__ - responsible for testing the final creation: mainly writing unit tests and any documentation needed to accompany that. Testing will of course be done throughout the course of the project, but the cumulative tests plus final testing will be handled by the application tester.

## Background
Our project was inspired by browsing publically available data sources and thinking of uses for them that we couldn't immediately think of as being covered by another project or application. The main alternative available is the [energy.gov locator](https://energy.gov/maps/alternative-fueling-station-locator) that lacks functionality we'd like to have, like user accounts and tracking personal preferences towards stations. It comes with a [mobile app](https://itunes.apple.com/us/app/alternative-fueling-station-locator/id718577947?mt=8), but the top review is criticism from a customer who dislikes that it "defaults to Apple maps - and in a Metropolis, where there are Transits... there's no option or any way to open the destination / route in Google maps." The user also disliked that there is "no way to copy the address to paste it into Google". Another user lamented lacking "the ability to redo a search in that area (like yelp or google maps has)". Google Maps is a widely used application; I can see how this lack of capability would become unpleasant quickly.

As for Githubs, there's several: [a Ruby program that uses the same API as us](https://github.com/rshakhb10/alternative-fuel-stations-locator) for the same purpose, but only allows filtering by state, zipcode, and type of fuel.

[A more sophisticated alternative](https://github.com/Traci7822/alternative_fuel_stations) from Traci7822 is an application that uses AngularJS, Rails, and Socrata Open Data API; however, it suggests installing it by "cloning or downloading the repository to your local machine, running bundle install, starting a rails server and browsing to to your localhost page", which is much less lightweight and portable than our planned deployment of a live website version and bundle of files that can be uploaded to any web directory.

## Project Description
Our project is an alternative fuel station locator. It's planned to be a mobile web application that allows users to open selected locations in their Google Maps mobile application, integrated with a PostgreSQL database to be able to store persistent data about users and fuel stations.

## Project Requirements

The project must:

1. **Face potential issues with data input:**

    >"Users can search for stations by location: street name, city, zipcode, or state. Users will enter in their address and/or zipcode manually to be able to run search queries *or* allow automatic access of device location. Users can increase or decrease the radius size that the search results bring back - likely by numerical input." 
    
    Inputting a radius of "99999999999 km" is an example of potential input issues we expect to handle.
    
2. **Face potential issues of data integrity:**

    > "Users can create a user account by entering an email, username, and password in the appropriate form." 
    
    Creating a user account and attempting to make the email with improper formatting is an example of potential data integrity issues with this project. Or designing the database column 'name' to be 20 chars long but accepting a 25 char username at the application level and attempting to insert it anyways.
    
3. **Use a layered architecture:**

    Our application will have separate data, business, application, and presentation layers. See the appropriate subsection of this document for more information on each layer's role.

4. **Be amenable to the specification and use of design patterns:**

    We plan to use an MVC pattern across the layers. Our model will be based around the data layer as it represents what our project is based on; fuel stations and the users that need to find stations. Our controller will be a combination of the business and application layers. These manipulate, control, validate, and filter the data to make it readable or to format it correctly for storage such as returning a list of searched fuel stations. Our view is the presentation layer, which will provide a UI for interacting with fuel stations and user accounts.

5. **Provide exception handling in a layered manner:**

    All exceptions below the application layer will be thrown upwards and outputted to the presentation layer in a safely managed form that doesn't offer any more information than necessary but still avoids unnecessary ambiguity.

6. **Include testing:**

    Unit tests will be written after each component of code is developed, ideally by a split team with 2 working on code and 1 working on testing that code. This will allow us to deviate from our initial design if necessary but not leave testing for last...which all the obvious issues that arise with that.

7. **Require some authentication and authorization work:**

    User accounts.

8. **Include user help of some kind:**

    A "help" page and tooltips.

9. **Be packaged for some degree of portability:**

    As a mobile web application, it will be compatible with major browsers (FF, Chrome, Opera, IE) and be able to be accessed from any mobile device that can run those browsers.

10. **Be refactored to some extent near the end of the semester:**

    N/A (right now)

11. **Be designed with cognizance of potential regulatory issues:**

    >"Users can filter search results by private, public, or both, along with fuel type, payment type, and owner type, via selection dropdowns or a similar preset list of options."
    
    Regulations could interfere with the usage of our application if we ignore which stations are designated "private" versus "public"; we'll make sure to take those into account and allow users to follow legal regulations for station availability rather than accidentally trespassing.

**Additional requirements:**
* pictures should be presented in the pdf or in separate files readable by the instruc-tor (not proprietary, not visio or bmp). We will expect to use **png** format.
* as we revise this document, we must provide a way to see how it has changed. For instance, if we change the technologies used, the section should still list the original technologies planned to be used in a subsection where we describe why we switched. We plan to use **appropriate subsections** along with **commenting updated changes in git commit comments** so we can easily track what changed when.
* must not use any zip files except to bundle code.
* must present "this" (and likely any other textual document) as a pdf, markdown, html, or a format agreed upon by the instructor (not proprietary, not ms office).

## Business Rules
* Users cannot use this application for profit at an enterprise level.
* We must protect user's private information with as much confidentiality and security as possible.
* Only registered administrators can manage and approve information/additions about stations; we're still designing an appropriate method of identification.
* The map would display public stations for general use and clearly-delineated private stations for allowed private use.
* Limit search results to a reasonable distance. Example: Drivers will most likely not be going 400 miles on one tank, or looking for stations very far away from a location. Therefore the max radius for search will be 100 miles.
* New fuel stations cannot be added without approval or multiple requests to add the same station occur.

## Technologies Used
* JSON is our data source. 
* For the web application, we will use HTML, CSS, JavaScript and jQuery accordingly for the front end, with PHP for our server-side code.
* [Vue.js](https://vuejs.org/) will be used to create the user interface.
* [Jest](https://facebook.github.io/jest/) will be used for unit testing JavaScript

## Timeline
**Milestones:** 
1. Requirements - 9/15 - Plan all general requirements and purposes for the project
2. Design and Design Patterns - 10/8 - Plan out design, and design patterns
3. Layering - 10/13 - Plan out and revise layers
4. Exception Handling - 10/27 - Plan out and revise exception handling
5. Performance and Refactoring - 11/10 
6. Testing - 11/27 
7. Deployment and Packaging - 12/15 

**Unofficial deadlines:**
- 10/8  - be finished with all of our planning, complete with diagrams and class pseudocode.
- 10/22 - have a working product that can fetch data, display it, and filter that display based on parameters.
- 10/31 - have a working product with the trimmings added (user accounts, entering new stations, favoriting stations, and blacklisting stations.)
- 11/27 - have packaging, testing, and deployment details situated. Have the project online and fully functional.
After through the end of the semester: refactoring party.
- 12/9: -  have final code finished and submitted 

## Layering
* __Data Layer__ - This will contain JSON obtained from data sources, MySQL to obtain data from a database, and functions that read/modify/delete the data in/out, and abstract it to be able to work with it. The raw information, essentially, and ferrying it between the database and internal operations. May return errors to the business layer instead of data.

* __Business Layer__ - The application layer will direct this layer, and this layer will direct the data layer. Here are classes that work with the data layer, communication channels to the application layer, and provide server side security and validation:
  * __FuelStations__: This class has functions for retrieving fuel stations, and sending requests to modify existing stations and delete or add new stations from the data layer. This class will return fuel station objects, cache results as objects for speedier, subsequent searches,  or useful errors for data inconsistencies, no data results, incorrect input formatting, etc.
  * __Users__: Contains functions for sending requests to retrieve, modify, or add user accounts and data associated with those accounts to the data layer. Also responsible for enforcing role based permissions and security around each account. Will return user objects or useful error codes if any permissions are violated, input formatting errors, or security errors are thrown.
  * __Communication__: Has functions that are responsible for the message interface between this layer and the application layer. Functions will be used for filtering and returning only the correct results requested, errors pertaining to invalid user input, or any other error returned from the other classes and data layer.
  * __Exceptions__: Contains the definitions, behaviors, and objects for errors that can occur.
  * __Log__: Contains functions for custom logging. Examples of logs could be errors that occur, additions/modifications/deletions to fuel stations/users, bad authentication attempts, etc.

* __Application Layer__ - Classes that work with the business layer: directing it. The application layer will be application-specific business logic that works with that data on the level of our application - receiving a request for data from the user (who's interacted with the presentation layer) then asking the business layer to fetch appropriate data, which asks the data layer for that data and passes it back up. Contains error handling. If we wanted to change what our application does, we would change this.
  * __Map__: This class has functions to populate the map with fuel stations based on user's request.
  * __List__: This class has functions to get all the stations and sort them into a list ordered by fuel stations closest to requested location and based on user's filters.
  * __Errors__: If there are any errors/exceptions that reach this layer, this class has functions that will format the errors to be useful to the user.
  
* __Presentation Layer__ - This is the layer that faces the user, takes actions from the user, passes requests to the application layer, and accepts output from the application layer to display to the user. There are no classes per se, but there are other aspects that can be defined:
  * __Views__: There will be many views associated with this layer. There will be an initial search screen where users can query for specific fuel stations, a list view of returned stations, a map view displaying pins on where the stations are geographically, user creation screens, and user account screens.
  * __User Inputs__: Searches for fuel stations will not contain user typed text, there will be checkboxes, dropdowns, and other UI elements for conducting queries. The only user typed text will be inputs for user account information. There will also be buttons for users to save favorite fuel stations for later use.
  

**Additional layering requirements:**
* In the layered architecture, each layer sends to only one other layer and receives from only one other layer. There should not be a separate infrastructure for communicating between all layers, because they don’t all communicate. 

    *data layer->business layer->application layer->presentation layer.*
    
* the data layer should be the only layer with sql. 
* the presentation layer should be the only layer that communicates with the end user.

## Exception Handling
All php and JavaScript errors will be accounted for and handled. No fatal exceptions will be presented to the user or be allowed to hinder the user experience.

**Potential types of Exceptions:**
- AssertionError  - one value is expected to be something else. For example, trying to evaluate JSON that's actually a null value. Along with this error, JavaScript JSON parse errors will also have to be handled.
- RangeError      - an argument was not within the range or set of acceptable values for a function; an example could be the application trying to apply mathematical calculations to a radius of -1.
- TypeError       - an argument was not an allowable type; an example could be trying to treat a string as a radius with mathematic calculations if the user is allowed to put in an invalid type of radius data.
- Undefined Error - These must be avoided as we cannot have unexpected data or try to use unassigned variables.

Other errors for tools being used: 
* Google Maps API - there are a number of errors that can come for the google maps api. Here's a [link](https://developers.google.com/maps/documentation/javascript/error-messages) to all of them.
* Database connection/other errors - In order to handle database errors successfully, we will use PDO so that we can use a try/catch block. 
* Errors concerning the data source (API) - The documentation for the API to access the data has detailed error descriptions of possible errors that can occur for a certain call. For example: A request to GET all stations only has only one possible error of 422 ([unprocessable entity](https://developer.nrel.gov/docs/transportation/alt-fuel-stations-v1/all/#errors))
* System errors - Servers could go down, user tries to navigate to a nonexistent page, etc. Ideally, some sort of notification system will be put in place to monitor the activity and accessibility of the server. Since we are not hosting the app on our own servers, however, most of the system side errors will be out of our control.

**Example of Exception handling:**
    

    try {
        stationCity = getCity(stationNum);
        return stationCity;
    } catch (e) {
        return console.error(e);
    }
    
    
For JavaScript errors, we will catch any exceptions in the web browser console, then correct them so that they do not occur.
    
**In what layer will the back-end exceptions stop?**

The application layer. At that level, exceptions will be formatted for output to the presentation layer, including generic catch-alls for unknown failures.
    
**Who should respond to exceptions and errors?**

Whoever is able to fix them. Database connection errors are the responsibility of the DBA for whichever database is connected to this application; on the other hand, for unknown errors that can't be resolved, contacts to the makers of the application will be available or whatever help system we decide to put in place before deployment.

## Performance and Refactoring

There are different things that will have to be taken into account depending on the layer of the application in terms of performance. For the presentation layer, there are JavaScript pitfalls that you have to be aware of to avoid inhibiting the user experience:
* Interacting with the DOM takes time. To optimize performance, we aim to minimize the amount of times JavaScript hits the DOM. For example: When generating the list of nearby fuel stations, we will generate all of the HTML in JavaScript, then do a single append. Appending each element as it's created causes the browser to stutter and makes the app slow to use.
* If parsing a ton of different fuel stations or data from the db, webworkers can be used to spin up a separate thread. This means that the main browser thread won't be bogged down by the processing and allow for a smooth user experience.

For the business layer and below, the way we are using PHP means that it won't be interacting with the DOM like JavaScript will. Since we have a significant amount of data, though, php will run out of memory if we try to process the entire data set of fuel stations. To handle this and to parse the json into SQL, we will be parsing the data state by state. Once one state is finishing parsing, it will signal the script to grab the next state in the list until all states have been parsed into the database.

On top of language specific performance factors, general coding practices will also help:
* Follow the DRY principle when writing code
* Stick to the MVC architecture and layered approach to keep code clean and consitent
* Have a rolling test plan to weed out bugs during development instead of after all the code has been written

At the data level, we already refactored our initial plan for the database design. The table for FuelStations was becoming bloated, so we pulled out attributes that belonged only to specific types of stations and would've duplicated NULL values for any station not of that type; we also pulled out any attribute that justified its own table because it had multiple fields of information about itself. We may further refactor this design and continue to extract pieces of FuelStation into smaller tables, or we may merge some of the smaller tables for simplicity.

Once more code gets written, a refactoring plan will be put into place if need be.

## Testing
We decided to use Jest, a Javascript testing framework, for our front end unit tests. The tests are stored outside of the app directory to ensure easy removal before deployment. 

Unit tests are created alongside their relevant source code, allowing us to check the validity of it with a colorful array of potential input, both valid and invalid.

Some qualities and features that will invariably require testing to examine their behavior across varying outcomes of success and failure:
* retrieving/refreshing the list of stations from the API into the DB (What if we have an invalid DB login? What if we get an invalid list of stations?)
* if an inputted username is a valid username (Not empty, containing valid characters only, etc.)
* if an inputted password is a valid password (Same as username, along with potential criteria: minimum length? Must have numbers?)
* the search in particular (Do we retrieve a list of valid stations by address? ZIP? State? What if someone enters an invalid radius? What if the map couldn't be loaded and we try to search stations anyways?)

**Example:** unit testing to check the validity of that radius.

**radius.js**
```
module.exports = {};

function setVal(val, defaultVal) {
	return (typeof val == 'undefined') ? defaultVal : val;
}

module.exports.maxRadius = function maxRadius(a) {
	var maxRad = setVal(a, 100);
	return maxRad;
}

module.exports.getRadius = function getRadius(a) {
	var getRad = setVal(a, 50);
	return getRad;
}
```

**radius.test.js**
```
const radius = require('./radius');

test('radius is valid: more than 0 but less than max size', () => {
	expect(radius.getRadius()).toBeLessThanOrEqual(radius.maxRadius());
	expect(radius.getRadius()).toBeGreaterThan(0);
});
```

**Output:**
```
$ npm test

> vendor@1.0.0 test C:\Users\Ren\Desktop\ISTE432\unittests
> jest

PASS .\radius.test.js
  √ radius is valid: more than 0 but less than the max size (9ms)

Test Suites: 1 passed, 1 total
Tests:       1 passed, 1 total
Snapshots:   0 total
Time:        1.188s
Ran all test suites.
```

The unit tests allow the radius to be passed in, and assumes a default value (for a baseline) in the event that none is. When the radius value is tested after attempted submission of the search form, it'll be able to be checked against these constraints.

**Example:** unit testing to check whether a map object was successfully created. This test is incomplete, not cohesive enough, and needs to be modified: what if there's a different starting latitude/longitude? Can we check to ensure that the map is actually a map? Can we check to ensure it contains the data it should? This probably would be better off refactored into several unit tests.

**Output:**
```
$ npm test

> vendor@1.0.0 test C:\Users\Ren\Desktop\ISTE432\unittests
> jest

PASS .\radius.test.js
PASS .\index.test.js

Test Suites: 2 passed, 2 total
Tests:       3 passed, 3 total
Snapshots:   0 total
Time:        1.166s
Ran all test suites.
```

Overall, while Jest is especially popular for usage with React, with Javascript itself it's proven to be a very lightweight, easy-to-use testing platform.

## Deployment and Packaging
* This project is public in Github. We will include instructions for cloning it or downloading it, along with other potential additional deployment options like a hosted live version.
