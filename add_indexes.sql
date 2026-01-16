-- commentsテーブルにpost_idのインデックス追加
ALTER TABLE comments ADD INDEX idx_post_id (post_id);

-- commentsテーブルにuser_idのインデックス追加  
ALTER TABLE comments ADD INDEX idx_user_id (user_id);

-- postsテーブルにuser_idのインデックス追加
ALTER TABLE posts ADD INDEX idx_user_id (user_id);
