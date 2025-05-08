SmartPark is a simple PHP and MySQL-based web application that allows users to reserve and cancel parking spaces in predefined car parks (e.g., Mitrovica). The system tracks availability in real time and ensures a smooth parking experience.

🧩 Features
🔐 User Authentication
Users must log in to access reservation features.

📍 View Available Car Parks
Displays a list of car parks in Mitrovica with available parking spaces.

✅ Reserve Parking Spaces
Users can select and reserve any unoccupied parking spot.

❌ Cancel Reservations
Users can view and cancel their own reservations; canceled spots become available again.

🖥️ Responsive Design
The interface is styled with responsive CSS for use on desktops and mobile devices.

🗄️ Database Schema
The project includes three main tables:

users – Stores user login information.

carparks – Contains predefined car park names and locations.

parking_spaces – Tracks parking spots, their labels, availability, and car park associations.

reservations – Links users to the spots they've reserved.

📁 Technologies Used
PHP – Server-side scripting

MySQL – Relational database

HTML/CSS – Responsive front-end design
