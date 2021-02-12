<?php

return [
  'seed_users_count' => env('SEED_USERS_COUNT'),
  'seed_topics_count' => env('SEED_TOPICS_COUNT'),
  'seed_topics_posts_count' => explode(",", env('SEED_TOPICS_POSTS_COUNT')),
  'seed_topics_likes_count' => explode(",", env('SEED_TOPICS_LIKES_COUNT')),
  'seed_tags_count' => explode(",", env('SEED_TOPICS_TAGS')),
  'seed_comments_count' => explode(",", env('SEED_TOPICS_POSTS_COMMENTS_COUNT')),
  'seed_posts_likes_count' => explode(",", env('SEED_TOPICS_POSTS_LIKES_COUNT')),

];
