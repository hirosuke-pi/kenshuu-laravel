# kenshuu-laravel
- ニュース投稿サイト Laravel版

## 環境構築

1. Taskをインストールする (https://taskfile.dev/installation/)
2. Docker Composeをビルド: `task init`
3. データベースが完全に立ち上がるまで待つ
4. データベースのMigration, Seeder実行: `task db-init`
