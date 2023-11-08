# zwa-semester-work

Current database scheme:
```mysql
CREATE TABLE users
(
    user_id             INT AUTO_INCREMENT PRIMARY KEY,
    name                VARCHAR(255)        NOT NULL,
    guid                VARCHAR(255) UNIQUE NOT NULL,
    payment_card_number VARCHAR(255) UNIQUE NOT NULL,
    password            VARCHAR(255)        NOT NULL,
    is_admin            BOOLEAN DEFAULT FALSE
);

CREATE TABLE categories
(
    category_id   INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE items
(
    item_id    INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255)   NOT NULL,
    price      DECIMAL(10, 2) NOT NULL,
    seller_id  INT,
    image_url  VARCHAR(255)   NOT NULL,
    FOREIGN KEY (seller_id) REFERENCES users (user_id)
);

CREATE TABLE item_categories
(
    item_id      INT,
    category_id  INT,
    PRIMARY KEY (item_id, category_id),
    FOREIGN KEY (item_id) REFERENCES items (item_id),
    FOREIGN KEY (category_id) REFERENCES categories (category_id)
);

CREATE TABLE user_bought_items
(
    user_id INT,
    item_id INT,
    PRIMARY KEY (user_id, item_id),
    FOREIGN KEY (user_id) REFERENCES users (user_id),
    FOREIGN KEY (item_id) REFERENCES items (item_id)
);

CREATE TABLE transactions_history
(
    transaction_id   INT AUTO_INCREMENT PRIMARY KEY,
    user_id          INT,
    item_id          INT,
    date_of_purchase DATE NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users (user_id),
    FOREIGN KEY (item_id) REFERENCES items (item_id)
);

CREATE INDEX idx_item_categories_item_id ON item_categories (item_id);
CREATE INDEX idx_item_categories_category_id ON item_categories (category_id);
CREATE INDEX idx_user_bought_items_user_id ON user_bought_items (user_id);
CREATE INDEX idx_transactions_history_user_id ON transactions_history (user_id);

```

