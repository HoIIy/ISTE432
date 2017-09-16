#### Milestone 1 - Requirements (September 15, 2017)
#### By Maggie Jin, Holly Borrino, and Ian Kitchen 



## Glossary

* __Fuel Type__ - Definition. //todo


## Current System

There are several current systems for accomplishing what our application will do. One is to search on Google Maps - but aside from them being mixed in with other labels, they don't automatically show some of the details our application will, such as fuel type. Another is to use the U.S. Department of Energy's [station locating site](https://www.afdc.energy.gov/locator/stations/), but the mobile version only provides a static map with written directions in a user-unfriendly format, and still lacks some of the functionality that ours would have (for example, being able to favorite stations!).


## Goals

We plan on designing and building an alternative-fuel-station mapping application that addresses the problems identified by the stakeholders we interviewed. Our solution will provide the following additional functionalities and changes:
* Users can search for public or private stations with their convenience.
* Users can search for stations by location: street name, city, zipcode, or state.
* Users can search for certain types of fuel provided by the station. 
* Planned stations would be listed and differentiated from open stations.
* Users can know what kind of card the stations will accept.
* Users can favorite their preferred stations, or blacklist ones they do not wish to see.


## Stakeholders

* Vehicle Owners
    * The customers who would search for the fuel stations that near them. They may be searching for emergency usage, general everyday use, or for a different reason.
    
* Fuel station owners
    * Can search for stations, both open and planned, for purposes of business competition or for personal use. As an optional planned feature, they may be able to input owner-specified information about their specific station.
    
    
## Scope

The scope of this project is an application that allows users to search for alternative fuel locations and narrow down search results by name, status (open, planned, or temporarily unavailable), fuel type (BD, CNG, E85, ELEC, HY, LNG, LPG), ownership (subtypes are essentially public, private, or governmental), vicinity (within x number of miles/km), payment method (cash, check, Visa, etc.), electrical equipment charging level  connector type, and location (address). Selecting a fuel location will display additional details, such as expected availability date for planned stations or hours of operation. 

We are integrating with the Google Maps API to allow us to let it handle many aspects of visualizing data, creating marker clusters, and creating a URL that can open a chosen location directly in Maps for mobile driving directions.

For purposes of this project and its time limitations, we are triaging plans to prioritize core functionalities, i.e. being able to use the map at a basic level to find available stations and pick one for directions, and build desired but ultimately optional features last, such as user-inputted new stations.

We are also limiting the scope of our app geographically to the United States, as we cannot reliably gather information on international locations.


## Inputs

The following inputs will be used:

* Users will enter in their address and/or zipcode manually to be able to run search queries OR allow automatic access of device location.
* Users can filter search results by private, public, or both, along with fuel type, payment type, and owner type, via selection dropdowns or a similar preset list of options.
* Users can increase or decrease the radius size that the search results bring back - likely by numerical input.
* Users can create a user account by entering an email, username, and password in the appropriate form.
* Users can press a button to save fuel stations for quicker access to frequently used stations, or mark a station as undesirable and hide it from future searches.
* Fuel station data will be gathered automatically from from a publically available API from NREL (National Renewable Energy Laboratory).
* Users who have logged in can enter data about new fuel stations that aren't currently in the database by selecting an unmarked spot on the map and confirming creation of a new visible-only-to-them landmark, along with selecting appropriate details about it; the system will automatically flag more than 10 users entering a new station within a reasonable radius and an administrator will be able to confirm the existence of a station, allowing it to be visible to everyone. 


## Processing

* Location data that is retrieved from user input or auto-calculated, distance radius and filter options will be used to search for matching fuel stations.
* New fuel locations inputted by users or when GET responses are returned from the API will be checked against existing entries to avoid data duplication.
* New account creations will be checked against existing accounts to avoid duplicate accounts.
* Location data will be run through the google maps API to get accurate location descriptions.


## Outputs

* The output will show a list containing the information about fuel stations that match distance radius and filters. Info will include the name, address, phone number, station status, fuel types, private, public or both, and payments that are accepted at the station.
* Users who created accounts will have a component displaying their username, email, and an option to change password. There will also be a list of favorited fuel stations and hidden fuel stations.
* After submitting a request to add a new fuel station, the user will get feedback stating whether this fuel station already exists, or a confirmation that the request has been submitted.
* A user-hidden undesirable station will be removed from subsequent map searches.

## Data Sources

* __[API](https://developer.nrel.gov/docs/transportation/alt-fuel-stations-v1/all/)__ - This includes a a description of the data and a GET request to retrieve the full list of alternative fuel stations in the nation.
* __[Alternative Fuels Data Center](http://bit.ly/2eZh0EH)__ - This is the app that used the same set of data with the purpose of finding a station using GET requests from the users.
* __[Google Maps API](https://developers.google.com/maps/documentation/javascript/)__ - The google maps API for accurate and concurrent location data.
