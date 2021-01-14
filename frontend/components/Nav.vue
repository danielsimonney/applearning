<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container-fluid">
      <nuxt-link class="navbar-brand" to="/">Frontend</nuxt-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <nuxt-link class="nav-link" to="/">Home</nuxt-link>
          </li>
          <li class="nav-item">
            <nuxt-link class="nav-link" to="/dashboard">
              Create
            </nuxt-link>
          </li>
          <li class="nav-item">
            <nuxt-link class="nav-link" to="/topics">
              Topics
            </nuxt-link>
          </li>
        </ul>
      </div>
        <template v-if="!authenticated">
          <ul class="navbar-nav ml-auto ">
            <li class="nav-item">
              <nuxt-link class="nav-link" to="/login">
              Login
              </nuxt-link>
            </li>
            <li class="nav-item">
              <nuxt-link class="nav-link" to="/register">
                Register
              </nuxt-link>
            </li>
          </ul>
        </template>
        <template v-if="authenticated">
          <ul class="navbar-nav ml-auto ">
            <li class="nav-item">
              <a class="nav-link">
              {{user.name}}
              </a>
            </li>
            <li class="nav-item">
              <a @click.prevent="logout" class="nav-link">Logout</a>
            </li>
          </ul>
        </template>
    </div>
  </nav>
</template>

<script>
import {mapGetters} from 'vuex'

export default {
  methods: {
    logout() {
      this.$auth.logout()
    }
  }
}
</script>

<style>

</style>