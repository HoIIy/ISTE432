#### Milestone 1 - Requirements (September 14, 2017)
#### By Maggie Jin, Holly Borrino, and Ian Kitchen 



## Glossary

* __Term__ - Definition.


## Current System

Description of the current system.


## Goals

We plan on designing and building alternitive fuel station mapping application that addresses the problems identified by the stakeholders we interviewed. Our solution will provide the following additional functionality and changes:
* Users could only search for public stations with their convenience.
* Users could search for the station with their request of location, zipcode or state.
* Users coud use search for certain fuel that provided by the station. 
* Planned stations would be listed and differentiate with open stations.
* One the side, users could know what kind of card the stations could accept.


## Stakeholders

* Stakeholder
    * Vehicle owners would want to search for the fuel stations that near them. It could be for emergency uses, general acknowledge uses or other kinds of uses.
    * Fuel station owners share their information in the table and they could search for the planned stations and opened stations for futures uses or other business uses. 
    
    
## Scope

This is a description of the scope of the project and its limitations. What are we accomplishing? What are we deliberately NOT doing and why?


## Inputs

The following inputs will be used:

* User will either allow location services to be used or enter in address and/or zipcode manually as a search query.
* User can filter search results by private, public, or both, fuel type, payment type, and owner type.
* User can increase or decrease radius size that the search results bring back.
* Fuel station data from from a publically available API from NREL (National Renewable Energy Laboratory).
* Users can create an account by entering an email, username, and password.
* Users can enter data about new fuel stations that aren't currently in the database.
* Users can press a button to save fuel stations for quicker access to frequently used stations.


## Processing

* Location data that is retrieved from user input or auto-calculated, distance radius and filter options will be used to search for matching fuel stations.
* New fuel locations input by users or when GET responses are returned from the API will be checked against existing entries to avoid data duplication.
* New account creations will be checked against existing accounts to avoid duplicate accounts.
* Location data will be run through the google maps API to get accurate location descriptions.


## Outputs

* The output will show a list containing the information about fuel stations that match distance radius and filters. Info will include the name, address, phone number, station status, fuel types, private, public or both, and payments that are accepted at the station.
* Users who created accounts will have a profile screen displaying their username, email, and an option to change password. There will also be a list of favorited fuel stations.
* After submitting a request to add a new fuel station, the user will get feedback stating whether this fuel station already exists, or a confirmation that the request has been submitted.


## Data Sources

* __[API](https://developer.nrel.gov/docs/transportation/alt-fuel-stations-v1/all/)__ - This includes a a description of the data and a GET request to retrieve the full list of alternative fuel stations in the nation.
* __[Alternative Fuels Data Center](http://bit.ly/2eZh0EH)__ - This is the app that used the same set of data with the purpose of finding a station using GET requests from the users.
* __[Google Maps API](https://developers.google.com/maps/documentation/javascript/)__ - The google maps API for accurrate and concurrent location data.
