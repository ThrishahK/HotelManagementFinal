create database hotelmanage;
use hotelmanage;

CREATE TABLE Customer (
    cust_phone VARCHAR(15) PRIMARY KEY,
    cust_name VARCHAR(100) NOT NULL,
    cust_mail VARCHAR(100) UNIQUE
);
INSERT INTO Customer (cust_phone, cust_name, cust_mail)
VALUES 
('1234567890', 'John Doe', 'john@example.com'),
('0987654321', 'Alice Smith', 'alice@example.com'),
('1122334455', 'Bob Johnson', 'bob@example.com'),
('2233445566', 'Charlie Brown', 'charlie@example.com'),
('3344556677', 'David Miller', 'david@example.com'),
('4455667788', 'Emma Davis', 'emma@example.com'),
('5566778899', 'Frank Wilson', 'frank@example.com'),
('6677889900', 'Grace Thompson', 'grace@example.com'),
('7788990011', 'Henry Moore', 'henry@example.com'),
('8899001122', 'Isabella Clark', 'isabella@example.com'),
('9900112233', 'Jack White', 'jack@example.com');
select * from Customer;

CREATE TABLE Hotels (
    hotel_id VARCHAR(20) PRIMARY KEY,
    hotel_name VARCHAR(255) NOT NULL,
    hotel_ratings DECIMAL(2,1),
    city VARCHAR(100),
    area VARCHAR(100),
    state VARCHAR(100)
);
INSERT INTO Hotels (hotel_name,hotel_id, hotel_ratings, city, area, state)
VALUES 
('Grand Palace','H001', 4.5, 'New York', 'Manhattan', 'NY'),
('Sea View Resort','H002', 4.2, 'Los Angeles', 'Santa Monica', 'CA'),
('Mountain Inn','H003', 4.8, 'Denver', 'Downtown', 'CO'),
('Urban Stay','H004', 4.3, 'Chicago', 'Loop', 'IL'),
('Sunset Retreat','H005', 4.6, 'San Francisco', 'Golden Gate', 'CA'),
('Royal Orchid','H006', 4.7, 'Miami', 'South Beach', 'FL'),
('Lakeview Lodge', 'H007',4.1, 'Seattle', 'Downtown', 'WA'),
('Skyline Suites','H008', 4.4, 'Dallas', 'Uptown', 'TX'),
('Emerald Bay Resort','H009', 4.9, 'Honolulu', 'Waikiki', 'HI'),
('Hillside Haven','H010', 4.0, 'Atlanta', 'Midtown', 'GA'),
('Luxury Stay','H011', 4.5, 'Las Vegas', 'The Strip', 'NV');
select * from Hotels;

CREATE TABLE Bookings1 (
    booking_id VARCHAR(40) PRIMARY KEY,
    cust_phone VARCHAR(15),
    hotel_id VARCHAR(40),
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    state varchar(20)
);

INSERT INTO Bookings1 (booking_id,cust_phone, hotel_id, check_in_date, check_out_date,state)
VALUES 
(1,'1234567890', 'H001', '2025-04-01', '2025-04-05','booked'),
(2,'0987654321','H002', '2025-05-10', '2025-05-15','booked'),
(3,'1122334455', 'H003', '2025-06-20', '2025-06-25','booked'),
(4,'2233445566', 'H004', '2025-07-05', '2025-07-10','booked'),
(5,'3344556677', 'H005', '2025-08-12', '2025-08-17','cancel'),
(6,'4455667788', 'H006', '2025-09-25', '2025-09-30','booked'),
(7,'5566778899', 'H007', '2025-10-14', '2025-10-19','booked'),
(8,'6677889900', 'H008', '2025-11-03', '2025-11-08','booked'),
(9,'7788990011', 'H009', '2025-12-22', '2025-12-27','booked'),
(10,'8899001122', 'H010', '2026-01-15', '2026-01-20','booked'),
(11,'9900112233', 'H011', '2026-02-28', '2026-03-04','booked');
select * from Bookings1;


