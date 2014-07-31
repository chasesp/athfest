Logan Henry, Jason Kirby, William C Spivey
Csci 4300 Spring 2014
Athfest web app

How to compile:
    Requires Ant, Tomcat6, PHP-JavaBridge (found at 'php-java-bridge.sourceforge.net/pjb')
    PHP-JavaBridge jar files need to be placed in the shared Tomcat6 lib directory
    MySQL login is user: 'someuser', passwd: 'password'
    Run Ant in the source directory to generate the Ath war file

How to run:
    Start Tomcat6 and navigate your web browser to '172.17.152.41:8080/Ath'
    App is currently deployed and working.



WORK BREAKDOWN

Logan Henry:
jQuery implementation
Front end design (html, css)
mobile adaptation
app presentations

Jason Kirby:
database interaction (accounts, events, etc.)
page redirection logic
error pages
new user creation
itinerary creation

William C Spivey:
deployment (Ant, Tomcat6 config)
event population & formatting
dynamic content generation (upcoming events, itineraries)
itinerary logic
