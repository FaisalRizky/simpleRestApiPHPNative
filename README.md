# [PHP] Simple API Project for Transactions
 Create database schedule to accomodate storing event data and export functionalities through HTTP API. There are 2 Service with different endpoint.
 Create PHP Script to update status of a table. 

### Service

Service and Endpoint will listed as below:

| Service | Method |Akses | Description
| ------ | ------ | ------ | -----
| Create Transaction | POST | /api/transactions?references_id={id}&merchant_id={id} | Service to Create Transaction
| Get Transaction Status| GET | /api/transactions | Service To Get Transaction Status 

### Prequisite
- Go to Root folder
- Import Ticket.postman_collection.json postman
- Import Ticketing System.postman_environment.json postman

## Installation
- Run below script.(Please Run all the command on root project folder)
```sh
composer install
```

- Rename .env.example to .env, setup .env to match your database enviroment
- Migrate database using below command
```sh
vendor/bin/phinx migrate 
```

- Add Dummy data by using below command
```sh
vendor/bin/phinx seed:run 
```
Screenshot https://ibb.co/sq7c1sS

- Run the project by using php cli or webserver like xampp
	- Php Cli run below script
	```sh
		php -S localhost:8000 
	```

	- With Xampp you just need to copy entire folder to htdocs


## Testing Endpoint
- GET Transaction Result go to browser url: {base_url}/api/transactions.php?references_id=81261525251515&merchant_id=64649119122151
- POST New Transaction	to test this api please use CURL or Postman
	- use Curl, open new terminal/cmd (make sure service is running), run
	```sh
		curl -X POST -H "Content-Type: application/json" --data '{"invoice_id" : "AJHSY13I100121","item_name"  : "MI 10 PRO","amount"     : "12000000","payment_type":"Virtual Account","customer_name": "Post Bro","merchant_id" : "77181001JSGSS"}' http://localhost:8000/api/transactions.php
	```
	- by Postman
		import setting from collection.json to your postman and run it

Screenshot 
GET Postman https://ibb.co/NFhmSVS
Post Postman https://ibb.co/Vj60YLw

GET by Browser Url https://ibb.co/CQszKh4
Post by CURL command  https://ibb.co/zS5hPgf

## Testing Update Status Script
- Run below script.(Please Run all the command on root project folder)
	```sh
			php bin/transactions-cli.php {references_id} {status}
	```
- Example
	```sh
			php bin/transactions-cli.php 81261525251515 Pending
	```

Screenshot : https://ibb.co/NmDG1DT


## Important Notes
Enviroment used to test
- PHP version 7.2.18
- MYSQL : 5.0.12
- Web Server Apache/2.4.43 (Win64) 
- Using PHP Cli on testing
- If using webserver Xampp please change url to http://localhost:8000/{projectName}/api/transactions (add project name, remove extension .php)
- Test done in port 8000