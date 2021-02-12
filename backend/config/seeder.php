<?php

return [
  'seed_users_count' => env('SEED_USERS_COUNT'),
  'seed_tags_count' => env('SEED_TAGS_COUNT'),
  'seed_topics_count' => env('SEED_TOPICS_COUNT'),
  'seed_topic_posts_count' => explode(",", env('SEED_TOPIC_POSTS_COUNT')),
  'seed_topic_likes_count' => explode(",", env('SEED_TOPIC_LIKES_COUNT')),
  'seed_topic_tags_count' => explode(",", env('SEED_TOPIC_TAGS_COUNT')),
  'seed_post_comments_count' => explode(",", env('SEED_POST_COMMENTS_COUNT')),
  'seed_post_likes_count' => explode(",", env('SEED_POST_LIKES_COUNT')),
];
