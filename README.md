Live Auction

Overview

Live Auction is a real-time bidding platform built using Laravel 11, Livewire, and other modern web technologies. This project allows users to participate in live auctions, bid on items, and view auction results in real-time.

Features

Real time chat pusher

User authentication and authorization

Live bidding system

Real-time updates using Laravel Broadcasting

Admin dashboard for managing auctions and users

Real time event 

Timer

Responsive design for all devices

Installation

Prerequisites

Make sure you have the following installed:

PHP 8.2+

Composer

Node.js & NPM

MySQL 

Setup Steps

Clone the repository:

git clone https://github.com/aki961996/live-auction.git
cd live-auction

Install dependencies:

composer install
npm install && npm run dev

Copy the .env.example file and update environment variables:

cp .env.example .env
php artisan key:generate

Set up the database:

php artisan migrate --seed

php artisan db🌱and create manualy products

php artisan db:seed --class=RolePermissionSeeder

npm run dev

php artisan queue:work

Start the development server:

php artisan serve

Usage

Register or log in as a user.

Browse available auctions.

Place bids in real-time.

Admins can create, update, and manage auctions.
Admins can create, update, and manage Products.




