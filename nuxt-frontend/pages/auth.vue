<template>
  <v-card
    class="elevation-0 ma-auto"
    color="#FAFAFA"
    :disabled="(loadingstate) ? true : false"
  >
    <v-row
      align="start"
      justify="center"
    >
      <v-col
        cols="12"
        md="5"
      >
        <login
          :loading="loadingstate"
          @logIn="login"
        />
      </v-col>
      <v-divider
        inset
        :vertical="true"
      />
      <v-col
        cols="12"
        md="5"
      >
        <register
          :loading="loadingstate"
          @signUp="signup"
        />
      </v-col>
    </v-row>
  </v-card>
</template>

<script>
import Login from '~/components/auth/Login.vue'
import Register from '~/components/auth/Register.vue'
export default {
  components: {
    Login,
    Register,
  },
  layout: 'auth',
  data() {
    return {
      loadingstate: null,
      error: false,
      form: {
        name: null,
        password: null,
      },
    }
  },

  methods: {
    signup() {
      this.loadingstate = 'register'
    },
    login() {
      this.loadingstate = 'login'
    },
  },
}
</script>

<style></style>
