#### Milestone 2 - Development Book (September 21, 2017)
#### By Maggie Jin, Holly Borrino, and Ian Kitchen 



## Team Members and Roles

As our team only has three members, there will inevitably be overlap between roles; specific work will be able to be claimed by team members closer to its milestone deadline, as schedules change and availability shifts.

However, we do have roles that team members are individually responsible for unless otherwise is agreed upon at a later date. One member may occupy more than one role, and roles can be formally split between members if appropriate. As team projects can be difficult to successfully organize, these roles come with the implicit understanding that individual work must be done significantly in advance before a deadline: so, in the event of illness, catastrophe, or any other inability to complete the designated work, another team member will have enough time to pick up the slack.

* __Project Manager__ - ? - accounts for overall coordination of project, checking in with members, monitoring deadlines, and ensuring that work is steadily progressing.

* __Document Writer__ - __Holly__ - responsible for the textual non-code documents with the project, especially during the planning process. Still works together with other members on the composition of those documents, but accounts for file formatting, proofreading, and overall quality checking of written submissions. May write more than 1/3 of the content too.

* __Application Designer__ - ? - responsible for the design of the program, especially during the planning process; still works with the other members on the composition of the program and discussion about the merit of the design choices, but accounts for diagrams, rough-draft explanations of the application design, being able to articulate the reasoning behind choices, ultimate choice of design pattern, and overall quality checking of the chosen design. Responsible for more than 1/3 of the input and brainstorming, too.

* __~~code monkey~~ ~~script slave~~ Application Programmer__ - ?/? - responsible for the creation of the program...of course not entirely; the role should be shared by two members volunteering to do more than 1/3 of the actual coding process to allow the third to focus on the incidental requirements, refactoring, testing, etc. Application programmers are responsible for being able to articulate coding choices and what the produced code does on a step-by-step level, especially any deviations from the original design plan, along with ensuring that the third person is staying current with their understanding of the product.

* __Application Tester__ - ? - responsible for testing the final creation: mainly writing unit tests and any documentation needed to accompany that. Ideally, we're planning on two application programmers and a third application tester whose job is to (preemptively and eventually) flush out bugs by doing their best to break what the others initially constructed.

## Background


## Project Description


## Project Requirements

The project must:

* face potential issues with data input
* face potential issues of data integrity
* be amenable to the specification and use of design patterns
* use a layered architecture4.provide exception handling in a layered manner
* include testing
* require some authentication and authorization work
* include user help of some kind8.be packaged for some degree of portability
* be refactored to some extent near the end of the semester 
* be designed with cognizance of potential regulatory issues

Additional requirements:

* must not use any zip files except to bundle code.
* must present "this" (and likely any other textual document) as a pdf, markdown, html, or a format agreed uponby the instructor (not proprietary, not ms office).
* pictures should be presented in the pdf or in separate files readable by the instruc-tor (not proprietary, not visio or bmp). We will expect to use **png** format.
* as we revise this document, we must provide a way to see how it has changed. For instance, if we change the technologies used, the section should still list the original technologies planned to be used in a subsection where we describe why we switched. We plan to use **appropriate subsections** along with **commenting updated changes in git commit comments** so we can easily track what changed when.
* in the tiered architecture, each layer sends to only one other layer and receives from only one other layer. There should not be a separate infrastructure for communicating between all layers: because they don’t all communicate. **data layer->business layer->application layer->presentation layer.**
* the data layer should be the onlylayer with sql. 
* the presentation layer should be the only layer thatcommunicates with the end user.

## Business Rules

## Technologies Used

## Timeline

## Layering

