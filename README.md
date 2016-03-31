# Installation
* Download Code and place careaxiom folder into your "C:\xampp\htdocs\" folder.  
* Make a new database with name "careaxiom" in mysql and import database file "careaxiom.sql" from "C:\xampp\htdocs\careaxiom\database" folder.

#Design Pattern
* In this app i have build a RESTfull API (using Phil Sturgeon, Chris Kacerguis RESTful server) for the purpose of managing a Airport Entity. 

#Packages Used
* Phil Sturgeon, Chris Kacerguis RESTful server  
* Jamie Rumbelow MY_Model.php  
* phpUnit test framework

#Working
This API uses 4 methods to manage a complete entity. The methods working is given below.  
* GET Method is used for fetching a single Airport record.  
* PUT Method is used for adding a new Airport recod.  
* POST Method is used for updating an existing Airport record.  
* DELETE Method is used for deleting an existing Airport record.  

#Steps for running the Application
* Run Apache and MySQL server using xamp.  
* Use Advanced Rest Client for runing RESTful API Requests. 

**Basic Authentication Username and Password** 

* Username = admin
* Password = 1234

**HERE are some user Roles**  
* For Admin (Use user_id=1)
* For User (Use user_id=2)
* For Guest (Use user_id=3)

**For Adding New Airport Entity**  
Enter "http://localhost/careaxiom/api/airport" into URL field of Advanced Rest Client, select PUT method and add below given form fields and press "Send" Button. All fields are required. 

* airport_code  
* airport_name  
* country  
* city  
* user_id  

Test it with different User roles according to your requirements.  

**For Getting Existing Airport Entity**  
Enter "http://localhost/careaxiom/api/airport/id/{id_value}/user_id/{user_id_value}" into URL field of Advanced Rest Client, select GET method and press "Send" Button. Test it with different User roles according to your requirements.  

**For Updating Existing Airport Entity** 
Enter "http://localhost/careaxiom/api/airport/id/{id_value}" into URL field of Advanced Rest Client, select POST method add below given form fields and press "Send" Button. All fields are required.  

* airport_code  
* airport_name  
* country  
* city  
* user_id  

Test it with different User roles according to your requirements.  

**For Deleting Existing Airport Entity**  
Enter "http://localhost/careaxiom/api/airport/id/{id_value}/user_id/{user_id_value}" into URL field of Advanced Rest Client, select DELETE method and press "Send" Button. Test it with different User roles according to your requirements.  

**For Searching Existing Airport Entity by airport code**  
Enter "http://localhost/careaxiom/api/searchAirport/airport_code/{airport_code_value}/user_id/{user_id_value}" into URL field of Advanced Rest Client, select GET method and press "Send" Button. Test it with different User roles according to your requirements.

#Test Cases with phpUnit Framework  
Added a test case for getting a aiport value.  

**How to Run**  

If you have installed phpUnit in you system then follow the instructions to run test cases.  
* Open CMD  
* type cd C:\xampp\htdocs\careaxiom\application\tests
* type phpunit
* type phpunit
* type phpunit
* type phpunit
