.open finalproject.db

// id, username, title, content, rating
CREATE TABLE review (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    title TEXT NOT NULL,
    content TEXT NOT NULL, 
    rating FLOAT (2,1) NOT NULL 
);

INSERT INTO review 
    (username, title, content, rating) 
VALUES
    ("okayMatthew", "ADSR Synth", "A paragraph", 7.5),
    ("drummer5", "Percussion Pack", "A paragraph", 4.5);

CREATE TABLE user (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL);

INSERT INTO user (username, password)
VALUES
    ("okayMatthew", "1"),
    ("drummer5", "1");
