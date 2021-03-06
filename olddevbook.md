#### Milestone 2 - Development Book (September 21, 2017)
#### By Maggie Jin, Holly Borrino, and Ian Kitchen 



## Team Members and Roles

As our team only has three members, there will inevitably be overlap between roles; specific work will be able to be claimed by team members closer to its milestone deadline, as schedules change and availability shifts.

However, we do have roles that team members are individually responsible for unless otherwise is agreed upon at a later date. One member may occupy more than one role, and roles can be formally split between members if appropriate. As team projects can be difficult to successfully organize, these roles come with the implicit understanding that individual work must be done significantly in advance before a deadline: so, in the event of illness, catastrophe, or any other inability to complete the designated work, another team member will have enough time to pick up the slack.

* __Project Manager__ - __*Holly*__  - accounts for overall coordination of project, checking in with members, monitoring deadlines, and ensuring that work is steadily progressing.

* __Document Writer__ - __*Holly*__ - responsible for the non-code documents with the project, especially during the planning process. Still works together with other members on the composition of those documents, but accounts for file formatting, proofreading, and overall quality checking of written submissions. May write more than 1/3 of the content too.

* __Documentation Writer__ - __**__ - responsible for the code's documentation with the project: comments, headers, formatting, and help resources. Still works together with other members on the composition of those documents, but accounts for quality of them and may write more than 1/3 of the content.

* __Application Designer__ - __*Maggie*__ - responsible for the design of the program, especially during the planning process; still works with the other members on the composition of the program and discussion about the merit of the design choices, but accounts for diagrams, rough-draft explanations of the application design, being able to articulate the reasoning behind choices, ultimate choice of design pattern, and overall quality checking of the chosen design. Responsible for more than 1/3 of the input and brainstorming, too.

* __Application Programmer(s)__ - __*All (small team)*__ - responsible for the creation of the program...of course not entirely; the role should be shared by all members volunteering to do about 1/3 of the actual coding. Application programmers are responsible for being able to articulate coding choices and what the produced code does on a step-by-step level, especially any deviations from the original design plan.

* __Application Tester__ - __*Ian*__ - responsible for testing the final creation: mainly writing unit tests and any documentation needed to accompany that. Ideally, we would plan on two application programmers to each designated application tester, so the latter could preemptively and eventually flush out bugs by doing their best to break what was initially constructed, but the size of our current working team makes dividing up code between two people too potentially difficult.

