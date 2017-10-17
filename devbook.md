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
Our project is an alternative fuel station locator. It's planned to be a mobile web application that allows users to open selected locations in their Google Maps mobile application, integrated with a MySQL database to be able to store persistent data about users and fuel stations.

## Project Requirements

The project must:

1. **Face potential issues with data input:**

    >"Users can search for stations by location: street name, city, zipcode, or state. Users will enter in their address and/or zipcode manually to be able to run search queries *or* allow automatic access of device location. Users can increase or decrease the radius size that the search results bring back - likely by numerical input." 
    
    Inputting a radius of "99999999999 km" is an example of potential input issues we expect to handle.
    
2. **Face potential issues of data integrity:**

    > "Users can create a user account by entering an email, username, and password in the appropriate form." 
    
    Creating a user account and attempting to make the email with improper formatting is an example of potential data integrity issues with this project. Or designing the database column 'name' to be 20 chars long but accepting a 25 char username at the application level and attempting to insert it anyways.

3. **Be amenable to the specification and use of design patterns:**

    We plan to use an Observer pattern on the application level, with a Subject/Observable that listens for requests to update, notifies Observers about them (i.e. user requests for data), then accepts new state and displays it.

4. **Use a layered architecture:**

    Our application will have separate data, business, application, and presentation layers. See the appropriate subsection of this document for more information on each layer's role.

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

* __Business Layer__ - The application layer will direct it, and it will direct the data layer. Here are classes that work with the data layer, communication channels to the application layer, and provide server side security and validation:
  * __FuelStations__: This class has functions for retrieving fuel stations, and sending requests to modify existing stations and delete or add new stations from the data layer. This class will return fuel station objects, cache results as objects for speedier, subsequent searches,  or useful errors for data inconsistencies, no data results, incorrect input formatting, etc.
  * __Users__: Contains functions for sending requests to retrieve, modify, or add user accounts and data associated with those accounts to the data layer. Also responsible for enforcing role based permissions and security around each account. Will return user objects or useful error codes if any permissions are violated, input formatting errors, or security errors are thrown.
  * __Communication__: Has functions that are responsible for the message interface between this layer and the application layer. Functions will be used for filtering and returning only the correct results requested, errors pertaining to invalid user input, or any other error returned from the other classes and data layer.
  * __Exceptions__: Contains the definitions, behaviors, and objects for errors that can occur.
  * __Log__: Contains functions for custom logging. Examples of logs could be errors that occur, additions/modifications/deletions to fuel stations/users, bad authentication attempts, etc.

* __Application Layer__ - Classes that work with the business layer: directing it. The application layer will be application-specific business logic that works with that data on the level of our application - receiving a request for data from the user (who's interacted with the presentation layer) then asking the business layer to fetch appropriate data, which asks the data layer for that data and passes it back up. Contains error handling. If we wanted to change what our application does, we would change this.

* __Presentation Layer__ - This is the layer that faces the user, takes actions from the user, passes requests to the application layer, and accepts output from the application layer to display to the user.

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

Other types of errors may be connection errors (if we can't connect to the Google Maps API, database, or other data sources), authorization errors (if we can connect to the API but have problems with our API key/can connect to the database but have problems with the database login), or system errors (servers down, user tries to navigate to a nonexistent page, etc).

* **Example of Exception handling:**
    ```
    try {
        stationCity = getCity(stationNum);
        return stationCity;
    } catch (e) {
        return console.error(e);
    }
    ```
    
    For JavaScript errors, we will catch any exceptions in the web browser console, then correct them so that they do not occur.
    
* **In what layer will the back-end exceptions stop?**

    The application layer. At that level, exceptions will be formatted for output to the presentation layer, including generic catch-alls for unknown failures.
    
* **Who should respond to exceptions and errors?**

    Whoever is able to fix them. Database connection errors are the responsibility of the DBA for whichever database is connected to this application; on the other hand, for unknown errors that can't be resolved, contacts to the makers of the application will be available or whatever help system we decide to put in place before deployment.

## Performance and Refactoring
[More information would be listed after refactoring the project]

## Testing
[More information would be listed after testing the project]

## Deployment and Packaging
* This project is public in Github. We will include instructions for cloning it or downloading it, along with other potential additional deployment options like a hosted live version.
