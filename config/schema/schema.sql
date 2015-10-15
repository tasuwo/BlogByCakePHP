CREATE TABLE posts (
	id INT AUTO_INCREMENT NOT NULL,
	title VARCHAR(200),
	body MEDIUMTEXT,
	created_at DATETIME,
	updated_at timestamp DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);
CREATE TABLE tags (
	id INT AUTO_INCREMENT NOT NULL,
	name VARCHAR(100),
	PRIMARY KEY (id)
);
CREATE TABLE comments (
	id INT AUTO_INCREMENT NOT NULL,
	post_id INT,
	user_name VARCHAR(30),
	body MEDIUMTEXT,
	created_at DATETIME,
	updated_at timestamp DEFAULT current_timestamp ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id),
	UNIQUE(id, post_id),
	FOREIGN KEY post_key(post_id) REFERENCES posts(id)
);
CREATE TABLE posts_tags (
	post_id INT NOT NULL,
	tag_id INT NOT NULL,
	UNIQUE(post_id, tag_id),
	PRIMARY KEY(post_id, tag_id),
	FOREIGN KEY post_key(post_id) REFERENCES posts(id),
	FOREIGN KEY tag_key(tag_id) REFERENCES tags(id)
);
CREATE TABLE users (
	id INT AUTO_INCREMENT NOT NULL,
	name VARCHAR(100) NOT NULL,
	mail VARCHAR(300),
	PRIMARY KEY (id)
);