## Background
[This is the background of the problem that inspired the project or the circumstances that caused the project. You might also include in this section anything that you know about prior efforts along the same lines such as GitHub repos you might have encountered the deal with the same thing. You might also mention articles that you've read about the problem or about possible solutions to the problem.]

Our project was inspired by browsing publically available data sources and thinking of uses for them that we couldn't immediately think of as being covered by another project or application. The main alternative available is the [energy.gov locator](https://energy.gov/maps/alternative-fueling-station-locator) that lacks functionality we'd like to have, like user accounts and tracking personal preferences towards stations. It comes with a [mobile app](https://itunes.apple.com/us/app/alternative-fueling-station-locator/id718577947?mt=8), but the top review is criticism from a customer who dislikes that it "defaults to Apple maps - and in a Metropolis, where there are Transits... there's no option or any way to open the destination / route in Google maps." The user also disliked that there is "no way to copy the address to paste it into Google". Another user lamented lacking "the ability to redo a search in that area (like yelp or google maps has)". Google Maps is a widely used application; I can see how this lack of capability would become unpleasant quickly.

As for Githubs, there's several: [a Ruby program that uses the same API as us](https://github.com/rshakhb10/alternative-fuel-stations-locator) for the same purpose, but only allows filtering by state, zipcode, and type of fuel.

[A more sophisticated alternative](https://github.com/Traci7822/alternative_fuel_stations) from Traci7822 is an application that uses AngularJS, Rails, and Socrata Open Data API; however, it suggests installing it by "clon[ing] or download[ing] the repository to your local machine, run[ning] bundle install, start[ing] a rails server and brows[ing] to to your localhost page", which is much less lightweight and portable than our planned deployment of a live website version and bundle of files that can be uploaded to any web directory.

## Project Description
Our project is an alternative fuel station locator. It's planned to be a mobile web application that allows users to open selected locations in their Google Maps mobile application, integrated with a MySQL database to be able to store persistent data about users.

## Project Requirements

The project must:

1. **Face potential issues with data input:**

    >"Users can search for stations by location: street name, city, zipcode, or state. Users will enter in their address and/or zipcode manually to be able to run search queries *or* allow automatic access of device location. Users can increase or decrease the radius size that the search results bring back - likely by numerical input." 
    
    Inputting a radius of "99999999999 km" is an example of potential input issues we expect to handle.
    
2. **Face potential issues of data integrity:**

    > "Users can create a user account by entering an email, username, and password in the appropriate form." 
    
    Creating a user account and attempting to make the email an emoji is an example of potential data integrity issues with this project. Or designing the database column 'name' to be 20 chars long but accepting a 25 char username at the application level and attempting to insert it anyways.

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
["Identifying and documenting business rules are very important to the database design. Business rules allow the creator to develop relationship participation rules and constraints and to create a correct data model. They also allow the creators to understand business processes, and the nature, role and scope of the data. They are a communication tool between users and creators, and they also help standardize the company’s view of the data. It is important to keep in mind that some business rules cannot be modeled. Business Rules give the proper classification of entities, attributes, relationships, and constraints. Sources of business rules are managers, policy makers, department managers, written documentation, procedures, standards, operation manuals, and interviews with end users. Our textbook describes that as a general user the noun in a Business Rule will translate into an entity in the model and a verb (active or passive) associating nouns will translate into a relationship among the entities. Consider that business rules are bidirectional. The textbook also mentions that there are two questions to ask to properly identify Business Rules, how many instances of B are related to one instance of A? How many instances of A are related to one instance of B?

Some examples of business rules:
Departments ------offers---------Course
Course----------generates---------Class
Professor ->->->->->teaches->->->->->Class"]

**3 of our main business rules:**
* Admin->manages->Stations
* Map---displays---Stations
* GetData----generates----Map

## Technologies Used
Likely to be JSON for our data source and a combination of HTML, CSS, JavaScript, and jQuery that runs on a standard LAMP stack.

## Timeline
**Assuming deadlines remain consistently on Sunday nights:**
- ~~M1 - DONE~~
- M2 - 10/8 (plan out design, and design patterns)
- M3 - 10/13 (plan out/revise layers)
- M4 - 10/27 (plan out/revise exception handling)
- M5 - 11/10 (refactoring)
- M6 - 11/27 (testing)
- M7 - 12/15 (packaging)
- Final code: 12/9

**Unofficial deadlines:**
- 10/8  - be finished with all of our planning, complete with diagrams and class pseudocode.
- 10/22 - have a working product that can fetch data, display it, and filter that display based on parameters.
- 10/31 - have a working product with the trimmings added (user accounts, entering new stations, favoriting stations, and blacklisting stations.)
- 11/27 - have packaging, testing, and deployment details situated. Have the project online and fully functional.
After through the end of the semester: refactoring party.

## Layering
* __Daya Layer__ - Likely to be JSON obtained from data sources, MySQL data obtained from a database, and classes that read the data in/out and abstract it to be able to work with it. The raw information, essentially, and ferrying it between external sources and internal operations. May return errors to the business layer instead of data.

* __Business Layer__ - Classes that work with that data layer: modifying, fetching, deleting, or asking it to add data, for example, along with error handling for those operations. Universal business logic that could be reused in any other application that works with the same data.

* __Application Layer__ - Classes that work with the business layer: directing it. The application layer will be application-specific business logic that works with that data on the level of our application - receiving a request for data from the user (who's interacted with the presentation layer) then asking the business layer to fetch appropriate data, which asks the data layer for that data and passes it back up. Contains error handling. If we wanted to change what our application does, we would change this.

* __Presentation Layer__ - A web application that uses a combination of HTML, CSS, JavaScript, jQuery, and either NodeJS or PHP, depending on which we decide on shortly. This is the layer that faces the user, takes actions from the user, passes requests to the application layer, and accepts output from the application layer to display to the user.

**Additional layering requirements:**
* in the tiered architecture, each layer sends to only one other layer and receives from only one other layer. There should not be a separate infrastructure for communicating between all layers, because they don’t all communicate. 

    *data layer->business layer->application layer->presentation layer.*
    
* the data layer should be the only layer with sql. 
* the presentation layer should be the only layer that communicates with the end user.

## Exception Handling
["Please add a section identifying exceptions and categories of exceptions you expect to account for in your code. You must include examples of actual exception-handling code in this mile-stone. No exceptions should ever be passed to the user. Almost no exceptions should ever be passed to the presentation layer. Most exceptions should be handled in an application, business, or data layer. Identifying them should also identify the kind of person who should respond to them. I have often encountered DBAs who insisted that the responsibility lay with an “application owner” and application developers who insisted that the same responsibility lay with the DBA and “application owners” who insisted that they were paying for somebody else to figure this out. When an exception is thrown, it can be handled or passed up the layers. You have to make a decision for each “try / catch” whether you want to handle the exception here or elsewhere. I am not asking for an exception handling section of the design but rather an expansion of the layered architecture descrip-tion that shows us how and where exceptions are handled."]

All Exceptions thrown by NodeJS are instances of Errors. If we decide to use PHP as our server-side workhorse, Exceptions will likely be functionally similar but syntactically different.

**Potential types of Exceptions:**
- AssertionError - one value is expected to be something else. For example, trying to evaluate JSON that's actually a null value.
- RangeError     - an argument was not within the range or set of acceptable values for a function; an example could be the application trying to apply mathematical calculations to a radius of -1.
- TypeError      - an argument was not an allowable type; an example could be trying to treat a string as a radius with mathematic calculations if the user is allowed to put in an invalid type of radius data.

Other types of errors may be connection errors (if we can't connect to the Google Maps API, database, or other data sources), authorization errors (if we can connect to the API but have problems with our API key/can connect to the database but have problems with the database login), or system errors (servers down, user tries to navigate to a nonexistent page, etc).

* **Example of Exception handling:**
    try {
        stationCity = getCity(stationNum);
        return stationCity;
    } catch (e) {
        return console.error(e);
    }
    
* **Where will exceptions ceased to be passed on?**

    The application layer. At that level, exceptions will be formatted for output to the presentation layer, including generic catch-alls for unknown failures.
    
* **What is the kind of person who should respond to them?**

    On whoever is able to fix them. Database connection errors are the responsibility of the DBA for whichever database is connected to this application; on the other hand, unknown errors that can't be resolved should volunteer the option to contact the makers of the application or whatever help system we decide to put in place before deployment.

## Performance and Refactoring
["Give examples of code there or coding practices there that you are doing to improve performance of your project. For projects where we identified refactoring opportunities, carry those out and all groups should include their current code with the document. The best case would be to put pointers in the document (e.g., file-names and line numbers or classnames and offsets) rather than code fragments in the document. Improve your existing code and respond to surprising instructions from management. This milestone may be particularly stressful depending on how well you have completed the previous mile-stones. The surprising instructions will test the quality of your code thus far."]

**N/A on 9/30. (no code yet.)**

## Testing
["Please add a section to your development book identifying your testing framework. Please include specific code and diagrams as appropriate. Instrumented code and build files should be in separate files from the development book or simply included in the document as appendices and explained in a section in the main body. Whether you include them as appendices or separate files, they should be displayed with line numbers so you can make references to specific parts in the narrative in the testing section of the development book. It needs to be unambiguous as to which file or appendix you are referencing in your narrative. Don’t make implicit assumptions. Be specific even to the point of being tedious in your explanations. I am not looking for broad coverage so much as good coverage of whatever you do test. Also, even though I say I am not looking for broad coverage, the examples you do use should not be trivially different versions of each other.

Please be sure to include a unit test that conforms to this specification for your database layer. Because some classes may have references to other classes, testing a class can frequently spill over into testing another class. A common example of this is classes that depend on a database: in order to test the class, the tester often writes code that interacts with the database. This is a mistake, because a unit test should usually not go outside of its own class boundary, and especially should not cross such process/network boundaries because this can introduce unacceptable performance problems to the unit test-suite. Crossing such unit boundaries turns unit tests into integration tests, and when test cases fail, makes it less clear which component is causing the failure. Instead, the software developer should create an abstract interface around the database queries, and then implement that interface with their own mock object. By abstracting this necessary attachment from the code (temporarily reducing the net effective coupling), the independent unit can be more thoroughly tested than may have been previously achieved. This results in a higher-quality unit that is also more maintainable. In particular, please create a mock object to mimic your database. It should exhibit the same interface as your database although it will respond in a canned manner. This is described in the Wikipedia entry for mock object." *Basically, make a fake database (or fake 'whatever') for testing, don't test code doing something else that has to insert/delete in the process and have to figure out whether it's failing or your insert/deletion from the business layer is failing or your MySQL login information is incorrect or...etc. Test one thing at a time, period.*]

**N/A on 9/30. (no code yet.)**

## Deployment and Packaging
["Please add a section toyour development book detailing everything needed for packaging and deployment. This should include README files or whatever is provided so that a user with no access to you can simply install and run your app based on the info you provide here or which is pointed to from this location. For example, if your app can be cloned from github, you should point to the location and provide any instructions needed in addition to the relevant git commands. These instructions should include any required packages of any kind. As another example, if your app is hosted on a website, provide complete instructions for setting it up on someone else’s website. There should be some kind of package that can be delivered to a client and used without the personal intervention of your team. Finally, you should include a help specification, detailing whatkinds of help would be provided in a full-blown installation of your app. There is probably not time to create a full-blown help system so provide a substantive example of help for your system by picking one aspect of your app as a target for help."]

**Mostly N/A on 9/30. (no code yet.)** However, since we know we're using Github, we'll probably point to the location like that in the end. I also plan to host the application online, so I can host a help wiki with it, maybe? I saw that work really well in a past class's team projects.