## Exception Handling
"lease add a section toyour development book identifying exceptions and categories ofexceptions you expect to account for in your code. You must in-clude examples of actual exception-handling code in this mile-stone."
No exceptions should ever be passed to the user. Almost no exceptions shouldever be passed to the presentation layer. Most exceptions shouldbe handled in an application, business, or data layer. Identifyingthem should also identify the kind of person who should respondto them. I have often encountered DBAs who insisted that the re-sponsibility lay with an “application owner” and application devel-opers who insisted that the same responsibility lay with the DBAand “application owners” who insisted that they were paying forsomebody else to figure this out.
when an exception is thrown, it can be handled or passedup the layers. You have to make a decision for each “try / catch”whether you want to handle the exception here or elsewhere. I am not asking for an exception handling section of thedesign but rather an expansion of the layered architecture descrip-tion that shows us how and where exceptions are handled."
*^ replace this later; just a placeholder note for what should go here*

* Where will exceptions ceased to be passed on?  
* What is the kind of person who should respond to them?

## Performance and Refactoring
"Give examples of code there or coding practices there that youare doing to improve performance of your project. For projectswhere we identified refactoring opportunities, carry those out andall groups should include their current code with the document.The best case would be to put pointers in the document (e.g., file-names and line numbers or classnames and offsets) rather thancode fragments in the document.Improve your existing code and respond tosurprisinginstruc-tions from management. This milestone may be particularly stress-ful depending on how well you have completed the previous mile-stones. Thesurprisinginstructions will test the quality of your codethus far."
*^ placeholder*

## Testing
"lease add a section to your devel-opment book identifying your testing framework. Please includespecific code and diagrams as appropriate. Instrumented code andbuild files should be in separate files from the development bookor simply included in the document as appendices and explainedn a section in the main body. Whether you include them as ap-pendices or separate files, they should be displayed with line num-bers so you can make references to specific parts in the narrative inthe testing section of the development book. It needs to be unam-biguous as to which file or appendix you are referencing in yournarrative.Don’t make implicit assumptions. Be specific even to the pointof being tedious in your explanations. I am not looking for broadcoverage so much as good coverage of whatever you do test. Also,even though I say I am not looking for broad coverage, the exam-ples you do use should not be trivially different versions of eachother.

The Wikipedia entry onUnit Testingsays the following aboutunit testing. Please be sure to include a unit test that conforms tothis specification for your database layer.Because some classes may have references to other classes, test-ing a class can frequently spill over into testing another class. A com-mon example of this is classes that depend on a database: in orderto test the class, the tester often writes code that interacts with thedatabase. This is a mistake, because a unit test should usually notgo outside of its own class boundary, and especially should not crosssuch process/network boundaries because this can introduce unac-ceptable performance problems to the unit test-suite. Crossing suchunit boundaries turns unit tests into integration tests, and when testcases fail, makes it less clear which component is causing the failure.See alsoFakes, mocks and integration tests.Instead, the software developer should create an abstract inter-face around the database queries, and then implement that interfacewith their own mock object.  By abstracting this necessary attach-ment from the code (temporarily reducing the net effective coupling),the independent unit can be more thoroughly tested than may havebeen previously achieved. This results in a higher-quality unit thatis also more maintainable.In particular, please create a mock object to mimic your database.It should exhibit the same interface as your database although itwill respond in a canned manner. This is described in the Wikipediaentry for mock object."
*^placeholder*

## Deployment and Packaging
"Please add a section toyour development book detailing everything needed for packagingand deployment. This should include README files or whateveris provided so that a user with no access to you can simply installand run your app based on the info you provide here or whichis pointed to from this location. For example, if your app can becloned from github, you should point to the location and provideany instructions needed in addition to the relevant git commands.These instructions should include any required packages of anykind. As another example, if your app is hosted on a website, pro-vide complete instructions for setting it up on someone else’s web-site. There should be some kind of package that can be delivered toa client and used without the personal intervention of your team.Finally, you should include a help specification, detailing whatkinds of help would be provided in a full-blown installation of yourapp. There is probably not time to create a full-blown help systemso provide a substantive example of help for your system by pickingone aspect of your app as a target for help."
*^ placeholder*
