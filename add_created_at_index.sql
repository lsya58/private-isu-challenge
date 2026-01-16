-- postsテーブルのcreated_atにインデックス追加
ALTER TABLE posts ADD INDEX idx_created_at (created_at);
