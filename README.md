# zwa-semester-work

Current database scheme:
```mysql

CREATE TABLE users
(
    guid     VARCHAR(255) PRIMARY KEY,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE categories
(
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE items
(
    item_id     INT AUTO_INCREMENT PRIMARY KEY,
    name        VARCHAR(255)   NOT NULL,
    price       DECIMAL(10, 2) NOT NULL,
    seller_guid VARCHAR(255)   NOT NULL,
    FOREIGN KEY (seller_guid) REFERENCES users (guid)
);

CREATE TABLE item_categories
(
    item_id       INT,
    category_name VARCHAR(255),
    PRIMARY KEY (item_id, category_name),
    FOREIGN KEY (item_id) REFERENCES items (item_id),
    FOREIGN KEY (category_name) REFERENCES categories (name)
);

CREATE TABLE user_bought_items
(
    user_guid        VARCHAR(255),
    item_id          INT,
    date_of_purchase DATE NOT NULL,
    PRIMARY KEY (user_guid, item_id),
    FOREIGN KEY (user_guid) REFERENCES users (guid),
    FOREIGN KEY (item_id) REFERENCES items (item_id)
);

CREATE INDEX idx_item_categories_item_id ON item_categories (item_id);
CREATE INDEX idx_item_categories_category_name ON item_categories (category_name);
CREATE INDEX idx_user_bought_items_user_guid ON user_bought_items (user_guid);
CREATE INDEX idx_user_bought_items_item_id ON user_bought_items (item_id);

```

