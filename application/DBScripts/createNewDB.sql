// Create fish table
$sql = 'CREATE TABLE IF NOT EXISTS fish (
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL UNIQUE
)';
$conn->exec($sql);

// Create user table
$sql = 'CREATE TABLE IF NOT EXISTS user(
    id INTEGER PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
)';
$conn->exec($sql);

// Create caught_fish
$sql = 'CREATE TABLE IF NOT EXISTS caught_fish(
    id INTEGER PRIMARY KEY,
    fish_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    weight FLOAT,
    measurement INTEGER,
    FOREIGN KEY(fish_id) REFERENCES fish(id) ON DELETE CASCADE,
    FOREIGN KEY(user_id) REFERENCES user(id) ON DELETE CASCADE
)';
$conn->exec($sql);

//$addUsers = 'INSERT INTO user (name) VALUES("Oja")';
//$conn->exec($addUsers);

//Add caught fish
//$addCaughtFish = 'INSERT INTO caught_fish (fish_id, user_id, weight, measurement)
//VALUES(1, 2, 20, 30)';
//$conn->exec($addCaughtFish);

//$addFish = 'INSERT INTO fish (name) VALUES("Mört")';
//$conn->exec($addFish);
