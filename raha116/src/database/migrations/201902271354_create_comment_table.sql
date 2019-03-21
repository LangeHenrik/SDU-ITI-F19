CREATE TABLE comments
(
  comment_id    INT PRIMARY KEY AUTO_INCREMENT,
  text          TEXT,
  feed_entry_id int REFERENCES feed_entries (entry_id),
  user_id       int REFERENCES users (user_id)
);
