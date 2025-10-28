USE lab5_db;
CREATE TABLE IF NOT EXISTS orders
(
	order_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    amount INT NOT NULL,
    food VARCHAR(100) NOT NULL,
    add_sauce TINYINT(1),
    type_delivery VARCHAR(100) NOT NULL
);

INSERT INTO orders (name,amount,food,add_sauce,type_delivery) VALUES
("asdasd", 123, "dafsghjkl", 1, "foot"),
("5555asd", 65, "dxccchjkl", 1, "foot"),
("a234aasd", 3, "dafgdfc444jkl", 0, "plane")