CREATE TABLE DININGs (
    dining_id VARCHAR(20),
    dining_type VARCHAR(20),
    dining_time TIME,
    dnumber INT, 
    veg BOOLEAN,
    non_veg BOOLEAN ,
    Hotel_name VARCHAR(30),
    cust_phone VARCHAR(15) ,
    state varchar(20)
);
INSERT INTO DININGs VALUES(1, 'rooftop', '19:00:00', 1, TRUE, TRUE,'The Golden Fork Inn','1234567890','booked');
INSERT INTO DININGs VALUES(2, 'cafe', '10:00:00', 2, TRUE, FALSE,'Saffron Stay & Dine','0987654321','booked');
INSERT INTO DININGs VALUES(3, 'bar&restaurant', '21:00:00', 3, FALSE, TRUE,'The Silver Spoon Suites','1122334455','canceled');
INSERT INTO DININGs VALUES(4, 'buffet', '13:00:00', 4, TRUE, TRUE,'Velvet Palate Resort','2233445566','booked');
INSERT INTO DININGs VALUES(5, 'beachside', '18:30:00', 5, TRUE, TRUE,'Oceanview Dining Lodge','3344556677','booked');
INSERT INTO DININGs VALUES(6, 'rooftop', '20:30:00', 6, FALSE, TRUE,'Royal Spice Haven','4455667788','booked');
INSERT INTO DININGs VALUES(7, 'cafe', '09:30:00', 7, TRUE, FALSE,'Emerald Plate Hotel','5566778899','booked');
INSERT INTO DININGs VALUES(8, 'bar&restaurant', '22:00:00', 8, FALSE, TRUE,'Moonlit Bites Retreat','6677889900','booked');
INSERT INTO DININGs VALUES(9, 'buffet', '12:30:00', 9, TRUE, TRUE,'The Rustic Table Inn','7788990011','booked');
INSERT INTO DININGs VALUES(10, 'beachside', '19:30:00', 10, TRUE, TRUE,'Sunset Flavors Hotel','8899001122','booked');
INSERT INTO DININGs VALUES(11, 'rooftop', '18:00:00', 11, TRUE, TRUE,'Crimson Dish Residency','9900112233','booked');
select * from DININGs;


CREATE TABLE TAKEWAYS (
    order_id VARCHAR(30),
    item_name TEXT,
    delivery_location TEXT,
    hotel_name VARCHAR(30),
    order_status VARCHAR(30),
     cust_phone VARCHAR(15) ,
    PRIMARY KEY(order_id)
);

INSERT INTO TAKEWAYS VALUES('1', 'Spicy Szechuan Noodles', '10, MG Road', 'The Golden Fork Inn', 'ordered', '9990000001');
INSERT INTO TAKEWAYS VALUES('2', 'Crispy Honey Glazed Chicken', '22, Linking Road', 'Saffron Stay & Dine', 'ordered', '9990000002');
INSERT INTO TAKEWAYS VALUES('3', 'Creamy Tomato Basil Soup', '3/45, Park Street', 'The Silver Spoon Suites', 'ordered', '9990000003');
INSERT INTO TAKEWAYS VALUES('4', 'Grilled Salmon with Lemon Dill Sauce', '4, Anna Nagar', 'Velvet Palate Resort', 'ordered', '9990000004');
INSERT INTO TAKEWAYS VALUES('5', 'Wild Mushroom Risotto', '56, Sector 17', 'Oceanview Dining Lodge', 'ordered', '9990000005');
INSERT INTO TAKEWAYS VALUES('6', 'Mango Avocado Salad', '7, Banjara Hills', 'Royal Spice Haven', 'ordered', '9990000006');
INSERT INTO TAKEWAYS VALUES('7', 'Chocolate Peanut Butter Brownies', '88, Civil Lines', 'Emerald Plate Hotel', 'ordered', '9990000007');
INSERT INTO TAKEWAYS VALUES('8', 'Blueberry Pancakes', '9, Kaloor', 'Moonlit Bites Retreat', 'ordered', '9990000008');
INSERT INTO TAKEWAYS VALUES('9', 'Vegetable Pad Thai', '101, Koregaon Park', 'The Rustic Table Inn', 'canceled', '9990000009');
INSERT INTO TAKEWAYS VALUES('10', 'Strawberry Cheesecake', '11/12, Hazratganj', 'Sunset Flavors Hotel', 'ordered', '9990000010');
INSERT INTO TAKEWAYS VALUES('11', 'Rustic Rosemary Roasted Potatoes', '123, Jodhpur Park', 'Crimson Dish Residency', 'ordered', '9990000011');
select * from TAKEWAYS;



create table PAYMENTS(
payment_id VARCHAR(40),
method_of_pay char(20),
transactions_detail VARCHAR(40),
primary key(payment_id));
insert into PAYMENTS values(1111,'Cash','Dining');
insert into PAYMENTS values(1112,'Card','Room and Dining');
insert into PAYMENTS values(1113,'Cash','Room');
insert into PAYMENTS values(1114,'Online','Takeaway');
insert into PAYMENTS values(1115,'Cash','Room and Takeaway');
insert into PAYMENTS values(1116,'Online','Dining');
insert into PAYMENTS values(1117,'Card','Dining and Takeaway');
insert into PAYMENTS values(1118,'Cash','Dining ');
insert into PAYMENTS values(1119,'Cash','Room and Dining');
insert into PAYMENTS values(1120,'Online','Takeaway');
insert into PAYMENTS values(1121,'Card','Room and Dining');
select * from PAYMENTS;