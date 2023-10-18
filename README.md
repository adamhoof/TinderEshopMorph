# zwa-semester-work

Current database scheme:
```mysql
CREATE TABLE users (
user_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
surname VARCHAR(255) NOT NULL,
email VARCHAR(255) UNIQUE NOT NULL,
phone VARCHAR(255) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
is_admin BOOLEAN DEFAULT FALSE
);

CREATE TABLE categories (
name VARCHAR(255) PRIMARY KEY
);

CREATE TABLE items (
item_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(255) NOT NULL,
price DECIMAL(10,2) NOT NULL,
seller_id INT,
image_url VARCHAR(255) NOT NULL,
category_name VARCHAR(255),
FOREIGN KEY (seller_id) REFERENCES users(user_id),
FOREIGN KEY (category_name) REFERENCES categories(name)
);

CREATE TABLE user_bought_items (
user_id INT,
item_id INT,
PRIMARY KEY (user_id, item_id),
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (item_id) REFERENCES items(item_id)
);

CREATE TABLE transactions_history (
transaction_id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
item_id INT,
date_of_purchase DATE NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (item_id) REFERENCES items(item_id)
);

CREATE TABLE user_preferences (
user_id INT,
category_name VARCHAR(255),
preference_count INT CHECK (preference_count >= 0),
PRIMARY KEY (user_id, category_name),
FOREIGN KEY (user_id) REFERENCES users(user_id),
FOREIGN KEY (category_name) REFERENCES categories(name)
);

CREATE INDEX idx_user_preferences_category_name ON user_preferences(category_name);
CREATE INDEX idx_user_bought_items_user_id ON user_bought_items(user_id);

```

