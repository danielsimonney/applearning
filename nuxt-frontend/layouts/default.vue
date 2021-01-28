<template>
  <v-app>
    <v-sheet
      color="#3D5AF0"
      min-height="100vh"
    >
      <navbar />
      <v-main>
        <v-container>
          <nuxt />
        </v-container>
      </v-main>
    </v-sheet>
  </v-app>
</template>

<script>
import Navbar from '../components/Navbar.vue'
export default {
  components: { Navbar },
  
}
</script>
