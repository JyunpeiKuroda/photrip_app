# フォトリップApp
[本番環境](https://photrips.herokuapp.com/login)

# 技術スタック
 
- **バックエンド**：Laravel 5.8 PHP 7.3.10
- **フロントエンド**：Vue.js 3.11.0(SPA), Vue Router, Vuex, tailwindcss, Buefy
- **インフラ**：Heroku

※ [herokuにデプロイした備忘録](https://www.kmmk.work/entry/2019/11/30/030459)

# 作成するアプリケーションの要件

- ユーザーがしおりを作成可能
- しおりはタイムライン形式で表示
- しおりには画像の添付が可能

# ペルソナ
学生(15 ~ 22歳) + 写真を取るのが好き　+ 旅行好き（１泊2日程度）

# モデル設計
## 現状
<img width="778" alt="スクリーンショット 2019-12-02 13 33 58" src="https://user-images.githubusercontent.com/43497062/69930854-71b79600-1508-11ea-933f-87f6a9040696.png">


## 理想
![モデル設計](https://user-images.githubusercontent.com/43497062/69470663-58616c00-0ddb-11ea-92b6-6516bf8dd9b4.png)


# 画面仕様書
<img width="730" alt="スクリーンショット 2019-11-23 10 25 23" src="https://user-images.githubusercontent.com/43497062/69470687-93639f80-0ddb-11ea-94a5-a43fe1667a36.png">


# この改題を通して学習したこと
- リポジトリパターン
- Laravelにおけるs3への写真アップロード
- laravelのログがstorage > logsに吐かれると言うこと
- テストコード（特に認証 / ストレージ周り）
- Laravelにおけるモデル内の記述の役割（$visibleでレスポンスに含まれるようになる等）
- Laravelにおけるリレーション
- テストデータの作成
- プログレスバーの実装
- Vuex
- tailwindcss
- モデル設計
- ペジネーション 

## 工夫した点
- Vueのコンポーネント設計
- storeのモジュール分け
- コントローラーとモデルの責務の分離
- Gitのブランチは出来るだけ多く切る
- バリデーションはcommonディレクトリを作成して、グローバルに使用可能にする

## 苦労した点
- 外部キー制約（Guideモデルのプライマリーキーをstring型にしていたから）
- 編集機能
- 写真

## 疑問
loadingbarを実装するために、「api通信処理をvuexに書くべき」か、loading用のstoreを作成して、「api通信をしているページ側でloadingのステートを更新すべき」か

- 前者：正直わからない。詳細情報取得APIなどのレスポンスを毎度ステートで保存するのは大丈夫なのか？（アンチパターンではない？）
- 後者：メンテナンスをする際の手間が増えそう

