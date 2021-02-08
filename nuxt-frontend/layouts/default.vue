<template>
  <v-app>
    <v-sheet
      color="#3D5AF0"
      min-height="100vh"
    >
      <v-main>
        <v-container fluid>
          <v-card
            class="cardBase mb-15 rounded-xl"
            color="#FAFAFA"
          >
            <!-- <v-card-title class="px-10 red"> -->
            <navbar class="px-10 py-10" />
            <!-- </v-card-title> -->
            <v-divider
              light
              class="mb-5"
            />
            <v-card-text class="px-10">
              <v-row
                align="start"
                justify="center"
              >
                <v-col
                  cols="3"
                  class="d-flex justify-end"
                >
                  <left-bar />
                </v-col>
                <v-col cols="9">
                  <nuxt />
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </v-container>
      </v-main>
    </v-sheet>
  </v-app>
</template>

<script>
import LeftBar from '../components/homepage/LeftBar.vue'
import Navbar from '../components/layouts/Navbar.vue'
export default {
  components: { Navbar, LeftBar },
}
</script>
