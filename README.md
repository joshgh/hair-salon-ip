# _Hair Salon_

#### _Web App to track stylists and clients at a hair salon, 23 September 2016_

#### By _**Joshua Huffman**_

## Description

_This web app allows a user to create a list of stylists at a hair salon and add clients for each stylist.  This project is the Independent Project for week 3 of the Epicodus PHP class._

## Setup/Installation Requirements

* Clone repository to computer
* Run composer install to install project dependencies
* Import hair_salon database into SQL server
* Start a web server with web/ as the root, can run "php -S localhost:8000" from terminal while within hair-salon-ip/web
* Visit localhost:8000 on your web browswer

## Database Setup
If unable to import database run the following SQL commands to recreate database

  * CREATE DATABASE hair_salon;
  * USE hair_salon;
  * CREATE TABLE stylists (id serial PRIMARY KEY, name varchar (255));
  * CREATE TABLE clients (id serial PRIMARY KEY, name varchar (255), stylist_id int);

  Then copy hair_salon structure to hair_salon_test

## Specifications
  Behavior|Input|Output
  --------|-----|------
  create a new Stylist|Sandra|Sandra
  delete a Stylist|Sandra|0
  list all stylists|Stylists|Sandra, Becky
  delete all stylists|Delete Stylists|0
  create a new Client|Jim|Jim
  delete a Client|Jim|0
  associate a client with a stylist|Jim to Sandra|Sandra:Jim
  list all clients for a stylist|Sandra|Jim, Bill
  delete all clients|Delete Clients|0


## Known Bugs
  SQL queries are not sanitized, will refactor project to use PDO prepared statements instead of directly inserting user input into queries. In current state project is vulnerable to SQL injection and some inputs will just cause query to fail.

## Support and contact details

_Contact me at j.m.huffman@gmail.com with any comments or questions_

## Technologies Used

_This project is writen in PHP and uses the silex framework and twig for templating._

### License

*MIT License*

Copyright (c) 2016 **_Joshua Huffman_**
