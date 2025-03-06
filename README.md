# What is it?

A web application that combines features from popular platforms like TikTok, Vinted, and Tinder. It allows users to browse, buy, and sell items in a swipe-based interface, providing an engaging and efficient shopping experience.

## Core Functionality

- **Guest Browsing**: Unregistered users can view items listed by others and have the option to register to unlock the full feature set.

- **User Registration and Authentication**: Users can create an account and log in to access personalized features.

- **Item Swiping**: Registered users can browse items in a swipe-based interface, choosing to buy items instantly or skip them, similar to the Tinder experience.

- **Item Listing**: Users can list their own items for sale, including uploading images and providing descriptions.

- **Transaction History**: Users have access to a transaction history to track their purchases and sales.

- **Profile Management**: Users can update their personal information and manage their profiles.

## Technical Overview

The application is structured into three main directories:

- **Backend**: Contains PHP source files for API endpoints, database interactions, and utility scripts, as well as directories for assets and user-uploaded images.

- **Frontend**: Includes CSS stylesheets, JavaScript files for client-side logic, and viewable pages with PHP logic to ensure dynamic page loading.

- **Documentation**: Provides product documentation describing top-level functionality and UI, phpDocumentator-generated documentation detailing all PHP source code, and programmer documentation containing deep technical information.

## Database Schema

The MySQL database consists of the following tables:

- **users**: Stores user information, including unique IDs, GUIDs, and passwords.

- **categories**: Contains different categories that can be associated with items.

- **items**: Records items for sale, including item IDs, names, prices, and references to the seller.

- **item_categories**: Defines the relationship between items and categories.

- **user_bought_items**: Tracks purchases, recording the buyer's user ID, the purchased item's ID, and the date of purchase.

Indexes are created on relevant columns to ensure efficient querying.

For more detailed information, please refer to the respective [documentation](https://github.com/adamhoof/TinderEshopMorph/tree/master/docs).
